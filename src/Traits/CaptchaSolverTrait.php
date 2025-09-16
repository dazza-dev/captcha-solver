<?php

namespace DazzaDev\CaptchaSolver\Traits;

trait CaptchaSolverTrait
{
    private string $websiteUrl;

    private string $websiteKey;

    private string $apiSubdomain;

    private string $data;

    private bool $isInvisible = false;

    private string $userAgent = '';

    private string $cookies = '';

    /**
     * Set task info
     */
    public function setTaskInfo(object $taskInfo): void
    {
        $this->taskInfo = $taskInfo;
    }

    /**
     * Set website URL
     */
    public function setWebsiteURL(string $value): void
    {
        $this->websiteUrl = $value;
    }

    /**
     * Set website key
     */
    public function setWebsiteKey(string $value): void
    {
        $this->websiteKey = $value;
    }

    /**
     * Set API subdomain
     */
    public function setAPISubdomain(string $value): void
    {
        $this->apiSubdomain = $value;
    }

    /**
     * Set data
     */
    public function setData(string $value): void
    {
        $this->data = $value;
    }

    /**
     * Set is invisible
     */
    public function setIsInvisible(bool $value): void
    {
        $this->isInvisible = $value;
    }

    /**
     * Set user agent
     */
    public function setUserAgent(string $value): void
    {
        $this->userAgent = $value;
    }

    /**
     * Set cookies
     */
    public function setCookies(string $value): void
    {
        $this->cookies = $value;
    }
}
