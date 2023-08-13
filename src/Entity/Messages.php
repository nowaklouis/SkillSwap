<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'message')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Swap $swap = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'answer')]
    private ?self $main_message = null;

    #[ORM\OneToMany(mappedBy: 'main_message', targetEntity: self::class)]
    private Collection $answer;

    public function __construct()
    {
        $this->answer = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSwap(): ?Swap
    {
        return $this->swap;
    }

    public function setSwap(?Swap $swap): static
    {
        $this->swap = $swap;

        return $this;
    }

    public function getMainMessage(): ?self
    {
        return $this->main_message;
    }

    public function setMainMessage(?self $main_message): static
    {
        $this->main_message = $main_message;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(self $answer): static
    {
        if (!$this->answer->contains($answer)) {
            $this->answer->add($answer);
            $answer->setMainMessage($this);
        }

        return $this;
    }

    public function removeAnswer(self $answer): static
    {
        if ($this->answer->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getMainMessage() === $this) {
                $answer->setMainMessage(null);
            }
        }

        return $this;
    }
}
