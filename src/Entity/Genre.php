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

    #[ORM\OneToMany(targetEntity: ReferenceGenre::class, mappedBy: 'genre', orphanRemoval: true)]
    private Collection $referenceGenres;

    public function __construct()
    {
        $this->referenceGenres = new ArrayCollection();
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
     * @return Collection<int, ReferenceGenre>
     */
    public function getReferenceGenres(): Collection
    {
        return $this->referenceGenres;
    }

    public function addReferenceGenre(ReferenceGenre $referenceGenre): static
    {
        if (!$this->referenceGenres->contains($referenceGenre)) {
            $this->referenceGenres->add($referenceGenre);
            $referenceGenre->setGenre($this);
        }

        return $this;
    }

    public function removeReferenceGenre(ReferenceGenre $referenceGenre): static
    {
        if ($this->referenceGenres->removeElement($referenceGenre)) {
            // set the owning side to null (unless already changed)
            if ($referenceGenre->getGenre() === $this) {
                $referenceGenre->setGenre(null);
            }
        }

        return $this;
    }
}