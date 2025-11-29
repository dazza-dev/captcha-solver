<?php

namespace DazzaDev\CaptchaSolver;

use DazzaDev\CaptchaSolver\Exceptions\CaptchaSolverException;

class ServiceResolver
{
    /**
     * Mapping of service names to their respective API hosts
     */
    private static array $serviceHosts = [
        'anticaptcha' => 'api.anti-captcha.com',
        'capmonster' => 'api.capmonster.cloud',
        'capsolver' => 'api.capsolver.com',
    ];

    /**
     * Resolve host URL from service name
     *
     * @throws CaptchaSolverException
     */
    public static function resolveHost(string $service): string
    {
        $normalizedService = strtolower(trim($service));

        if (! isset(self::$serviceHosts[$normalizedService])) {
            $availableServices = implode(', ', array_keys(self::$serviceHosts));
            throw new CaptchaSolverException("Unsupported service '{$service}'. Available services: {$availableServices}");
        }

        return self::$serviceHosts[$normalizedService];
    }

    /**
     * Get list of supported services
     */
    public static function getSupportedServices(): array
    {
        return array_keys(self::$serviceHosts);
    }

    /**
     * Check if a service is supported
     */
    public static function isServiceSupported(string $service): bool
    {
        return isset(self::$serviceHosts[strtolower(trim($service))]);
    }

    /**
     * Get all service host mappings
     */
    public static function getAllServices(): array
    {
        return self::$serviceHosts;
    }
}
