<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class GeeTest extends Task
{
    /**
     * Challenge
     */
    private ?string $challenge = null;

    /**
     * Captcha ID
     */
    private ?string $captchaId = null;

    /**
     * GeeTest getLib URL
     */
    private ?string $geeTestGetLib = null;

    /**
     * Version
     */
    private int $version = 3;

    /**
     * Init parameters
     */
    private ?string $initParameters = null;

    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'type' => ($this->getProxyAddress()) ? 'GeeTestTask' : 'GeeTestTaskProxyless',
            'websiteURL' => $this->getWebsiteUrl(),
            'gt' => $this->getWebsiteKey(),
            'challenge' => $this->challenge,
        ];

        if ($this->getCaptchaId()) {
            $postData['captchaId'] = $this->getCaptchaId();
        }

        if ($this->getApiSubdomain()) {
            $postData['geetestApiServerSubdomain'] = $this->getApiSubdomain();
        }

        if ($this->getGeeTestGetLib()) {
            $postData['geetestGetLib'] = $this->getGeeTestGetLib();
        }

        if ($this->getVersion()) {
            $postData['version'] = $this->getVersion();
        }

        if ($this->getInitParameters()) {
            $postData['initParameters'] = $this->getInitParameters();
        }

        if ($this->getProxy()) {
            $postData['proxy'] = $this->getProxy();
        }

        if ($this->getProxyType()) {
            $postData['proxyType'] = $this->getProxyType();
        }

        if ($this->getProxyAddress()) {
            $postData['proxyAddress'] = $this->getProxyAddress();
        }

        if ($this->getProxyPort()) {
            $postData['proxyPort'] = $this->getProxyPort();
        }

        if ($this->getProxyLogin()) {
            $postData['proxyLogin'] = $this->getProxyLogin();
        }

        if ($this->getProxyPassword()) {
            $postData['proxyPassword'] = $this->getProxyPassword();
        }

        if ($this->getUserAgent()) {
            $postData['userAgent'] = $this->getUserAgent();
        }

        if ($this->getCookies()) {
            $postData['cookies'] = $this->getCookies();
        }

        return $postData;
    }

    /**
     * Get task solution
     */
    public function getTaskSolution(): ?string
    {
        return $this->getTaskInfo()->solution;
    }

    /**
     * Get challenge
     */
    public function getChallenge(): ?string
    {
        return $this->challenge;
    }

    /**
     * Set challenge
     */
    public function setChallenge(string $challenge): void
    {
        $this->challenge = $challenge;
    }

    /**
     * Get captcha ID
     */
    public function getCaptchaId(): ?string
    {
        return $this->captchaId;
    }

    /**
     * Set captcha ID
     */
    public function setCaptchaId($value): void
    {
        $this->captchaId = $value;
    }

    /**
     * Get GeeTest getLib URL
     */
    public function getGeeTestGetLib(): ?string
    {
        return $this->geeTestGetLib;
    }

    /**
     * Set GeeTest getLib URL
     */
    public function setGeeTestGetLib(string $geeTestGetLib): void
    {
        $this->geeTestGetLib = $geeTestGetLib;
    }

    /**
     * Get version
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Set version
     */
    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    /**
     * Get init parameters
     */
    public function getInitParameters(): ?string
    {
        return $this->initParameters;
    }

    /**
     * Set init parameters
     */
    public function setInitParameters(string $initParameters): void
    {
        $this->initParameters = $initParameters;
    }
}
