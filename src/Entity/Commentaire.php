<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Logement $id_logement = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Compte $id_compte = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getIdLogement(): ?Logement
    {
        return $this->id_logement;
    }

    public function setIdLogement(?Logement $id_logement): self
    {
        $this->id_logement = $id_logement;

        return $this;
    }

    public function getIdCompte(): ?Compte
    {
        return $this->id_compte;
    }

    public function setIdCompte(?Compte $id_compte): self
    {
        $this->id_compte = $id_compte;

        return $this;
    }
}
