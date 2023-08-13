<?php

namespace App\Entity;

use App\Repository\SwapRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SwapRepository::class)]
class Swap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $duration = null;

    #[ORM\ManyToOne(inversedBy: 'swaps')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\OneToMany(mappedBy: 'swaps', targetEntity: Registered::class)]
    private Collection $register;

    #[ORM\OneToMany(mappedBy: 'swap', targetEntity: Messages::class, orphanRemoval: true)]
    private Collection $message;

    public function __construct()
    {
        $this->register = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->message = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(\DateTimeInterface $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Registered>
     */
    public function getRegister(): Collection
    {
        return $this->register;
    }

    public function addRegister(Registered $register): static
    {
        if (!$this->register->contains($register)) {
            $this->register->add($register);
            $register->setSwaps($this);
        }

        return $this;
    }

    public function removeRegister(Registered $register): static
    {
        if ($this->register->removeElement($register)) {
            // set the owning side to null (unless already changed)
            if ($register->getSwaps() === $this) {
                $register->setSwaps(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Messages>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(Messages $message): static
    {
        if (!$this->message->contains($message)) {
            $this->message->add($message);
            $message->setSwap($this);
        }

        return $this;
    }

    public function removeMessage(Messages $message): static
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getSwap() === $this) {
                $message->setSwap(null);
            }
        }

        return $this;
    }
}
