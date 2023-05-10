<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 20)]
    private ?string $Nom = null;

    #[ORM\Column(length: 20)]
    private ?string $Prenom = null;


    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 20)]
    private ?string $Telephone = null;

    
    #[ORM\Column]
    private ?int $Age = null;
    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\Column(type: Types::BLOB, nullable: true)]
    private $Photo = null;


    #[ORM\OneToMany(mappedBy: 'IdLocataire', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $locations;

    #[ORM\OneToMany(mappedBy: 'IdProprietaire', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $rServations;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: Logement::class, orphanRemoval: true)]
    private Collection $logements;

    #[ORM\OneToMany(mappedBy: 'id_user', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;


    public function __construct()
    {

        $this->rServations = new ArrayCollection();
        $this->locations = new ArrayCollection();
        $this->logements = new ArrayCollection();
        $this->commentaires = new ArrayCollection();

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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

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

    public function getAge(): ?int
    {
        return $this->Age;
    }

    public function setAge(int $Age): self
    {
        $this->Age = $Age;

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
     * @return Collection<int, Reservation>
     */
    public function getRServations(): Collection
    {
        return $this->rServations;
    }

    public function addRServation(Reservation $rServation): self
    {
        if (!$this->rServations->contains($rServation)) {
            $this->rServations->add($rServation);
            $rServation->setIdProprietaire($this);
        }

        return $this;
    }

    public function removeRServation(Reservation $rServation): self
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
     * @return Collection<int, Reservation>
     */

    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Reservation $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations->add($location);
            $location->setIdLocataire($this);
        }

        return $this;
    }

    public function removeLocation(Reservation $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getIdLocataire() === $this) {
                $location->setIdLocataire(null);
            }
        }

        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

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
            $logement->setIdUser($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->removeElement($logement)) {
            // set the owning side to null (unless already changed)
            if ($logement->getIdUser() === $this) {
                $logement->setIdUser(null);
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
            $commentaire->setIdUser($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdUser() === $this) {
                $commentaire->setIdUser(null);
            }
        }

        return $this;
    }



}
