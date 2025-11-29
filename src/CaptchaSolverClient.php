<?php

namespace DazzaDev\CaptchaSolver;

use DazzaDev\CaptchaSolver\Exceptions\CaptchaSolverException;
use DazzaDev\CaptchaSolver\Tasks\CustomCaptcha;
use DazzaDev\CaptchaSolver\Tasks\FunCaptcha;
use DazzaDev\CaptchaSolver\Tasks\GeeTest;
use DazzaDev\CaptchaSolver\Tasks\HCaptcha;
use DazzaDev\CaptchaSolver\Tasks\ImageToText;
use DazzaDev\CaptchaSolver\Tasks\NoCaptcha;
use DazzaDev\CaptchaSolver\Tasks\RecaptchaV2;
use DazzaDev\CaptchaSolver\Tasks\RecaptchaV2Enterprise;
use DazzaDev\CaptchaSolver\Tasks\RecaptchaV3;
use DazzaDev\CaptchaSolver\Tasks\RecaptchaV3Enterprise;
use DazzaDev\CaptchaSolver\Tasks\Turnstile;

class CaptchaSolverClient extends CaptchaSolver
{
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
        parent::__construct($service, $apiKey);
    }

    /**
     * Solve reCAPTCHA v2
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveReCaptchaV2(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new RecaptchaV2;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve reCAPTCHA v3
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveReCaptchaV3(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new RecaptchaV3;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve NoCaptcha (reCAPTCHA v2 standard)
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveNoCaptcha(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new NoCaptcha;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve FunCaptcha
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websitePublicKey  The FunCaptcha public key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveFunCaptcha(string $websiteUrl, string $websitePublicKey): ?string
    {
        $task = new FunCaptcha;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websitePublicKey);

        return $this->solveTask($task);
    }

    /**
     * Solve hCaptcha
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveHCaptcha(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new HCaptcha;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve GeeTest
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key (gt)
     * @param  string  $challenge  The challenge value
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveGeeTest(string $websiteUrl, string $websiteKey, string $challenge): ?string
    {
        $task = new GeeTest;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);
        $task->setChallenge($challenge);

        return $this->solveTask($task);
    }

    /**
     * Solve Cloudflare Turnstile
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The site key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveTurnstile(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new Turnstile;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve reCAPTCHA v2 Enterprise
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveReCaptchaV2Enterprise(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new RecaptchaV2Enterprise;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve reCAPTCHA v3 Enterprise
     *
     * @param  string  $websiteUrl  The website URL
     * @param  string  $websiteKey  The website key
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveReCaptchaV3Enterprise(string $websiteUrl, string $websiteKey): ?string
    {
        $task = new RecaptchaV3Enterprise;
        $task->setWebsiteURL($websiteUrl);
        $task->setWebsiteKey($websiteKey);

        return $this->solveTask($task);
    }

    /**
     * Solve CustomCaptcha
     *
     * @param  string  $imageUrl  The captcha image URL
     * @param  string  $assignment  The assignment text
     * @param  array  $forms  The forms schema
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveCustomCaptcha(string $imageUrl, string $assignment, array $forms): ?string
    {
        $task = new CustomCaptcha;
        $task->setImageUrl($imageUrl);
        $task->setAssignment($assignment);
        $task->setForms($forms);

        return $this->solveTask($task);
    }

    /**
     * Solve ImageToText
     *
     * @param  string  $bodyBase64  The base64-encoded image body
     * @return string|null The captcha solution or null if not found
     *
     * @throws CaptchaSolverException
     */
    public function solveImageToText(string $bodyBase64): ?string
    {
        $task = new ImageToText;
        $task->setBody($bodyBase64);

        return $this->solveTask($task);
    }
}
