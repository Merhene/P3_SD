<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\From;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'size', targetEntity: Flash::class)]
    private Collection $flash;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    public function __construct()
    {
        $this->flash = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Flash>
     */
    public function getFlash(): Collection
    {
        return $this->flash;
    }

    public function addFlash(Flash $flash): static
    {
        if (!$this->flash->contains($flash)) {
            $this->flash->add($flash);
            $flash->setSize($this);
        }

        return $this;
    }

    public function removeFlash(Flash $flash): static
    {
        if ($this->flash->removeElement($flash)) {
            // set the owning side to null (unless already changed)
            if ($flash->getSize() === $this) {
                $flash->setSize(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function __toString(): string
    {
        return $this->type;
    }
}
