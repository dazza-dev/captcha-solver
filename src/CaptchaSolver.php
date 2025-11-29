<?php

namespace DazzaDev\CaptchaSolver;

use DazzaDev\CaptchaSolver\Exceptions\CaptchaSolverException;
use DazzaDev\CaptchaSolver\Tasks\Task;

class CaptchaSolver
{
    /**
     * The captcha service name
     */
    private string $service;

    /**
     * The captcha solver API host
     */
    private string $host;

    /**
     * The captcha solver API client key
     */
    private string $apiKey;

    /**
     * The captcha solver API task
     */
    private ?Task $task = null;

    /**
     * The captcha solver API task ID
     */
    private string $taskId;

    /**
     * Initialize CaptchaSolver with service and API key
     * The host will be automatically resolved based on the service
     *
     * @param  string|null  $service  The captcha service name (required)
     * @param  string|null  $apiKey  The API key for the service (required)
     *
     * @throws CaptchaSolverException
     */
    public function __construct(?string $service = null, ?string $apiKey = null)
    {
        // Set service if provided
        if ($service) {
            $this->setService($service);
        }

        // Set API key if provided
        if ($apiKey) {
            $this->setApiKey($apiKey);
        }
    }

    /**
     * Solve captcha task
     *
     * @param  Task  $task  The captcha task to solve
     * @return mixed The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveTask(Task $task): ?string
    {
        $this->task = $task;
        $this->createTask();
        $this->waitForResult();

        return $this->task->getTaskSolution() ?? null;
    }

    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        if ($this->task === null) {
            throw new CaptchaSolverException('Task is not set');
        }

        return $this->task->getPostData();
    }

    /**
     * Submit new task and receive tracking ID
     *
     * @throws CaptchaSolverException
     */
    public function createTask(): bool
    {
        $submitResult = $this->submit('createTask', [
            'clientKey' => $this->getApiKey(),
            'task' => $this->getPostData(),
        ]);

        // Check if submission was successful
        if ($submitResult == false) {
            throw new CaptchaSolverException('API error');
        }

        // Check for API errors
        if ($submitResult->errorId > 0) {
            throw new CaptchaSolverException("API error {$submitResult->errorCode} : {$submitResult->errorDescription}");
        }

        // Set task ID if successful
        $this->setTaskId($submitResult->taskId);

        return true;
    }

    /**
     * Wait for task result
     *
     * @param  int  $maxSeconds  The maximum number of seconds to wait for the task to complete
     * @param  int  $currentSecond  The current second count (used for recursive calls)
     *
     * @throws CaptchaSolverException
     */
    public function waitForResult(int $maxSeconds = 300, int $currentSecond = 0): bool
    {
        if ($currentSecond == 0) {
            sleep(3);
        } else {
            sleep(1);
        }

        $postResult = $this->submit('getTaskResult', [
            'clientKey' => $this->getApiKey(),
            'taskId' => $this->getTaskId(),
        ]);

        // Check if API request was successful
        if ($postResult == false) {
            throw new CaptchaSolverException('API error');
        }

        // Set task information if successful
        $this->task->setTaskInfo($postResult);

        // Check if task is complete or failed
        if ($this->task->getTaskInfo()->errorId == 0) {
            // repeating attempt
            if ($this->task->getTaskInfo()->status == 'processing') {
                return $this->waitForResult($maxSeconds, $currentSecond + 1);
            }
            // Task is complete
            if ($this->task->getTaskInfo()->status == 'ready') {
                return true;
            }
            throw new CaptchaSolverException('unknown API status, update your software');
        } else {
            throw new CaptchaSolverException("API error {$this->task->getTaskInfo()->errorCode} : {$this->task->getTaskInfo()->errorDescription}");
        }
    }

    /**
     * Get account balance
     *
     * @return float The account balance
     *
     * @throws CaptchaSolverException
     */
    public function getBalance(): float
    {
        $submitResult = $this->submit('getBalance', [
            'clientKey' => $this->getApiKey(),
        ]);

        // Check if API request was successful
        if ($submitResult == false) {
            throw new CaptchaSolverException('API error');
        }

        // Check if API response is valid
        if ($submitResult->errorId > 0) {
            throw new CaptchaSolverException("API error {$submitResult->errorCode} : {$submitResult->errorDescription}");
        }

        return $submitResult->balance;
    }

    /**
     * Submit request to captcha solver API
     *
     * @param  string  $methodName  The API method name
     * @param  array  $postData  The POST data to send
     * @return object The decoded JSON response
     *
     * @throws CaptchaSolverException
     */
    public function submit(string $methodName, array $postData): object
    {
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
            'Content-Length: '.strlen($postDataEncoded),
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $result = curl_exec($ch);
        $curlError = curl_error($ch);

        if ($curlError != '') {
            throw new CaptchaSolverException("Network error: $curlError");
        }
        unset($ch);

        return json_decode($result);
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
     * @param  string  $service  The service name to check
     * @return bool True if supported, false otherwise
     */
    public static function isServiceSupported(string $service): bool
    {
        return ServiceResolver::isServiceSupported($service);
    }

    /**
     * Set the captcha service to use
     *
     * @param  string  $service  The captcha service name (e.g., 'anticaptcha')
     */
    public function setService(string $service): self
    {
        // Validate service
        if (! self::isServiceSupported($service)) {
            throw new CaptchaSolverException("Service '$service' is not supported.");
        }

        $this->service = $service;
        $this->host = ServiceResolver::resolveHost($service);

        return $this;
    }

    /**
     * Get the captcha service name
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * Set the API key for the captcha service
     *
     * @param  string  $apiKey  The API key for the captcha service
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get the captcha solver API client key
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
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
    public function setTaskId(string $taskId): void
    {
        $this->taskId = $taskId;
    }
}
