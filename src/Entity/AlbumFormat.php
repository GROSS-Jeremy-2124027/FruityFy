<?php

namespace App\Entity;

use App\Repository\AlbumFormatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumFormatRepository::class)]
class AlbumFormat
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'albumFormats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Album $album = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'albumFormats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Format $format = null;



    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }

    public function getFormat(): ?Format
    {
        return $this->format;
    }

    public function setFormat(?Format $format): static
    {
        $this->format = $format;

        return $this;
    }
}
