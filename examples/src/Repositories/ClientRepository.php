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
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use OAuth2ServerExamples\Entities\ClientEntity;

class ClientRepository implements ClientRepositoryInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
       $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function getClientEntity($clientIdentifier)
    {
        return $this->em->getRepository(ClientEntity::class)->find($clientIdentifier);
    }

    /**
     * {@inheritdoc}
     */
    public function validateClient($clientIdentifier, $clientSecret, $grantType)
    {
        $client = $this->em->getRepository(ClientEntity::class)->find($clientIdentifier);

        if ($client === null) {
            return false;
        }

        if ($client->isConfidential() && \password_verify($clientSecret, $client->getSecret()) === false) {
            return false;
        }

        return true;
    }
}
