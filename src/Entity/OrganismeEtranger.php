<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganismeEtrangerRepository")
 */
class OrganismeEtranger
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $libelle_org;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleOrg(): ?string
    {
        return $this->libelle_org;
    }

    public function setLibelleOrg(string $libelle_org): self
    {
        $this->libelle_org = $libelle_org;

        return $this;
    }
}
