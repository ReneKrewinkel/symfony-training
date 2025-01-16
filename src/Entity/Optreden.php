<?php

namespace App\Entity;

use App\Repository\OptredenRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptredenRepository::class)]
class Optreden
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'optredens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poppodium $poppodium = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datum = null;

    #[ORM\Column]
    private ?int $prijs = null;

    #[ORM\Column(length: 60)]
    private ?string $ticketUrl = null;

    #[ORM\ManyToOne(inversedBy: 'voorprogramma')]
    private ?Artiest $voorprogramma = null;

    #[ORM\ManyToOne(inversedBy: 'hoofdprogramma')]
    private ?Artiest $hoofdprogramma = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoppodium(): ?Poppodium
    {
        return $this->poppodium;
    }

    public function setPoppodium(?Poppodium $poppodium): static
    {
        $this->poppodium = $poppodium;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): static
    {
        $this->datum = $datum;

        return $this;
    }

    public function getPrijs(): ?int
    {
        return $this->prijs;
    }

    public function setPrijs(int $prijs): static
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getTicketUrl(): ?string
    {
        return $this->ticketUrl;
    }

    public function setTicketUrl(string $ticketUrl): static
    {
        $this->ticketUrl = $ticketUrl;

        return $this;
    }

    public function getVoorprogramma(): ?Artiest
    {
        return $this->voorprogramma;
    }

    public function setVoorprogramma(?Artiest $voorprogramma): static
    {
        $this->voorprogramma = $voorprogramma;

        return $this;
    }

    public function getHoofdprogramma(): ?Artiest
    {
        return $this->hoofdprogramma;
    }

    public function setHoofdprogramma(?Artiest $hoofdprogramma): static
    {
        $this->hoofdprogramma = $hoofdprogramma;

        return $this;
    }
}
