<?php

namespace OAuth2ServerExamples\Config;

use Slim\App;

class Routes
{
    public function __invoke(App $app)
    {
        $app->get('access-token', function () {
            return 'hello';
        });
    }
}
