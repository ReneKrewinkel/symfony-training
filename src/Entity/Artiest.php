<?php

namespace App\Entity;

use App\Repository\ArtiestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtiestRepository::class)]
class Artiest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $naam = null;

    #[ORM\Column(length: 50)]
    private ?string $genre = null;

    /**
     * @var Collection<int, Optreden>
     */
    #[ORM\OneToMany(targetEntity: Optreden::class, mappedBy: 'voorprogramma')]
    private Collection $voorprogramma;

    /**
     * @var Collection<int, Optreden>
     */
    #[ORM\OneToMany(targetEntity: Optreden::class, mappedBy: 'hoofdprogramma')]
    private Collection $hoofdprogramma;

    public function __construct()
    {
        $this->voorprogramma = new ArrayCollection();
        $this->hoofdprogramma = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): static
    {
        $this->naam = $naam;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return Collection<int, Optreden>
     */
    public function getVoorprogramma(): Collection
    {
        return $this->voorprogramma;
    }

    public function addVoorprogramma(Optreden $voorprogramma): static
    {
        if (!$this->voorprogramma->contains($voorprogramma)) {
            $this->voorprogramma->add($voorprogramma);
            $voorprogramma->setVoorprogramma($this);
        }

        return $this;
    }

    public function removeVoorprogramma(Optreden $voorprogramma): static
    {
        if ($this->voorprogramma->removeElement($voorprogramma)) {
            // set the owning side to null (unless already changed)
            if ($voorprogramma->getVoorprogramma() === $this) {
                $voorprogramma->setVoorprogramma(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Optreden>
     */
    public function getHoofdprogramma(): Collection
    {
        return $this->hoofdprogramma;
    }

    public function addHoofdprogramma(Optreden $hoofdprogramma): static
    {
        if (!$this->hoofdprogramma->contains($hoofdprogramma)) {
            $this->hoofdprogramma->add($hoofdprogramma);
            $hoofdprogramma->setHoofdprogramma($this);
        }

        return $this;
    }

    public function removeHoofdprogramma(Optreden $hoofdprogramma): static
    {
        if ($this->hoofdprogramma->removeElement($hoofdprogramma)) {
            // set the owning side to null (unless already changed)
            if ($hoofdprogramma->getHoofdprogramma() === $this) {
                $hoofdprogramma->setHoofdprogramma(null);
            }
        }

        return $this;
    }
}
