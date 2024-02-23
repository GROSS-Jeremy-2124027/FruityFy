<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(targetEntity: UserArtiste::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userArtistes;

    #[ORM\OneToMany(targetEntity: UserAlbum::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userAlbums;

    public function __construct()
    {
        $this->userArtistes = new ArrayCollection();
        $this->userAlbums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, UserArtiste>
     */
    public function getUserArtistes(): Collection
    {
        return $this->userArtistes;
    }

    public function addUserArtiste(UserArtiste $userArtiste): static
    {
        if (!$this->userArtistes->contains($userArtiste)) {
            $this->userArtistes->add($userArtiste);
            $userArtiste->setUser($this);
        }

        return $this;
    }

    public function removeUserArtiste(UserArtiste $userArtiste): static
    {
        if ($this->userArtistes->removeElement($userArtiste)) {
            // set the owning side to null (unless already changed)
            if ($userArtiste->getUser() === $this) {
                $userArtiste->setUser(null);
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
            $userAlbum->setUser($this);
        }

        return $this;
    }

    public function removeUserAlbum(UserAlbum $userAlbum): static
    {
        if ($this->userAlbums->removeElement($userAlbum)) {
            // set the owning side to null (unless already changed)
            if ($userAlbum->getUser() === $this) {
                $userAlbum->setUser(null);
            }
        }

        return $this;
    }
}
