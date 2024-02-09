<?php

namespace App\Entity;

use App\Repository\ReferenceFruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferenceFruitRepository::class)]
class ReferenceFruit
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceFruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reference $reference = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceFruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fruit $fruit = null;

    public function getReference(): ?Reference
    {
        return $this->reference;
    }

    public function setReference(?Reference $reference): static
    {
        $this->reference = $reference;

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
