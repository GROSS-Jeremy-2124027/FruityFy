<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\OneToMany(targetEntity: AlbumGenre::class, mappedBy: 'album', orphanRemoval: true)]
    private Collection $albumGenres;


    #[ORM\OneToMany(targetEntity: AlbumLabel::class, mappedBy: 'album', orphanRemoval: true)]
    private Collection $albumLabels;

    #[ORM\OneToMany(targetEntity: AlbumFormat::class, mappedBy: 'album', orphanRemoval: true)]
    private Collection $albumFormats;

    #[ORM\OneToMany(targetEntity: AlbumFruit::class, mappedBy: 'album', orphanRemoval: true)]
    private Collection $albumFruits;

    #[ORM\OneToMany(targetEntity: UserAlbum::class, mappedBy: 'album', orphanRemoval: true)]
    private Collection $userAlbums;

    #[ORM\Column(length: 255)]
    private ?string $discogsId = null;

    public function __construct()
    {
        $this->albumGenres = new ArrayCollection();
        $this->albumLabels = new ArrayCollection();
        $this->albumFormats = new ArrayCollection();
        $this->albumFruits = new ArrayCollection();
        $this->userAlbums = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
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

    /**
     * @return Collection<int, AlbumGenre>
     */
    public function getAlbumGenres(): Collection
    {
        return $this->albumGenres;
    }

    public function addAlbumGenre(AlbumGenre $albumGenre): static
    {
        if (!$this->albumGenres->contains($albumGenre)) {
            $this->albumGenres->add($albumGenre);
            $albumGenre->setAlbum($this);
        }

        return $this;
    }

    public function removeAlbumGenre(AlbumGenre $albumGenre): static
    {
        if ($this->albumGenres->removeElement($albumGenre)) {
            // set the owning side to null (unless already changed)
            if ($albumGenre->getAlbum() === $this) {
                $albumGenre->setAlbum(null);
            }
        }

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
            $albumLabel->setAlbum($this);
        }

        return $this;
    }

    public function removeAlbumLabel(AlbumLabel $albumLabel): static
    {
        if ($this->albumLabels->removeElement($albumLabel)) {
            // set the owning side to null (unless already changed)
            if ($albumLabel->getAlbum() === $this) {
                $albumLabel->setAlbum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AlbumFormat>
     */
    public function getAlbumFormats(): Collection
    {
        return $this->albumFormats;
    }

    public function addAlbumFormat(AlbumFormat $albumFormat): static
    {
        if (!$this->albumFormats->contains($albumFormat)) {
            $this->albumFormats->add($albumFormat);
            $albumFormat->setAlbum($this);
        }

        return $this;
    }

    public function removeAlbumFormat(AlbumFormat $albumFormat): static
    {
        if ($this->albumFormats->removeElement($albumFormat)) {
            if ($albumFormat->getAlbum() === $this) {
                $albumFormat->setAlbum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AlbumFruit>
     */
    public function getAlbumFruits(): Collection
    {
        return $this->albumFruits;
    }

    public function addAlbumFruit(AlbumFruit $albumFruit): static
    {
        if (!$this->albumFruits->contains($albumFruit)) {
            $this->albumFruits->add($albumFruit);
            $albumFruit->setAlbum($this);
        }

        return $this;
    }

    public function removeAlbumFruit(AlbumFruit $albumFruit): static
    {
        if ($this->albumFruits->removeElement($albumFruit)) {
            if ($albumFruit->getAlbum() === $this) {
                $albumFruit->setAlbum(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserAlbum>
     */
    public function getUserAlbums(): Collection
    {
        return $this->userAlbums;
    }

    public function addUserAlbum(UserAlbum $userAlbum): static
    {
        if (!$this->userAlbums->contains($userAlbum)) {
            $this->userAlbums->add($userAlbum);
            $userAlbum->setAlbum($this);
        }

        return $this;
    }

    public function removeUserAlbum(UserAlbum $userAlbum): static
    {
        if ($this->userAlbums->removeElement($userAlbum)) {
            if ($userAlbum->getAlbum() === $this) {
                $userAlbum->setAlbum(null);
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
