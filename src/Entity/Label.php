<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LabelRepository::class)]
class Label
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Reference::class, mappedBy: 'idLabel')]
    private Collection $referencesList;

    public function __construct()
    {
        $this->referencesList = new ArrayCollection();
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
     * @return Collection<Uuid, Reference>
     */
    public function getReferencesList(): Collection
    {
        return $this->referencesList;
    }

    public function addReferencesList(Reference $referencesList): static
    {
        if (!$this->referencesList->contains($referencesList)) {
            $this->referencesList->add($referencesList);
            $referencesList->setIdLabel($this);
        }

        return $this;
    }

    public function removeReferencesList(Reference $referencesList): static
    {
        if ($this->referencesList->removeElement($referencesList)) {
            // set the owning side to null (unless already changed)
            if ($referencesList->getIdLabel() === $this) {
                $referencesList->setIdLabel(null);
            }
        }

        return $this;
    }
}
