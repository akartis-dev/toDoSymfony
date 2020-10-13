<?php

namespace App\Entity;

use App\Entity\Todo\ToDoEntities;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uuid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ToDoEntities::class, mappedBy="user")
     */
    private $toDoEntities;

    public function __construct()
    {
		$this->uuid = Uuid::v4();
    	$this->createdAt = new \DateTimeImmutable();
     $this->toDoEntities = new ArrayCollection();
    }

	public function getId(): ?int
                            {
                                return $this->id;
                            }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|ToDoEntities[]
     */
    public function getToDoEntities(): Collection
    {
        return $this->toDoEntities;
    }

    public function addToDoEntity(ToDoEntities $toDoEntity): self
    {
        if (!$this->toDoEntities->contains($toDoEntity)) {
            $this->toDoEntities[] = $toDoEntity;
            $toDoEntity->setUser($this);
        }

        return $this;
    }

    public function removeToDoEntity(ToDoEntities $toDoEntity): self
    {
        if ($this->toDoEntities->contains($toDoEntity)) {
            $this->toDoEntities->removeElement($toDoEntity);
            // set the owning side to null (unless already changed)
            if ($toDoEntity->getUser() === $this) {
                $toDoEntity->setUser(null);
            }
        }

        return $this;
    }
}
