<?php

namespace App\Entity;

use App\Repository\LabelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: LabelRepository::class)]
class Label
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    #[Groups(['label:read'])]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: AlbumLabel::class, mappedBy: 'label', orphanRemoval: true)]
    private Collection $albumLabels;

    public function __construct()
    {
        $this->albumLabels = new ArrayCollection();
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
     * @return Collection<int, AlbumLabel>
     */
    public function getAlbumLabels(): Collection
    {
        return $this->albumLabels;
    }

    public function addAlbumLabel(AlbumLabel $albumLabel): static
    {
        if (!$this->albumLabels->contains($albumLabel)) {
            $this->albumLabels->add($albumLabel);
            $albumLabel->setLabel($this);
        }

        return $this;
    }

    public function removeAlbumLabel(AlbumLabel $albumLabel): static
    {
        if ($this->albumLabels->removeElement($albumLabel)) {
            // set the owning side to null (unless already changed)
            if ($albumLabel->getLabel() === $this) {
                $albumLabel->setLabel(null);
            }
        }

        return $this;
    }
}
