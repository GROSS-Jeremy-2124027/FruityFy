<?php

namespace App\Entity;

use App\Repository\ArtisteFruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteFruitRepository::class)]
class ArtisteFruit
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'artisteFruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artiste $artiste = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'artisteFruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fruit $fruit = null;

    public function getArtiste(): ?Artiste
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): static
    {
        $this->artiste = $artiste;

        return $this;
    }

    public function getFruit(): ?Fruit
    {
        return $this->fruit;
    }

    public function setFruit(?Fruit $fruit): static
    {
        $this->fruit = $fruit;

        return $this;
    }
}
