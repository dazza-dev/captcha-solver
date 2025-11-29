<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class RecaptchaV3Enterprise extends Task
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
            'minScore' => $this->getMinScore(),
            'apiDomain' => $this->getApiDomain(),
            'userAgent' => $this->getUserAgent(),
            'cookies' => $this->getCookies(),
        ];

        if (! empty($this->getProxy())) {
            $postData['type'] = 'ReCaptchaV3EnterpriseTask';
            $postData['proxy'] = $this->getProxy();
        } else {
            $postData['type'] = 'ReCaptchaV3EnterpriseTaskProxyLess';
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
