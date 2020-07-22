<?php
/**
 * @author      Alex Bilbie <hello@alexbilbie.com>
 * @copyright   Copyright (c) Alex Bilbie
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/thephpleague/oauth2-server
 */

namespace OAuth2ServerExamples\Repositories;

use Doctrine\ORM\EntityManagerInterface;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use OAuth2ServerExamples\Entities\AccessTokenEntity;
use OAuth2ServerExamples\Orm\Entities\AccessToken;

class AccessTokenRepository implements AccessTokenRepositoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $accessToken = new AccessToken();

        $accessToken->setId($accessTokenEntity->getIdentifier());
        $accessToken->setUserId($accessTokenEntity->getUserIdentifier());
        $accessToken->setClientId($accessTokenEntity->getClient()->getIdentifier());
        $accessToken->setScopes($accessTokenEntity->getScopes()); // TODO: Convert to string!
        $accessToken->setExpiryDateTime($accessTokenEntity->getExpiryDateTime());
        $accessToken->setRevoked(false);

        $this->em->persist($accessToken);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function revokeAccessToken($tokenId)
    {
        $accessToken = $this->em->getRepository(AccessToken::class)->find($tokenId);

        $accessToken->setRevoked(true);

        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function isAccessTokenRevoked($tokenId)
    {
        $accessToken = $this->em->getRepository(AccessToken::class)->find($tokenId);

        return $accessToken->getRevoked();
    }

    /**
     * {@inheritdoc}
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new AccessTokenEntity($clientEntity, $scopes, $userIdentifier);
    }
}
