<?php

/**
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/thephpleague/oauth2-server
 */

declare(strict_types=1);

namespace League\OAuth2\Server;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestAccessTokenEvent extends RequestEvent
{
    /**
     * @var AccessTokenEntityInterface
     */
    private $accessToken;

    /**
     */
    public function __construct(string $name, ServerRequestInterface $request, AccessTokenEntityInterface $accessToken)
    {
        parent::__construct($name, $request);
        $this->accessToken = $accessToken;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAccessToken(): AccessTokenEntityInterface
    {
        return $this->accessToken;
    }
}
