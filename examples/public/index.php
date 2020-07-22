<?php

use DI\ContainerBuilder;
use OAuth2ServerExamples\Config\Dependencies;
use OAuth2ServerExamples\Config\Routes;
use OAuth2ServerExamples\Config\Settings;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$settings = new Settings();

$containerBuilder = new ContainerBuilder();
$dependencies = new Dependencies();

$dependencies($containerBuilder, $settings);

AppFactory::setContainer($containerBuilder->build());

$app = AppFactory::create();

$routes = new Routes();

$routes($app);
