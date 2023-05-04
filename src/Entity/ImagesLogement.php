<?php

namespace App\Entity;

use App\Repository\ImagesLogementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagesLogementRepository::class)]
class ImagesLogement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::BLOB)]
    private $data = null;

    #[ORM\ManyToOne(inversedBy: 'imagesLogements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Logement $idLogement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

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
}
