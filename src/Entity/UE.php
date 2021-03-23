<?php

namespace App\Entity;

use App\Repository\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UERepository::class)
 */
class UE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $CodeApogee;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Inscription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ValideNote;

    /**
     * @ORM\Column(type="integer")
     */
    private $ECTS;

    /**
     * @ORM\ManyToMany(targetEntity=FichePeda::class, mappedBy="UEs")
     */
    private $fichePedas;

    public function __construct()
    {
        $this->fichePedas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeApogee(): ?string
    {
        return $this->CodeApogee;
    }

    public function setCodeApogee(string $CodeApogee): self
    {
        $this->CodeApogee = $CodeApogee;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getInscription(): ?bool
    {
        return $this->Inscription;
    }

    public function setInscription(bool $Inscription): self
    {
        $this->Inscription = $Inscription;

        return $this;
    }

    public function getValideNote(): ?int
    {
        return $this->ValideNote;
    }

    public function setValideNote(?int $ValideNote): self
    {
        $this->ValideNote = $ValideNote;

        return $this;
    }

    public function getECTS(): ?int
    {
        return $this->ECTS;
    }

    public function setECTS(int $ECTS): self
    {
        $this->ECTS = $ECTS;

        return $this;
    }

    /**
     * @return Collection|FichePeda[]
     */
    public function getFichePedas(): Collection
    {
        return $this->fichePedas;
    }

    public function addFichePeda(FichePeda $fichePeda): self
    {
        if (!$this->fichePedas->contains($fichePeda)) {
            $this->fichePedas[] = $fichePeda;
            $fichePeda->addUE($this);
        }

        return $this;
    }

    public function removeFichePeda(FichePeda $fichePeda): self
    {
        if ($this->fichePedas->removeElement($fichePeda)) {
            $fichePeda->removeUE($this);
        }

        return $this;
    }
}
