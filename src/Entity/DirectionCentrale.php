<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DirectionCentraleRepository")
 */
class DirectionCentrale
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $libelle_direction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleDirection(): ?string
    {
        return $this->libelle_direction;
    }

    public function setLibelleDirection(string $libelle_direction): self
    {
        $this->libelle_direction = $libelle_direction;

        return $this;
    }
}
