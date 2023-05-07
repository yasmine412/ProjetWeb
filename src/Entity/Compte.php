<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(length: 20)]
    private ?string $Prénom = null;

    #[ORM\Column(length: 255)]
    private ?string $Email = null;

    #[ORM\Column(length: 30)]
    private ?string $Password = null;

    #[ORM\Column(length: 20)]
    private ?string $Telephone = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateNaissance = null;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $Photo = null;

    #[ORM\OneToMany(mappedBy: 'idCompte', targetEntity: Logement::class, orphanRemoval: true)]
    private Collection $logements;

    #[ORM\OneToMany(mappedBy: 'IdLocataire', targetEntity: Réservation::class, orphanRemoval: true)]
    private Collection $locations;

    #[ORM\OneToMany(mappedBy: 'IdProprietaire', targetEntity: Réservation::class, orphanRemoval: true)]
    private Collection $rServations;

    #[ORM\OneToMany(mappedBy: 'id_compte', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->logements = new ArrayCollection();
        $this->rServations = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrénom(): ?string
    {
        return $this->Prénom;
    }

    public function setPrénom(string $Prénom): self
    {
        $this->Prénom = $Prénom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->Telephone;
    }

    public function setTelephone(string $Telephone): self
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->DateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $DateNaissance): self
    {
        $this->DateNaissance = $DateNaissance;

        return $this;
    }

    public function getPhoto()
    {
        return $this->Photo;
    }

    public function setPhoto($Photo): self
    {
        $this->Photo = $Photo;

        return $this;
    }

    /**
     * @return Collection<int, Logement>
     */
    public function getLogements(): Collection
    {
        return $this->logements;
    }

    public function addLogement(Logement $logement): self
    {
        if (!$this->logements->contains($logement)) {
            $this->logements->add($logement);
            $logement->setIdCompte($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->removeElement($logement)) {
            // set the owning side to null (unless already changed)
            if ($logement->getIdCompte() === $this) {
                $logement->setIdCompte(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Réservation>
     */
    public function getRServations(): Collection
    {
        return $this->rServations;
    }

    public function addRServation(Réservation $rServation): self
    {
        if (!$this->rServations->contains($rServation)) {
            $this->rServations->add($rServation);
            $rServation->IdProprietaire($this);
        }

        return $this;
    }

    public function removeRServation(Réservation $rServation): self
    {
        if ($this->rServations->removeElement($rServation)) {
            // set the owning side to null (unless already changed)
            if ($rServation->getIdProprietaire() === $this) {
                $rServation->setIdProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Réservation>
     */

public function getLocations(): Collection
{
    return $this->locations;
}

public function addLocation(Réservation $location): self
{
    if (!$this->locations->contains($location)) {
        $this->locations->add($location);
        $location->setIdLocataire($this);
    }

    return $this;
}

public function removeLocation(Réservation $location): self
{
    if ($this->locations->removeElement($location)) {
        // set the owning side to null (unless already changed)
        if ($location->getIdLocataire() === $this) {
            $location->setIdLocataire(null);
        }
    }

    return $this;
}

/**
 * @return Collection<int, Commentaire>
 */
public function getCommentaires(): Collection
{
    return $this->commentaires;
}

public function addCommentaire(Commentaire $commentaire): self
{
    if (!$this->commentaires->contains($commentaire)) {
        $this->commentaires->add($commentaire);
        $commentaire->setIdCompte($this);
    }

    return $this;
}

public function removeCommentaire(Commentaire $commentaire): self
{
    if ($this->commentaires->removeElement($commentaire)) {
        // set the owning side to null (unless already changed)
        if ($commentaire->getIdCompte() === $this) {
            $commentaire->setIdCompte(null);
        }
    }

    return $this;
}
}
