<?php

namespace OAuth2ServerExamples\Orm\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Scope Doctrine Entity
 *
 * @ORM\Table(name="scopes")
 * @ORM\Entity
 */
class Scope
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
     * @ORM\Column(name="identifier" type="string", length="255")
     */
    private $identifier;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length="255)
     */
    private $description;
}
