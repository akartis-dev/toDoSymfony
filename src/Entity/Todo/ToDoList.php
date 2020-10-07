<?php

namespace App\Entity\Todo;

use App\Repository\Todo\ToDoListRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=ToDoListRepository::class)
 */
class ToDoList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"todo"})
     */
    private string $uuid;

    /**
     * @ORM\Column(type="text")
     * @Groups({"todo", "post"})
     */
    private string $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"todo"})
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"todo", "post"})
     */
    private ?int $position = 0;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"todo"})
     */
    private bool $isDone;

    /**
     * @ORM\ManyToOne(targetEntity=ToDoCategorie::class, inversedBy="toDoLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private ToDoCategorie $categorie;

    public function __construct()
    {
    	$this->uuid = Uuid::v4();
    	$this->createdAt = new DateTime();
    	$this->isDone = false;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getCategorie(): ?ToDoCategorie
    {
        return $this->categorie;
    }

    public function setCategorie(?ToDoCategorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
