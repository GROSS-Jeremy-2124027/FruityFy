<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\Types\UuidType;
#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: ReferenceFruit::class, mappedBy: 'fruit', orphanRemoval: true)]
    private Collection $referenceFruits;

    public function __construct()
    {
        $this->referenceFruits = new ArrayCollection();
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
     * @return Collection<int, ReferenceFruit>
     */
    public function getReferenceFruits(): Collection
    {
        return $this->referenceFruits;
    }

    public function addReferenceFruit(ReferenceFruit $referenceFruit): static
    {
        if (!$this->referenceFruits->contains($referenceFruit)) {
            $this->referenceFruits->add($referenceFruit);
            $referenceFruit->setFruit($this);
        }

        return $this;
    }

    public function removeReferenceFruit(ReferenceFruit $referenceFruit): static
    {
        if ($this->referenceFruits->removeElement($referenceFruit)) {
            // set the owning side to null (unless already changed)
            if ($referenceFruit->getFruit() === $this) {
                $referenceFruit->setFruit(null);
            }
        }

        return $this;
    }
}
