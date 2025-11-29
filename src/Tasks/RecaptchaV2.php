<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class RecaptchaV2 extends Task
{
    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'websiteURL' => $this->getWebsiteURL(),
            'websiteKey' => $this->getWebsiteKey(),
            'isInvisible' => $this->getIsInvisible(),
        ];

        if (! empty($this->getProxy())) {
            $postData['type'] = 'ReCaptchaV2Task';
            $postData['proxy'] = $this->getProxy();
        } else {
            $postData['type'] = 'ReCaptchaV2TaskProxyLess';
        }

        if ($this->getPageAction()) {
            $postData['pageAction'] = $this->getPageAction();
        }

        if ($this->getApiDomain()) {
            $postData['apiDomain'] = $this->getApiDomain();
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
