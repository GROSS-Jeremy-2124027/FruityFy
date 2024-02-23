<?php

namespace App\Entity;

use App\Repository\AlbumLabelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumLabelRepository::class)]
class AlbumLabel
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'albumLabels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Album $album = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'albumLabels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Label $label = null;


    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }

    public function getLabel(): ?Label
    {
        return $this->label;
    }

    public function setLabel(?Label $label): static
    {
        $this->label = $label;

        return $this;
    }
}
