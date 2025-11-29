<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class NoCaptcha extends Task
{
    /**
     * Website S Token
     */
    private ?string $websiteSToken = null;

    /**
     * Recaptcha data S value
     */
    private ?string $recaptchaDataSValue = null;

    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'type' => ($this->getProxyAddress()) ? 'NoCaptchaTask' : 'NoCaptchaTaskProxyless',
            'websiteURL' => $this->getWebsiteUrl(),
            'websiteKey' => $this->getWebsiteKey(),
        ];

        if ($this->getWebsiteSToken()) {
            $postData['websiteSToken'] = $this->getWebsiteSToken();
        }

        if ($this->getRecaptchaDataSValue()) {
            $postData['recaptchaDataSValue'] = $this->getRecaptchaDataSValue();
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
        return $this->getTaskInfo()->solution->gRecaptchaResponse;
    }

    /**
     * Get recaptchaDataSValue
     */
    public function getRecaptchaDataSValue(): ?string
    {
        return $this->recaptchaDataSValue;
    }

    /**
     * Set recaptchaDataSValue
     */
    public function setRecaptchaDataSValue(?string $recaptchaDataSValue): void
    {
        $this->recaptchaDataSValue = $recaptchaDataSValue;
    }

    /**
     * Get websiteSToken
     */
    public function getWebsiteSToken(): ?string
    {
        return $this->websiteSToken;
    }

    /**
     * Set websiteSToken
     */
    public function setWebsiteSToken(?string $websiteSToken): void
    {
        $this->websiteSToken = $websiteSToken;
    }
}
