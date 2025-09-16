<?php

namespace DazzaDev\CaptchaSolver;

use DazzaDev\CaptchaSolver\Tasks\RecaptchaV2;

class CaptchaSolverClient
{
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function solveReCaptchaV2(string $websiteUrl, string $websiteKey, bool $verboseMode = false)
    {
        $solver = new RecaptchaV2($this->params);
        $solver->setVerboseMode($verboseMode);
        $solver->setWebsiteURL($websiteUrl);
        $solver->setWebsiteKey($websiteKey);
        $solver->createTask();

        // Wait
        $solver->waitForResult();

        return $solver->getTaskSolution() ?? null;
    }
}
