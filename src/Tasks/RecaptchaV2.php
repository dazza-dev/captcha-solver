<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\Interfaces\CaptchaTaskProtocol;
use DazzaDev\CaptchaSolver\Traits\CaptchaSolverTrait;
use DazzaDev\CaptchaSolver\Traits\ProxyTrait;

class RecaptchaV2 extends CaptchaSolver implements CaptchaTaskProtocol
{
    use CaptchaSolverTrait, ProxyTrait;

    private $pageAction;

    private $apiDomain;

    public function getPostData(): array
    {
        $postData = [
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
            'isInvisible' => $this->isInvisible,
        ];

        if (! empty($this->proxy)) {
            $postData['type'] = 'ReCaptchaV2Task';
            $postData['proxy'] = $this->proxy;
        } else {
            $postData['type'] = 'ReCaptchaV2TaskProxyLess';
        }

        if ($this->pageAction) {
            $postData['pageAction'] = $this->pageAction;
        }

        if ($this->apiDomain) {
            $postData['apiDomain'] = $this->apiDomain;
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

    public function setPageAction($value)
    {
        $this->pageAction = $value;
    }

    public function setApiDomain($value)
    {
        $this->apiDomain = $value;
    }
}
