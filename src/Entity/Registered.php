<?php

namespace App\Entity;

use App\Repository\RegisteredRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegisteredRepository::class)]
class Registered
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'register')]
    private ?Swap $swaps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getSwaps(): ?Swap
    {
        return $this->swaps;
    }

    public function setSwaps(?Swap $swaps): static
    {
        $this->swaps = $swaps;

        return $this;
    }
}
