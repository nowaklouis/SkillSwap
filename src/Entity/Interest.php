<?php

namespace App\Entity;

use App\Repository\InterestRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterestRepository::class)]
class Interest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $interest = null;

    #[ORM\ManyToOne(inversedBy: 'interests')]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInterest(): ?string
    {
        return $this->interest;
    }

    public function setInterest(string $interest): static
    {
        $this->interest = $interest;

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
}
