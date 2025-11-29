<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class RecaptchaV2Enterprise extends Task
{
    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'websiteURL' => $this->getWebsiteUrl(),
            'websiteKey' => $this->getWebsiteKey(),
            'pageAction' => $this->getPageAction(),
            'enterprisePayload' => $this->getEnterprisePayload(),
            'isInvisible' => $this->getIsInvisible(),
            'apiDomain' => $this->getApiDomain(),
        ];

        if (! empty($this->getProxy())) {
            $postData['type'] = 'ReCaptchaV2EnterpriseTask';
            $postData['proxy'] = $this->getProxy();
        } else {
            $postData['type'] = 'ReCaptchaV2EnterpriseTaskProxyLess';
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
