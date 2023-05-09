<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
#[ORM\Table(name: 'reservation')]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateFin = null;

    #[ORM\ManyToOne(inversedBy: 'rServations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Logement $idLogement = null;

    #[ORM\ManyToOne(inversedBy: 'rServations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $IdLocataire = null;

    #[ORM\ManyToOne(inversedBy: 'rServations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $IdProprietaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->DateDebut;
    }

    public function setDateDebut(\DateTimeInterface $DateDebut): self
    {
        $this->DateDebut = $DateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->DateFin;
    }

    public function setDateFin(\DateTimeInterface $DateFin): self
    {
        $this->DateFin = $DateFin;

        return $this;
    }

    public function getIdLogement(): ?Logement
    {
        return $this->idLogement;
    }

    public function setIdLogement(?Logement $idLogement): self
    {
        $this->idLogement = $idLogement;

        return $this;
    }

    public function getIdLocataire(): ?Compte
    {
        return $this->IdLocataire;
    }

    public function setIdLocataire(?Compte $IdLocataire): self
    {
        $this->IdLocataire = $IdLocataire;

        return $this;
    }

    public function getIdProprietaire(): ?Compte
    {
        return $this->IdProprietaire;
    }

    public function setIdProprietaire(?Compte $IdProprietaire): self
    {
        $this->IdProprietaire = $IdProprietaire;

        return $this;
    }
}
