<?php

namespace DazzaDev\CaptchaSolver\Tasks;

use DazzaDev\CaptchaSolver\CaptchaSolver;
use DazzaDev\CaptchaSolver\CaptchaTaskProtocol;
use DazzaDev\CaptchaSolver\Traits\CaptchaSolverTrait;
use DazzaDev\CaptchaSolver\Traits\ProxyTrait;

class RecaptchaV3Enterprise extends CaptchaSolver implements CaptchaTaskProtocol
{
    use CaptchaSolverTrait, ProxyTrait;

    private $pageAction;

    private $enterprisePayload;

    private $minScore;

    private $apiDomain;

    public function getPostData()
    {
        $postData = [
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
            'pageAction' => $this->pageAction,
            'enterprisePayload' => $this->enterprisePayload,
            'minScore' => $this->minScore,
            'apiDomain' => $this->apiDomain,
            'userAgent' => $this->userAgent,
            'cookies' => $this->cookies,
        ];

        if (! empty($this->proxy)) {
            $postData['type'] = 'ReCaptchaV3EnterpriseTask';
            $postData['proxy'] = $this->proxy;
        } else {
            $postData['type'] = 'ReCaptchaV3EnterpriseTaskProxyLess';
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

    public function setMinScore($value)
    {
        $this->minScore = $value;
    }

    public function setApiDomain($value)
    {
        $this->apiDomain = $value;
    }
}
