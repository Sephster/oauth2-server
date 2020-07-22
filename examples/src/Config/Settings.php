<?php

namespace OAuth2ServerExamples\Config;

class Settings
{
    public function __invoke()
    {
        $rootPath = dirname(__DIR__ . '/..');

        return [
            'di_compilation_path' => __DIR__ . '/../var/cache', // TODO: check usage
            'display_error_details' => false, // TODO: check usage
            doctrine => [
                'meta' => [
                    'entity_path' => [$rootPath . '/Entities'],
                    'auto_generated_proxies' => true,
                    'proxy_dir' => $rootPath . '/var/cache/proxies',
                    'cache' => null,
                ],
                'connection' => [
                    'driver' => 'pdo_sqlite',
                    'memory' => true,
                ],
            ],
        ];
    }
}