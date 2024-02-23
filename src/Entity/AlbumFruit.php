<?php

namespace App\Entity;

use App\Repository\AlbumFruitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumFruitRepository::class)]
class AlbumFruit
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'albumFruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Album $album = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'albumFruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fruit $fruit = null;

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

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
