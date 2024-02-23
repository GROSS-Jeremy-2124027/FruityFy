<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    #[ORM\OneToMany(targetEntity: AlbumGenre::class, mappedBy: 'genre', orphanRemoval: true)]
    private Collection $albumGenres;

    #[ORM\OneToMany(targetEntity: RechercheFruit::class, mappedBy: 'genre')]
    private Collection $rechercheFruits;

    public function __construct()
    {
        $this->albumGenres = new ArrayCollection();
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
     * @return Collection<int, AlbumGenre>
     */
    public function getAlbumGenres(): Collection
    {
        return $this->albumGenres;
    }

    public function addAlbumGenre(AlbumGenre $albumGenre): static
    {
        if (!$this->albumGenres->contains($albumGenre)) {
            $this->albumGenres->add($albumGenre);
            $albumGenre->setGenre($this);
        }

        return $this;
    }

    public function removeAlbumGenre(AlbumGenre $albumGenre): static
    {
        if ($this->albumGenres->removeElement($albumGenre)) {
            // set the owning side to null (unless already changed)
            if ($albumGenre->getGenre() === $this) {
                $albumGenre->setGenre(null);
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
            $rechercheFruit->setGenre($this);
        }

        return $this;
    }

    public function removeRechercheFruit(RechercheFruit $rechercheFruit): static
    {
        if ($this->rechercheFruits->removeElement($rechercheFruit)) {
            // set the owning side to null (unless already changed)
            if ($rechercheFruit->getGenre() === $this) {
                $rechercheFruit->setGenre(null);
            }
        }

        return $this;
    }
}
