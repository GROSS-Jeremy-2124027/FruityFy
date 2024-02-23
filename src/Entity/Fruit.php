<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    public ?string $name = null;

    #[ORM\OneToMany(targetEntity: AlbumFruit::class, mappedBy: 'fruit', orphanRemoval: true)]
    private Collection $albumFruits;

    #[ORM\OneToMany(targetEntity: ArtisteFruit::class, mappedBy: 'fruit', orphanRemoval: true)]
    private Collection $artisteFruits;

    #[ORM\OneToMany(targetEntity: RechercheFruit::class, mappedBy: 'fruit')]
    private Collection $rechercheFruits;


    public function __construct()
    {
        $this->albumFruits = new ArrayCollection();
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
     * @return Collection<int, AlbumFruit>
     */
    public function getAlbumFruits(): Collection
    {
        return $this->albumFruits;
    }

    public function addAlbumFruit(AlbumFruit $albumFruit): static
    {
        if (!$this->albumFruits->contains($albumFruit)) {
            $this->albumFruits->add($albumFruit);
            $albumFruit->setFruit($this);
        }

        return $this;
    }

    public function removeAlbumFruit(AlbumFruit $albumFruit): static
    {
        if ($this->albumFruits->removeElement($albumFruit)) {
            // set the owning side to null (unless already changed)
            if ($albumFruit->getFruit() === $this) {
                $albumFruit->setFruit(null);
            }
        }

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
            $artisteFruit->setFruit($this);
        }

        return $this;
    }

    public function removeArtisteFruit(ArtisteFruit $artisteFruit): static
    {
        if ($this->artisteFruits->removeElement($artisteFruit)) {
            // set the owning side to null (unless already changed)
            if ($artisteFruit->getFruit() === $this) {
                $artisteFruit->setFruit(null);
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
            $rechercheFruit->setFruit($this);
        }

        return $this;
    }

    public function removeRechercheFruit(RechercheFruit $rechercheFruit): static
    {
        if ($this->rechercheFruits->removeElement($rechercheFruit)) {
            // set the owning side to null (unless already changed)
            if ($rechercheFruit->getFruit() === $this) {
                $rechercheFruit->setFruit(null);
            }
        }

        return $this;
    }
}
