<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\CaptchaTaskProtocol;
use DazzaDev\CaptchaSolver\Traits\CaptchaSolverTrait;
use DazzaDev\CaptchaSolver\Traits\ProxyTrait;

class HCaptcha extends CaptchaSolver implements CaptchaTaskProtocol
{
    use CaptchaSolverTrait, ProxyTrait;

    private $data;

    public function getPostData()
    {
        $postData = [
            'type' => ($this->proxyAddress) ? 'HCaptchaTask' : 'HCaptchaTaskProxyless',
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
        ];

        if ($this->isInvisible) {
            $postData['isInvisible'] = $this->isInvisible;
        }

        if ($this->data) {
            $postData['data'] = $this->data;
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
        return $this->taskInfo->solution->token;
    }

    public function setData($value)
    {
        $this->data = $value;
    }
}
