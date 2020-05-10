<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierVisiteRepository")
 */
class DossierVisite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id",type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $date_arrive_invitation;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $date_fin;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $date_limite_reponce;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sujet;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $type_visite;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrParticipant_INS;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrParticipant_SP;

    /**
     * @ORM\Column(type="boolean")
     */
    private $frais_transport;

    /**
     * @ORM\Column(type="boolean")
     */
    private $frais_residence;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langues;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PaysDestination", inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=true)
     */
    private $paysDestination;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrganismeEtranger", inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organismeEtranger;

    /**
     * @ORM\ManyToMany(targetEntity="CadreINS")
     * @ORM\JoinTable(name="Participation",
     *      joinColumns={@ORM\JoinColumn(name="visite_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="cadre_id", referencedColumnName="id")}
     *      )
     */
    private $participation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateArriveInvitation(): ?string
    {
        return $this->date_arrive_invitation;
    }

    public function setDateArriveInvitation(string $date_arrive_invitation): self
    {
        $this->date_arrive_invitation = $date_arrive_invitation;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->date_debut;
    }

    public function setDateDebut(string $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->date_fin;
    }

    public function setDateFin(string $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getDateLimiteReponce(): ?string
    {
        return $this->date_limite_reponce;
    }

    public function setDateLimiteReponce(string $date_limite_reponce): self
    {
        $this->date_limite_reponce = $date_limite_reponce;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getTypeVisite(): ?string
    {
        return $this->type_visite;
    }

    public function setTypeVisite(string $type_visite): self
    {
        $this->type_visite = $type_visite;

        return $this;
    }

    public function getNbrParticipantINS(): ?int
    {
        return $this->nbrParticipant_INS;
    }

    public function setNbrParticipantINS(int $nbrParticipant_INS): self
    {
        $this->nbrParticipant_INS = $nbrParticipant_INS;

        return $this;
    }

    public function getNbrParticipantSP(): ?int
    {
        return $this->nbrParticipant_SP;
    }

    public function setNbrParticipantSP(int $nbrParticipant_SP): self
    {
        $this->nbrParticipant_SP = $nbrParticipant_SP;

        return $this;
    }

    public function getFraisTransport(): ?bool
    {
        return $this->frais_transport;
    }

    public function setFraisTransport(bool $frais_transport): self
    {
        $this->frais_transport = $frais_transport;

        return $this;
    }

    public function getFraisResidence(): ?bool
    {
        return $this->frais_residence;
    }

    public function setFraisResidence(bool $frais_residence): self
    {
        $this->frais_residence = $frais_residence;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getLangues(): ?string
    {
        return $this->langues;
    }

    public function setLangues(string $langues): self
    {
        $this->langues = $langues;

        return $this;
    }

    public function getPaysDestination(): ?PaysDestination
    {
        return $this->paysDestination;
    }

    public function setPaysDestination(?PaysDestination $paysDestination): self
    {
        $this->paysDestination = $paysDestination;

        return $this;
    }

    public function getOrganismeEtranger(): ?OrganismeEtranger
    {
        return $this->organismeEtranger;
    }

    public function setOrganismeEtranger(?OrganismeEtranger $organismeEtranger): self
    {
        $this->organismeEtranger = $organismeEtranger;

        return $this;
    }

    public function addParticipation(CadreINS $cadre){
        $this->participation[] = $cadre;
    }

    public function getParticipation(){
        return $this->participation;
    }

}
