<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\CaptchaTaskProtocol;
use DazzaDev\CaptchaSolver\Traits\CaptchaSolverTrait;
use DazzaDev\CaptchaSolver\Traits\ProxyTrait;

class NoCaptcha extends CaptchaSolver implements CaptchaTaskProtocol
{
    use CaptchaSolverTrait, ProxyTrait;

    private $websiteSToken;

    private $recaptchaDataSValue;

    public function getPostData()
    {
        $postData = [
            'type' => ($this->proxyAddress) ? 'NoCaptchaTask' : 'NoCaptchaTaskProxyless',
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
        ];

        if ($this->websiteSToken) {
            $postData['websiteSToken'] = $this->websiteSToken;
        }

        if ($this->recaptchaDataSValue) {
            $postData['recaptchaDataSValue'] = $this->recaptchaDataSValue;
        }

        if ($this->proxyType) {
            $postData['proxyType'] = $this->proxyType;
        }

        if ($this->proxyAddress) {
            $postData['proxyAddress'] = $this->proxyAddress;
        }

        if ($this->proxyPort) {
            $postData['proxyPort'] = $this->proxyPort;
        }

        if ($this->proxyLogin) {
            $postData['proxyLogin'] = $this->proxyLogin;
        }

        if ($this->proxyPassword) {
            $postData['proxyPassword'] = $this->proxyPassword;
        }

        if ($this->userAgent) {
            $postData['userAgent'] = $this->userAgent;
        }

        if ($this->cookies) {
            $postData['cookies'] = $this->cookies;
        }

        return $postData;
    }

    public function getTaskSolution()
    {
        return $this->taskInfo->solution->gRecaptchaResponse;
    }

    public function setRecaptchaDataSValue($value)
    {
        $this->recaptchaDataSValue = $value;
    }

    public function setWebsiteSToken($value)
    {
        $this->websiteSToken = $value;
    }
}
