<?php

namespace OAuth2ServerExamples\Config;

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use OAuth2ServerExamples\Repositories\AccessTokenRepository;
use OAuth2ServerExamples\Repositories\ClientRepository;
use OAuth2ServerExamples\Repositories\ScopeRepository;
use Psr\Container\ContainerInterface;

class Dependencies
{
    public function __invoke(ContainerBuilder $containerBuilder, array $settings)
    {
        $containerBuilder->addDefinitions([
            'settings' => $settings,
            'entityManager' => static function (ContainerInterface $c) {
                $settings = $c->get('settings');

                $config = Setup::createXMLMetadataConfiguration(
                    $settings['doctrine']['meta']['entity_path'], //TODO: Change this to mapping path or something similar
                    $settings['doctrine']['meta']['auto_generated_proxies'],
                    $settings['doctrine']['meta']['proxy_dir'],
                    $settings['doctrine']['meta']['cache'],
                );

                return EntityManager::create($settings['doctrine']['connection'], $config);
            },
            AuthorizationServer::class => static function () {
                $clientRepository = new ClientRepository();
                $accessTokenRepository = new AccessTokenRepository();
                $scopeRepository = new ScopeRepository();

                $privateKey = 'file://' . __DIR__ . '/../private.key';

                $server = new AuthorizationServer(
                    $clientRepository,
                    $accessTokenRepository,
                    $scopeRepository,
                    $privateKey,
                    'lxZFUEsBCJ2Yb14IF2ygAHI5N4+ZAUXXaSeeJm6+twsUmIen'
                );

                $server->enableGrantType(
                    ClientCredentialsGrant::class,
                    new \DateInterval('PT1H') // TODO: Check if we can instantiate this differently
                );

                return $server;
            }
        ]);
    }
}
