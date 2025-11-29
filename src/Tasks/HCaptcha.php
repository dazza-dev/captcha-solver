<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class HCaptcha extends Task
{
    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'type' => ($this->getProxyAddress()) ? 'HCaptchaTask' : 'HCaptchaTaskProxyless',
            'websiteURL' => $this->getWebsiteUrl(),
            'websiteKey' => $this->getWebsiteKey(),
        ];

        if ($this->getIsInvisible()) {
            $postData['isInvisible'] = $this->getIsInvisible();
        }

        if ($this->getData()) {
            $postData['data'] = $this->getData();
        }

        if ($this->getProxyType()) {
            $postData['proxyType'] = $this->getProxyType();
        }

        if ($this->getProxyAddress()) {
            $postData['proxyAddress'] = $this->getProxyAddress();
        }

        if ($this->getProxyPort()) {
            $postData['proxyPort'] = $this->getProxyPort();
        }

        if ($this->getProxyLogin()) {
            $postData['proxyLogin'] = $this->getProxyLogin();
        }

        if ($this->getProxyPassword()) {
            $postData['proxyPassword'] = $this->getProxyPassword();
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
        return $this->getTaskInfo()->solution->token;
    }
}
