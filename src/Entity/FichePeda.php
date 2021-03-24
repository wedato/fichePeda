<?php

namespace App\Entity;

use App\Repository\FichePedaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Le nom de famille est obligatoire ! ")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le prénom est obligatoire ! ")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le num étudiant est obligatoire ! ")
     */
    private $numEtu;

    /**
     * @ORM\Column(type="date")
     *
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="L'adresse postal est obligatoire ! ")
     */
    private $adressePostal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le num de tel est obligatoire ! ")
     */
    private $numTel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le num de portable est obligatoire ! ")
     */
    private $numPortable;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message="Email non valide "
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="boolean")
     *
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
     * @ORM\Column(type="boolean")
     */
    private $sem_deja_obtenu;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $tierTemps;

    /**
     * @ORM\ManyToMany(targetEntity=UE::class, inversedBy="fichePedas")
     * @Assert\NotBlank(message="Le nom de famille est obligatoire ! ")
     */
    private $UEs;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isAgree;


    public function __construct()
    {
        $this->UEs = new ArrayCollection();
    }

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

    public function getSemDejaObtenu(): ?bool
    {
        return $this->sem_deja_obtenu;
    }

    public function setSemDejaObtenu(bool $sem_deja_obtenu): self
    {
        $this->sem_deja_obtenu = $sem_deja_obtenu;

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

    /**
     * @return Collection|UE[]
     */
    public function getUEs(): Collection
    {
        return $this->UEs;
    }

    public function addUE(UE $uE): self
    {
        if (!$this->UEs->contains($uE)) {
            $this->UEs[] = $uE;
        }

        return $this;
    }

    public function removeUE(UE $uE): self
    {
        $this->UEs->removeElement($uE);

        return $this;
    }

    public function getIsAgree(): ?bool
    {
        return $this->isAgree;
    }

    public function setIsAgree(bool $isAgree): self
    {
        $this->isAgree = $isAgree;

        return $this;
    }
}
