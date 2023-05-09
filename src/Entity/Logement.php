<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogementRepository::class)]
class Logement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $prix_nuité = null;

    #[ORM\Column(length: 20)]
    private ?string $TypeLogement = null;

    #[ORM\Column(length: 20)]
    private ?string $TypeEspace = null;

    #[ORM\Column]
    private ?int $NumLogement = null;

    #[ORM\Column(length: 255)]
    private ?string $Rue = null;

    #[ORM\Column(length: 255)]
    private ?string $Ville = null;

    #[ORM\Column(length: 255)]
    private ?string $Pays = null;

    #[ORM\Column]
    private ?int $NbrLits = null;

    #[ORM\Column]
    private ?int $Nbr_sdb = null;

    #[ORM\Column]
    private ?int $NbrChambres = null;

    #[ORM\Column(length: 255)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column]
    private array $Equipements = [];

    #[ORM\ManyToOne(inversedBy: 'logements')]
    #[ORM\JoinColumn(nullable: false)]

    private ?Compte $idCompte = null;

    #[ORM\OneToMany(mappedBy: 'idLogement', targetEntity: ImagesLogement::class, orphanRemoval: true)]
    private Collection $imagesLogements;

    #[ORM\OneToMany(mappedBy: 'idLogement', targetEntity: Reservation::class, orphanRemoval: true)]
    private Collection $rServations;

    #[ORM\OneToMany(mappedBy: 'id_logement', targetEntity: Commentaire::class, orphanRemoval: true)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->imagesLogements = new ArrayCollection();
        $this->rServations = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeLogement(): ?string
    {
        return $this->TypeLogement;
    }

    public function setTypeLogement(string $TypeLogement): self
    {
        $this->TypeLogement = $TypeLogement;

        return $this;
    }

    public function getprix_nuité(): ?string
    {
        return $this->prix_nuité;
    }

    public function setprix_nuitee(string $prix_nuité): self
    {
        $this->prix_nuité = $prix_nuité;

        return $this;
    }

    public function getTypeEspace(): ?string
    {
        return $this->TypeEspace;
    }

    public function setTypeEspace(string $TypeEspace): self
    {
        $this->TypeEspace = $TypeEspace;

        return $this;
    }

    public function getNumLogement(): ?int
    {
        return $this->NumLogement;
    }

    public function setNumLogement(int $NumLogement): self
    {
        $this->NumLogement = $NumLogement;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->Rue;
    }

    public function setRue(string $Rue): self
    {
        $this->Rue = $Rue;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getNbrLits(): ?int
    {
        return $this->NbrLits;
    }

    public function setNbrLits(int $NbrLits): self
    {
        $this->NbrLits = $NbrLits;

        return $this;
    }

    public function getNbrSdb(): ?int
    {
        return $this->Nbr_sdb;
    }

    public function setNbrSdb(int $Nbr_sdb): self
    {
        $this->Nbr_sdb = $Nbr_sdb;

        return $this;
    }

    public function getNbrChambres(): ?int
    {
        return $this->NbrChambres;
    }

    public function setNbrChambres(int $NbrChambres): self
    {
        $this->NbrChambres = $NbrChambres;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getEquipements(): array
    {
        return $this->Equipements;
    }

    public function setEquipements(array $Equipements): self
    {
        $this->Equipements = $Equipements;

        return $this;
    }

    public function getIdCompte(): ?Compte
    {
        return $this->idCompte;
    }

    public function setIdCompte(?Compte $idCompte): self
    {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * @return Collection<int, ImagesLogement>
     */
    public function getImagesLogements(): Collection
    {
        return $this->imagesLogements;
    }

    public function addImagesLogement(ImagesLogement $imagesLogement): self
    {
        if (!$this->imagesLogements->contains($imagesLogement)) {
            $this->imagesLogements->add($imagesLogement);
            $imagesLogement->setIdLogement($this);
        }

        return $this;
    }

    public function removeImagesLogement(ImagesLogement $imagesLogement): self
    {
        if ($this->imagesLogements->removeElement($imagesLogement)) {
            // set the owning side to null (unless already changed)
            if ($imagesLogement->getIdLogement() === $this) {
                $imagesLogement->setIdLogement(null);
            }
        }

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
            $rServation->setIdLogement($this);
        }

        return $this;
    }

    public function removeRServation(Reservation $rServation): self
    {
        if ($this->rServations->removeElement($rServation)) {
            // set the owning side to null (unless already changed)
            if ($rServation->getIdLogement() === $this) {
                $rServation->setIdLogement(null);
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
            $commentaire->setIdLogement($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdLogement() === $this) {
                $commentaire->setIdLogement(null);
            }
        }

        return $this;
    }
}
