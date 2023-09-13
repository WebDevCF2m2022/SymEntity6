<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(options:["unsigned" => true])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private ?array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 180,unique: true)]
    private ?string $email = null;

    #[ORM\OneToMany(mappedBy: 'many2oneUser', targetEntity: Post::class)]
    private Collection $one2manyPost;

    public function __construct()
    {
        $this->one2manyPost = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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
    public function getPassword(): ?string
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
        // $this->password = null;
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
     * @return Collection<int, Post>
     */
    public function getOne2manyPost(): Collection
    {
        return $this->one2manyPost;
    }

    public function addOne2manyPost(Post $one2manyPost): static
    {
        if (!$this->one2manyPost->contains($one2manyPost)) {
            $this->one2manyPost->add($one2manyPost);
            $one2manyPost->setMany2oneUser($this);
        }

        return $this;
    }

    public function removeOne2manyPost(Post $one2manyPost): static
    {
        if ($this->one2manyPost->removeElement($one2manyPost)) {
            // set the owning side to null (unless already changed)
            if ($one2manyPost->getMany2oneUser() === $this) {
                $one2manyPost->setMany2oneUser(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->username;
    }
}
