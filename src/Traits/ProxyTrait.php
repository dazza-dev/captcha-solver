<?php

namespace DazzaDev\CaptchaSolver\Traits;

trait ProxyTrait
{
    private string $proxy;

    private string $proxyType = 'http';

    private string $proxyAddress;

    private string $proxyPort;

    private string $proxyLogin;

    private string $proxyPassword;

    /**
     * Set proxy
     */
    public function setProxy(string $value): void
    {
        $this->proxy = $value;
    }

    /**
     * Set proxy type
     */
    public function setProxyType(string $value): void
    {
        $this->proxyType = $value;
    }

    /**
     * Set proxy address
     */
    public function setProxyAddress(string $value): void
    {
        $this->proxyAddress = $value;
    }

    /**
     * Set proxy port
     */
    public function setProxyPort(string $value): void
    {
        $this->proxyPort = $value;
    }

    /**
     * Set proxy login
     */
    public function setProxyLogin(string $value): void
    {
        $this->proxyLogin = $value;
    }

    /**
     * Set proxy password
     */
    public function setProxyPassword(string $value): void
    {
        $this->proxyPassword = $value;
    }
}
