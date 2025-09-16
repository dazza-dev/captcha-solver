<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\CaptchaTaskProtocol;
use DazzaDev\CaptchaSolver\Traits\CaptchaSolverTrait;
use DazzaDev\CaptchaSolver\Traits\ProxyTrait;

class RecaptchaV2Enterprise extends CaptchaSolver implements CaptchaTaskProtocol
{
    use CaptchaSolverTrait, ProxyTrait;

    private $pageAction;

    private $enterprisePayload;

    private $apiDomain;

    public function getPostData()
    {
        $postData = [
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
            'pageAction' => $this->pageAction,
            'enterprisePayload' => $this->enterprisePayload,
            'isInvisible' => $this->isInvisible,
            'apiDomain' => $this->apiDomain,
        ];

        if (! empty($this->proxy)) {
            $postData['type'] = 'ReCaptchaV2EnterpriseTask';
            $postData['proxy'] = $this->proxy;
        } else {
            $postData['type'] = 'ReCaptchaV2EnterpriseTaskProxyLess';
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

    public function setEnterprisePayload($value)
    {
        $this->enterprisePayload = $value;
    }

    public function setApiDomain($value)
    {
        $this->apiDomain = $value;
    }
}
