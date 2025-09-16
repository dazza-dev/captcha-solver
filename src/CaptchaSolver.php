<?php

namespace DazzaDev\CaptchaSolver;

use DazzaDev\CaptchaSolver\Exceptions\CaptchaSolverException;
use DazzaDev\CaptchaSolver\ServiceResolver;

abstract class CaptchaSolver
{
    private string $service;

    private string $host;

    private string $clientKey;

    private bool $verboseMode = false;

    private ?string $errorMessage = null;

    private string $taskId;

    public ?object $taskInfo = null;

    /**
     * Initialize CaptchaSolver with service and API key
     * The host will be automatically resolved based on the service
     *
     * @param array $params Configuration parameters
     *                     - service: The captcha service name (required)
     *                     - api_key: The API key for the service (required)
     *                     - host: Custom host (optional, will override auto-resolution)
     * @throws CaptchaSolverException
     */
    public function __construct(array $params = [])
    {
        $service = $params['service'] ?? $_ENV['CAPTCHA_SOLVER_SERVICE'] ?? null;

        if (! $service) {
            throw new CaptchaSolverException('Service is required. Please provide it in params or set CAPTCHA_SOLVER_SERVICE environment variable.');
        }

        $this->setService($service);

        // Auto-resolve host based on service, unless custom host is provided
        $host = $params['host'] ?? ServiceResolver::resolveHost($service);
        $this->setHost($host);

        $apiKey = $params['api_key'] ?? $_ENV['CAPTCHA_SOLVER_API_KEY'] ?? null;
        if (! $apiKey) {
            throw new CaptchaSolverException('API key is required. Please provide it in params or set CAPTCHA_SOLVER_API_KEY environment variable.');
        }

        $this->setClientKey($apiKey);
    }

    /**
     * Get list of supported services
     *
     * @return array List of supported service names
     */
    public static function getSupportedServices(): array
    {
        return ServiceResolver::getSupportedServices();
    }

    /**
     * Check if a service is supported
     *
     * @param string $service The service name to check
     * @return bool True if supported, false otherwise
     */
    public static function isServiceSupported(string $service): bool
    {
        return ServiceResolver::isServiceSupported($service);
    }

    /**
     * Get post data for the specific captcha task
     * This method must be implemented by each task type
     *
     * @return array The post data array for the API request
     */
    abstract public function getPostData(): array;

    /**
     * Submit new task and receive tracking ID
     *
     * @return bool
     *
     * @throws CaptchaSolverException
     */
    public function createTask()
    {
        $postData = [
            'clientKey' => $this->clientKey,
            'task' => $this->getPostData(),
        ];
        $submitResult = $this->submit('createTask', $postData);

        if ($submitResult == false) {
            throw new CaptchaSolverException('API error');
        }

        if ($submitResult->errorId == 0) {
            $this->setTaskId($submitResult->taskId);
            $this->debout("created task with ID {$this->taskId}", 'yellow');

            return true;
        } else {
            $this->setErrorMessage($submitResult->errorDescription);
            throw new CaptchaSolverException("API error {$submitResult->errorCode} : {$submitResult->errorDescription}");
        }
    }

    /**
     * Wait for task result
     * 
     * @return bool
     *
     * @throws CaptchaSolverException
     */
    public function waitForResult(int $maxSeconds = 300, int $currentSecond = 0)
    {
        $postData = [
            'clientKey' => $this->clientKey,
            'taskId' => $this->taskId,
        ];
        if ($currentSecond == 0) {
            $this->debout('waiting 5 seconds..');
            sleep(3);
        } else {
            sleep(1);
        }
        $this->debout('requesting task status');
        $postResult = $this->submit('getTaskResult', $postData);

        if ($postResult == false) {
            throw new CaptchaSolverException('API error');
        }

        $this->taskInfo = $postResult;

        if ($this->taskInfo->errorId == 0) {
            if ($this->taskInfo->status == 'processing') {
                $this->debout('task is still processing');

                //repeating attempt
                return $this->waitForResult($maxSeconds, $currentSecond + 1);
            }
            if ($this->taskInfo->status == 'ready') {
                $this->debout('task is complete', 'green');

                return true;
            }
            $this->setErrorMessage('unknown API status, update your software');
            throw new CaptchaSolverException('unknown API status, update your software');
        } else {
            $this->setErrorMessage($this->taskInfo->errorDescription);
            throw new CaptchaSolverException("API error {$this->taskInfo->errorCode} : {$this->taskInfo->errorDescription}");
        }
    }

    /**
     * @return bool
     *
     * @throws CaptchaSolverException
     */
    public function getBalance()
    {
        $postData = [
            'clientKey' => $this->clientKey,
        ];
        $result = $this->submit('getBalance', $postData);
        if ($result == false) {
            throw new CaptchaSolverException('API error');
        }
        if ($result->errorId == 0) {
            return $result->balance;
        } else {
            return false;
        }
    }

    /**
     * Submit request to captcha solver API
     *
     * @throws CaptchaSolverException
     */
    public function submit(string $methodName, array $postData)
    {
        if ($this->verboseMode) {
            echo "making request to https://{$this->host}/$methodName with following payload:\n";
            print_r($postData);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://{$this->host}/$methodName");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        $postDataEncoded = json_encode($postData);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataEncoded);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json; charset=utf-8',
            'Accept: application/json',
            'Content-Length: ' . strlen($postDataEncoded),
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $result = curl_exec($ch);
        $curlError = curl_error($ch);

        if ($curlError != '') {
            $this->debout("Network error: $curlError");
            throw new CaptchaSolverException("Network error: $curlError");
        }
        curl_close($ch);

        return json_decode($result);
    }

    /**
     * Set verbose mode for captcha solver API
     */
    public function setVerboseMode($mode)
    {
        $this->verboseMode = $mode;
    }

    /**
     * Debug output for captcha solver API
     */
    public function debout(string $message, string $color = 'white')
    {
        if (! $this->verboseMode) {
            return false;
        }
        if ($color != 'white' and $color != '') {
            $CLIcolors = [
                'cyan' => '0;36',
                'green' => '0;32',
                'blue' => '0;34',
                'red' => '0;31',
                'yellow' => '1;33',
            ];

            $CLIMsg = "\033[" . $CLIcolors[$color] . "m$message\033[0m";
        } else {
            $CLIMsg = $message;
        }
        echo $CLIMsg . "\n";
    }

    /**
     * Set error message for captcha solver API
     */
    public function setErrorMessage(string $message)
    {
        $this->errorMessage = $message;
    }

    /**
     * Get error message for captcha solver API
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Get task ID for captcha solver API
     */
    public function getTaskId(): string
    {
        return $this->taskId;
    }

    /**
     * Set task ID for captcha solver API
     */
    public function setTaskId(string $taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * SET host for captcha solver API
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }

    /**
     * Set service for captcha solver API
     */
    public function setService(string $service)
    {
        $this->service = $service;
    }

    /**
     * Set client key for captcha solver API
     */
    public function setClientKey(string $clientKey)
    {
        $this->clientKey = $clientKey;
    }
}
