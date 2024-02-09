<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: ReferenceArtiste::class, mappedBy: 'artiste')]
    private Collection $referenceArtistes;

    public function __construct()
    {
        $this->referenceArtistes = new ArrayCollection();
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
     * @return Collection<int, ReferenceArtiste>
     */
    public function getReferenceArtistes(): Collection
    {
        return $this->referenceArtistes;
    }

    public function addReferenceArtiste(ReferenceArtiste $referenceArtiste): static
    {
        if (!$this->referenceArtistes->contains($referenceArtiste)) {
            $this->referenceArtistes->add($referenceArtiste);
            $referenceArtiste->setArtiste($this);
        }

        return $this;
    }

    public function removeReferenceArtiste(ReferenceArtiste $referenceArtiste): static
    {
        if ($this->referenceArtistes->removeElement($referenceArtiste)) {
            // set the owning side to null (unless already changed)
            if ($referenceArtiste->getArtiste() === $this) {
                $referenceArtiste->setArtiste(null);
            }
        }

        return $this;
    }
}
