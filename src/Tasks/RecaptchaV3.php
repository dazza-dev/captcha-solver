<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\CaptchaTaskProtocol;
use DazzaDev\CaptchaSolver\Traits\CaptchaSolverTrait;
use DazzaDev\CaptchaSolver\Traits\ProxyTrait;

class RecaptchaV3 extends CaptchaSolver implements CaptchaTaskProtocol
{
    use CaptchaSolverTrait, ProxyTrait;

    private $pageAction;

    private $minScore;

    private $apiDomain;

    private $isEnterprise = false;

    public function getPostData()
    {
        $postData = [
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
            'pageAction' => $this->pageAction,
            'minScore' => $this->minScore,
            'apiDomain' => $this->apiDomain,
        ];

        if (! empty($this->proxy)) {
            $postData['type'] = 'ReCaptchaV3Task';
            $postData['proxy'] = $this->proxy;
        } else {
            $postData['type'] = 'ReCaptchaV3TaskProxyLess';
        }

        if ($this->isEnterprise) {
            $postData['isEnterprise'] = $this->isEnterprise;
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

    public function setMinScore($value)
    {
        $this->minScore = $value;
    }

    public function setApiDomain($value)
    {
        $this->apiDomain = $value;
    }

    public function setIsEnterprise($value)
    {
        $this->isEnterprise = $value;
    }
}
