<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: UserArtiste::class, mappedBy: 'artiste', orphanRemoval: true)]
    private Collection $userArtistes;

    #[ORM\Column(length: 255)]
    private ?string $discogsId = null;

    #[ORM\OneToMany(targetEntity: ArtisteFruit::class, mappedBy: 'artiste', orphanRemoval: true)]
    private Collection $artisteFruits;

    #[ORM\OneToMany(targetEntity: RechercheFruit::class, mappedBy: 'artiste')]
    private Collection $rechercheFruits;

    public function __construct()
    {
        $this->userArtistes = new ArrayCollection();
        $this->artisteFruits = new ArrayCollection();
        $this->rechercheFruits = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    /**
     * @return Collection<int, UserArtiste>
     */
    public function getUserArtistes(): Collection
    {
        return $this->userArtistes;
    }

    public function addUserArtiste(UserArtiste $userArtiste): static
    {
        if (!$this->userArtistes->contains($userArtiste)) {
            $this->userArtistes->add($userArtiste);
            $userArtiste->setArtiste($this);
        }

        return $this;
    }

    public function removeUserArtiste(UserArtiste $userArtiste): static
    {
        if ($this->userArtistes->removeElement($userArtiste)) {
            // set the owning side to null (unless already changed)
            if ($userArtiste->getArtiste() === $this) {
                $userArtiste->setArtiste(null);
            }
        }

        return $this;
    }

    public function getDiscogsId(): ?string
    {
        return $this->discogsId;
    }

    public function setDiscogsId(string $discogsId): static
    {
        $this->discogsId = $discogsId;

        return $this;
    }

    /**
     * @return Collection<int, ArtisteFruit>
     */
    public function getArtisteFruits(): Collection
    {
        return $this->artisteFruits;
    }

    public function addArtisteFruit(ArtisteFruit $artisteFruit): static
    {
        if (!$this->artisteFruits->contains($artisteFruit)) {
            $this->artisteFruits->add($artisteFruit);
            $artisteFruit->setArtiste($this);
        }

        return $this;
    }

    public function removeArtisteFruit(ArtisteFruit $artisteFruit): static
    {
        if ($this->artisteFruits->removeElement($artisteFruit)) {
            // set the owning side to null (unless already changed)
            if ($artisteFruit->getArtiste() === $this) {
                $artisteFruit->setArtiste(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RechercheFruit>
     */
    public function getRechercheFruits(): Collection
    {
        return $this->rechercheFruits;
    }

    public function addRechercheFruit(RechercheFruit $rechercheFruit): static
    {
        if (!$this->rechercheFruits->contains($rechercheFruit)) {
            $this->rechercheFruits->add($rechercheFruit);
            $rechercheFruit->setArtiste($this);
        }

        return $this;
    }

    public function removeRechercheFruit(RechercheFruit $rechercheFruit): static
    {
        if ($this->rechercheFruits->removeElement($rechercheFruit)) {
            // set the owning side to null (unless already changed)
            if ($rechercheFruit->getArtiste() === $this) {
                $rechercheFruit->setArtiste(null);
            }
        }

        return $this;
    }
}
