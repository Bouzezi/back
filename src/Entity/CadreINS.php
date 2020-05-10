<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CadreINSRepository")
 */
class CadreINS
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id",type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $grade;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $fonction;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DirectionCentrale", inversedBy="cadres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $directionCentrale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDirectionCentrale(): ?DirectionCentrale
    {
        return $this->directionCentrale;
    }

    public function setDirectionCentrale(?DirectionCentrale $directionCentrale): self
    {
        $this->directionCentrale = $directionCentrale;

        return $this;
    }
}
