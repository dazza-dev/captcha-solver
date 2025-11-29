<?php

namespace DazzaDev\CaptchaSolver\Tasks;

abstract class Task implements CaptchaTaskProtocol
{
    /**
     * Task info
     */
    private ?object $taskInfo = null;

    /**
     * Website URL
     */
    private ?string $websiteUrl = null;

    /**
     * Website key
     */
    private ?string $websiteKey = null;

    /**
     * API subdomain
     */
    private ?string $apiSubdomain = null;

    /**
     * Page action
     */
    private ?string $pageAction = null;

    /**
     * Minimum score
     */
    private ?float $minScore = null;

    /**
     * Api domain
     */
    private ?string $apiDomain = null;

    /**
     * Is enterprise
     */
    private bool $isEnterprise = false;

    /**
     * Enterprise payload
     */
    private ?string $enterprisePayload = null;

    /**
     * Data
     */
    private ?string $data = null;

    /**
     * Is invisible
     */
    private bool $isInvisible = false;

    /**
     * User agent
     */
    private ?string $userAgent = null;

    /**
     * Cookies
     */
    private ?string $cookies = null;

    /**
     * Proxy
     */
    private ?string $proxy = null;

    /**
     * Proxy type
     */
    private string $proxyType = 'http';

    /**
     * Proxy address
     */
    private ?string $proxyAddress = null;

    /**
     * Proxy port
     */
    private ?string $proxyPort = null;

    /**
     * Proxy login
     */
    private ?string $proxyLogin = null;

    /**
     * Proxy password
     */
    private ?string $proxyPassword = null;

    /**
     * Get post data for captcha solver API
     */
    abstract public function getPostData(): array;

    /**
     * Get task solution
     */
    abstract public function getTaskSolution(): ?string;

    /**
     * Get task info
     */
    public function getTaskInfo(): ?object
    {
        return $this->taskInfo;
    }

    /**
     * Set task info
     */
    public function setTaskInfo(object $taskInfo): void
    {
        $this->taskInfo = $taskInfo;
    }

    /**
     * Get website URL
     */
    public function getWebsiteURL(): ?string
    {
        return $this->websiteUrl;
    }

    /**
     * Set website URL
     */
    public function setWebsiteURL(string $websiteUrl): void
    {
        $this->websiteUrl = $websiteUrl;
    }

    /**
     * Get website key
     */
    public function getWebsiteKey(): ?string
    {
        return $this->websiteKey;
    }

    /**
     * Set website key
     */
    public function setWebsiteKey(string $websiteKey): void
    {
        $this->websiteKey = $websiteKey;
    }

    /**
     * Get API subdomain
     */
    public function getAPISubdomain(): ?string
    {
        return $this->apiSubdomain;
    }

    /**
     * Set API subdomain
     */
    public function setAPISubdomain(string $apiSubdomain): void
    {
        $this->apiSubdomain = $apiSubdomain;
    }

    /**
     * Get page action
     */
    public function getPageAction(): ?string
    {
        return $this->pageAction;
    }

    /**
     * Set pageAction
     */
    public function setPageAction($value): void
    {
        $this->pageAction = $value;
    }

    /**
     * Get minScore
     */
    public function getMinScore(): ?float
    {
        return $this->minScore;
    }

    /**
     * Set minScore
     */
    public function setMinScore($value): void
    {
        $this->minScore = $value;
    }

    /**
     * Get apiDomain
     */
    public function getApiDomain(): ?string
    {
        return $this->apiDomain;
    }

    /**
     * Set apiDomain
     */
    public function setApiDomain($value): void
    {
        $this->apiDomain = $value;
    }

    /**
     * Get is enterprise
     */
    public function getIsEnterprise(): bool
    {
        return $this->isEnterprise;
    }

    /**
     * Set isEnterprise
     */
    public function setIsEnterprise($value): void
    {
        $this->isEnterprise = $value;
    }

    /**
     * Get enterprise payload
     */
    public function getEnterprisePayload(): ?string
    {
        return $this->enterprisePayload;
    }

    /**
     * Set enterprisePayload
     */
    public function setEnterprisePayload($value): void
    {
        $this->enterprisePayload = $value;
    }

    /**
     * Get data
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * Set data
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }

    /**
     * Get is invisible
     */
    public function getIsInvisible(): bool
    {
        return $this->isInvisible;
    }

    /**
     * Set is invisible
     */
    public function setIsInvisible(bool $isInvisible): void
    {
        $this->isInvisible = $isInvisible;
    }

    /**
     * Get user agent
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * Set user agent
     */
    public function setUserAgent(string $userAgent): void
    {
        $this->userAgent = $userAgent;
    }

    /**
     * Get cookies
     */
    public function getCookies(): ?string
    {
        return $this->cookies;
    }

    /**
     * Set cookies
     */
    public function setCookies(string $cookies): void
    {
        $this->cookies = $cookies;
    }

    /**
     * Get proxy
     */
    public function getProxy(): ?string
    {
        return $this->proxy;
    }

    /**
     * Set proxy
     */
    public function setProxy(string $proxy): void
    {
        $this->proxy = $proxy;
    }

    /**
     * Get proxy type
     */
    public function getProxyType(): string
    {
        return $this->proxyType;
    }

    /**
     * Set proxy type
     */
    public function setProxyType(string $proxyType): void
    {
        $this->proxyType = $proxyType;
    }

    /**
     * Get proxy address
     */
    public function getProxyAddress(): ?string
    {
        return $this->proxyAddress;
    }

    /**
     * Set proxy address
     */
    public function setProxyAddress(string $proxyAddress): void
    {
        $this->proxyAddress = $proxyAddress;
    }

    /**
     * Get proxy port
     */
    public function getProxyPort(): ?string
    {
        return $this->proxyPort;
    }

    /**
     * Set proxy port
     */
    public function setProxyPort(string $proxyPort): void
    {
        $this->proxyPort = $proxyPort;
    }

    /**
     * Get proxy login
     */
    public function getProxyLogin(): ?string
    {
        return $this->proxyLogin;
    }

    /**
     * Set proxy login
     */
    public function setProxyLogin(string $proxyLogin): void
    {
        $this->proxyLogin = $proxyLogin;
    }

    /**
     * Get proxy password
     */
    public function getProxyPassword(): ?string
    {
        return $this->proxyPassword;
    }

    /**
     * Set proxy password
     */
    public function setProxyPassword(string $proxyPassword): void
    {
        $this->proxyPassword = $proxyPassword;
    }
}
