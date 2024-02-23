<?php

namespace App\Entity;

use App\Repository\UserArtisteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserArtisteRepository::class)]
class UserArtiste
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userArtistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'userArtistes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Artiste $artiste = null;


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

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
