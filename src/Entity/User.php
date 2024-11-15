<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $profilImage = null;

    #[ORM\OneToMany(targetEntity: Thanks::class, mappedBy: 'byUser')]
    private Collection $givingThanks;

    #[ORM\OneToMany(targetEntity: Thanks::class, mappedBy: 'toUser')]
    private Collection $receivingThanks;

    public function __construct()
    {
        $this->givingThanks = new ArrayCollection();
        $this->receivingThanks = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getGivingThanks(): Collection
    {
        return $this->givingThanks;
    }

    public function addGivingThank(Thanks $thank): static
    {
        if (!$this->givingThanks->contains($thank)) {
            $this->givingThanks->add($thank);
            $thank->setByUser($this);
        }

        return $this;
    }

    public function removeGivingThank(Thanks $thank): static
    {
        if ($this->givingThanks->removeElement($thank)) {
            // set the owning side to null (unless already changed)
            if ($thank->getByUser() === $this) {
                $thank->setByUser(null);
            }
        }

        return $this;
    }

    public function getReceivingThanks(): Collection
    {
        return $this->receivingThanks;
    }

    public function addReceivingThank(Thanks $thank): static
    {
        if (!$this->receivingThanks->contains($thank)) {
            $this->receivingThanks->add($thank);
            $thank->setToUser($this);
        }

        return $this;
    }

    public function removeReceivingThank(Thanks $thank): static
    {
        if ($this->receivingThanks->removeElement($thank)) {
            // set the owning side to null (unless already changed)
            if ($thank->getToUser() === $this) {
                $thank->setToUser(null);
            }
        }

        return $this;
    }

    public function getProfilImage(): ?string
    {
        return $this->profilImage;
    }

    public function setProfilImage(?string $profilImage): void
    {
        $this->profilImage = $profilImage;
    }
}
