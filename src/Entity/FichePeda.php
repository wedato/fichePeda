<?php

namespace App\Entity;

use App\Repository\FichePedaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FichePedaRepository::class)
 */
class FichePeda
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numEtu;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressePostal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numPortable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $rse;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $typeControlTerminalRse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $redoublantAjac;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $semDejaObtenu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tierTemps;

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

    public function getNumEtu(): ?string
    {
        return $this->numEtu;
    }

    public function setNumEtu(string $numEtu): self
    {
        $this->numEtu = $numEtu;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdressePostal(): ?string
    {
        return $this->adressePostal;
    }

    public function setAdressePostal(string $adressePostal): self
    {
        $this->adressePostal = $adressePostal;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getNumPortable(): ?string
    {
        return $this->numPortable;
    }

    public function setNumPortable(string $numPortable): self
    {
        $this->numPortable = $numPortable;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getRse(): ?bool
    {
        return $this->rse;
    }

    public function setRse(bool $rse): self
    {
        $this->rse = $rse;

        return $this;
    }

    public function getTypeControlTerminalRse(): ?bool
    {
        return $this->typeControlTerminalRse;
    }

    public function setTypeControlTerminalRse(?bool $typeControlTerminalRse): self
    {
        $this->typeControlTerminalRse = $typeControlTerminalRse;

        return $this;
    }

    public function getRedoublantAjac(): ?bool
    {
        return $this->redoublantAjac;
    }

    public function setRedoublantAjac(bool $redoublantAjac): self
    {
        $this->redoublantAjac = $redoublantAjac;

        return $this;
    }

    public function getSemDejaObtenu(): ?int
    {
        return $this->semDejaObtenu;
    }

    public function setSemDejaObtenu(?int $semDejaObtenu): self
    {
        $this->semDejaObtenu = $semDejaObtenu;

        return $this;
    }

    public function getTierTemps(): ?bool
    {
        return $this->tierTemps;
    }

    public function setTierTemps(?bool $tierTemps): self
    {
        $this->tierTemps = $tierTemps;

        return $this;
    }
}
