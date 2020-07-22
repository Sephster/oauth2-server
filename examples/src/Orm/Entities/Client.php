<?php

namespace OAuth2ServerExamples\Orm\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client Doctrine Entity
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity
 */
class Client
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length="255")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length="255")
     */
    private $secret;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect_uri", type="string", length="255")
     */
    private $redirectUri;

    /**
     * @var bool
     *
     * @ORM\Column(name="confidential", type="boolean", nullable=false)
     */
    private $confidential;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function setRedirectUri($redirectUri)
    {
        $this->redirectUri = $redirectUri;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    public function setConfidential($confidential)
    {
        $this->confidential = $confidential;
    }

    public function getConfidential()
    {
        return $this->confidential;
    }
}
