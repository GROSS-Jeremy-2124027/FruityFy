<?php

namespace App\Entity;

use App\Repository\ReferenceFormatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferenceFormatRepository::class)]
class ReferenceFormat
{
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceFormats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reference $reference = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'referenceFormats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Format $format = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?Reference
    {
        return $this->reference;
    }

    public function setReference(?Reference $reference): static
    {
        $this->reference = $reference;

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
