<?php

namespace App\Entity;

use App\Repository\ReferenceGenreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferenceGenreRepository::class)]
class ReferenceGenre
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceGenres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reference $reference = null;
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceGenres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $genre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?Reference
    {
        return $this->reference;
    }

    public function setReference(?Reference $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): static
    {
        $this->genre = $genre;

        return $this;
    }
}
