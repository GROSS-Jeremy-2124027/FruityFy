<?php

namespace App\Entity;

use App\Repository\UserAlbumRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserAlbumRepository::class)]
class UserAlbum
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userAlbums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userAlbums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Album $album = null;

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): static
    {
        $this->album = $album;

        return $this;
    }
}
