<?php

namespace App\Entity\Todo;

use App\Repository\Todo\ToDoCategorieRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ToDoCategorieRepository::class)
 */
class ToDoCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"todo", "categorie"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"todo", "categorie"})
     */
    private string $uuid;

    /**
     * @ORM\Column(type="text")
     * @Groups({"todo", "categorie"})
     */
    private string $title;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"todo", "categorie"})
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"todo", "categorie"})
     */
    private DateTime $limitAt;

    /**
     * @ORM\OneToMany(targetEntity=ToDoList::class, mappedBy="categorie", orphanRemoval=true)
     * @Groups({"todo"})
     */
    private $toDoLists;

    public function __construct()
    {
    	$this->uuid = Uuid::v4();
    	$this->createdAt = new DateTime();
        $this->toDoLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getLimitAt(): ?\DateTimeInterface
    {
        return $this->limitAt;
    }

    public function setLimitAt(\DateTimeInterface $limitAt): self
    {
        $this->limitAt = $limitAt;

        return $this;
    }

    /**
     * @return Collection|ToDoList[]
     */
    public function getToDoLists(): Collection
    {
        return $this->toDoLists;
    }

    public function addToDoList(ToDoList $toDoList): self
    {
        if (!$this->toDoLists->contains($toDoList)) {
            $this->toDoLists[] = $toDoList;
            $toDoList->setCategorie($this);
        }

        return $this;
    }

    public function removeToDoList(ToDoList $toDoList): self
    {
        if ($this->toDoLists->contains($toDoList)) {
            $this->toDoLists->removeElement($toDoList);
            // set the owning side to null (unless already changed)
            if ($toDoList->getCategorie() === $this) {
                $toDoList->setCategorie(null);
            }
        }

        return $this;
    }
}
