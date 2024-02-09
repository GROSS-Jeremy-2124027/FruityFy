<?php

namespace App\Entity;

use App\Repository\ReferenceArtisteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferenceArtisteRepository::class)]
class ReferenceArtiste
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceArtistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reference $reference = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceArtistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artiste $artiste = null;

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

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }
}
