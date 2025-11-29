<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class RecaptchaV3 extends Task
{
    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'websiteURL' => $this->getWebsiteURL(),
            'websiteKey' => $this->getWebsiteKey(),
            'pageAction' => $this->getPageAction(),
            'minScore' => $this->getMinScore(),
            'apiDomain' => $this->getApiDomain(),
        ];

        if (! empty($this->getProxy())) {
            $postData['type'] = 'ReCaptchaV3Task';
            $postData['proxy'] = $this->getProxy();
        } else {
            $postData['type'] = 'ReCaptchaV3TaskProxyLess';
        }

        if ($this->getIsEnterprise()) {
            $postData['isEnterprise'] = $this->getIsEnterprise();
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
}
