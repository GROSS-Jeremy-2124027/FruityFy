<?php

namespace App\Entity;

use App\Repository\FormatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: FormatRepository::class)]
class Format
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: AlbumFormat::class, mappedBy: 'format', orphanRemoval: true)]
    private Collection $albumFormats;

    #[ORM\OneToMany(targetEntity: RechercheFruit::class, mappedBy: 'format')]
    private Collection $rechercheFruits;

    public function __construct()
    {
        $this->albumFormats = new ArrayCollection();
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
     * @return Collection<int, AlbumFormat>
     */
    public function getAlbumFormats(): Collection
    {
        return $this->albumFormats;
    }

    public function addAlbumFormat(AlbumFormat $albumFormat): static
    {
        if (!$this->albumFormats->contains($albumFormat)) {
            $this->albumFormats->add($albumFormat);
            $albumFormat->setFormat($this);
        }

        return $this;
    }

    public function removeAlbumFormat(AlbumFormat $albumFormat): static
    {
        if ($this->albumFormats->removeElement($albumFormat)) {
            // set the owning side to null (unless already changed)
            if ($albumFormat->getFormat() === $this) {
                $albumFormat->setFormat(null);
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
            $rechercheFruit->setFormat($this);
        }

        return $this;
    }

    public function removeRechercheFruit(RechercheFruit $rechercheFruit): static
    {
        if ($this->rechercheFruits->removeElement($rechercheFruit)) {
            // set the owning side to null (unless already changed)
            if ($rechercheFruit->getFormat() === $this) {
                $rechercheFruit->setFormat(null);
            }
        }

        return $this;
    }
}
