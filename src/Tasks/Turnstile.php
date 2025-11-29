<?php

namespace DazzaDev\CaptchaSolver\Tasks;

class Turnstile extends Task
{
    /**
     * Get post data for captcha solver API
     */
    public function getPostData(): array
    {
        $postData = [
            'type' => ($this->getProxyAddress()) ? 'TurnstileTask' : 'TurnstileTaskProxyless',
            'websiteURL' => $this->getWebsiteUrl(),
            'websiteKey' => $this->getWebsiteKey(),
        ];

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
