<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DossierVisite", mappedBy="organismeEtranger")
     */
    private $dossiers;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
    }

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

    /**
     * @return Collection|DossierVisite[]
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(DossierVisite $dossier): self
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers[] = $dossier;
            $dossier->setOrganismeEtranger($this);
        }

        return $this;
    }

    public function removeDossier(DossierVisite $dossier): self
    {
        if ($this->dossiers->contains($dossier)) {
            $this->dossiers->removeElement($dossier);
            // set the owning side to null (unless already changed)
            if ($dossier->getOrganismeEtranger() === $this) {
                $dossier->setOrganismeEtranger(null);
            }
        }

        return $this;
    }
}
