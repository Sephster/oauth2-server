<?php

namespace OAuth2ServerExamples\Orm\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Access Token Doctrine Entity
 *
 * @ORM\Table(name="access_tokens")
 * @ORM\Entity
 */
class AccessToken
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer" nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="scopes", type="string", length="255")
     */
    private $scopes;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="expiry_date_time", type="datetime_immutable", nullable=false)
     */
    private $expiryDateTime;

    /**
     * @var bool
     *
     * @ORM\Column(name="revoked", type="boolean", nullable=false)
     */
    private $revoked;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    public function setExpiryDateTime($expiryDateTime)
    {
        $this->expiryDateTime = $expiryDateTime;
    }

    public function getExpiryDateTime()
    {
        return $this->expiryDateTime;
    }

    public function setRevoked($revoked)
    {
        $this->revoked = $revoked;
    }

    public function getRevoked()
    {
        return $this->revoked;
    }
}
