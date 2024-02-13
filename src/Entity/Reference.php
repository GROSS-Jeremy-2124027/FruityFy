<?php

namespace App\Entity;

use App\Repository\ReferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ReferenceRepository::class)]
class Reference
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;
    #[ORM\Column(nullable: true)]
    private ?int $year = null;

    #[ORM\ManyToOne(inversedBy: 'referencesList')]
    private ?Label $idLabel = null;

    #[ORM\OneToMany(targetEntity: ReferenceFruit::class, mappedBy: 'reference', orphanRemoval: true)]
    private Collection $referenceFruits;

    #[ORM\OneToMany(targetEntity: ReferenceGenre::class, mappedBy: 'reference', orphanRemoval: true)]
    private Collection $referenceGenres;

    #[ORM\OneToMany(targetEntity: ReferenceArtiste::class, mappedBy: 'reference', orphanRemoval: true)]
    private Collection $referenceArtistes;

    #[ORM\OneToMany(targetEntity: ReferenceFormat::class, mappedBy: 'reference', orphanRemoval: true)]
    private Collection $referenceFormats;

    #[ORM\Column(length: 255)]
    private ?string $discogsId = null;

    public function __construct()
    {
        $this->referenceFruits = new ArrayCollection();
        $this->referenceGenres = new ArrayCollection();
        $this->referenceArtistes = new ArrayCollection();
        $this->referenceFormats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(Uuid $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getIdLabel(): ?Label
    {
        return $this->idLabel;
    }

    public function setIdLabel(?Label $idLabel): static
    {
        $this->idLabel = $idLabel;

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
            $referenceFruit->setReference($this);
        }

        return $this;
    }

    public function removeReferenceFruit(ReferenceFruit $referenceFruit): static
    {
        if ($this->referenceFruits->removeElement($referenceFruit)) {
            // set the owning side to null (unless already changed)
            if ($referenceFruit->getReference() === $this) {
                $referenceFruit->setReference(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReferenceGenre>
     */
    public function getReferenceGenres(): Collection
    {
        return $this->referenceGenres;
    }

    public function addReferenceGenre(ReferenceGenre $referenceGenre): static
    {
        if (!$this->referenceGenres->contains($referenceGenre)) {
            $this->referenceGenres->add($referenceGenre);
            $referenceGenre->setReference($this);
        }

        return $this;
    }

    public function removeReferenceGenre(ReferenceGenre $referenceGenre): static
    {
        if ($this->referenceGenres->removeElement($referenceGenre)) {
            // set the owning side to null (unless already changed)
            if ($referenceGenre->getReference() === $this) {
                $referenceGenre->setReference(null);
            }
        }

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
            $referenceArtiste->setReference($this);
        }

        return $this;
    }

    public function removeReferenceArtiste(ReferenceArtiste $referenceArtiste): static
    {
        if ($this->referenceArtistes->removeElement($referenceArtiste)) {
            // set the owning side to null (unless already changed)
            if ($referenceArtiste->getReference() === $this) {
                $referenceArtiste->setReference(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ReferenceFormat>
     */
    public function getReferenceFormats(): Collection
    {
        return $this->referenceFormats;
    }

    public function addReferenceFormat(ReferenceFormat $referenceFormat): static
    {
        if (!$this->referenceFormats->contains($referenceFormat)) {
            $this->referenceFormats->add($referenceFormat);
            $referenceFormat->setReference($this);
        }

        return $this;
    }

    public function removeReferenceFormat(ReferenceFormat $referenceFormat): static
    {
        if ($this->referenceFormats->removeElement($referenceFormat)) {
            // set the owning side to null (unless already changed)
            if ($referenceFormat->getReference() === $this) {
                $referenceFormat->setReference(null);
            }
        }

        return $this;
    }

    public function getDiscogsId(): ?string
    {
        return $this->discogsId;
    }

    public function setDiscogsId(string $discogsId): static
    {
        $this->discogsId = $discogsId;

        return $this;
    }
}
