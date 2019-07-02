<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 */
class Tarif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PassFestival;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PassJeune;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pleinTarif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reduce;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jeune;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $RSA;

    /**
     * @ORM\Column(type="integer")
     */
    private $grille;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Session", inversedBy="tarifs")
     */
    private $session;

    public function __construct()
    {
        $this->session = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPassFestival(): ?int
    {
        return $this->PassFestival;
    }

    public function setPassFestival(?int $PassFestival): self
    {
        $this->PassFestival = $PassFestival;

        return $this;
    }

    public function getPassJeune(): ?int
    {
        return $this->PassJeune;
    }

    public function setPassJeune(?int $PassJeune): self
    {
        $this->PassJeune = $PassJeune;

        return $this;
    }

    public function getPleinTarif(): ?int
    {
        return $this->pleinTarif;
    }

    public function setPleinTarif(?int $pleinTarif): self
    {
        $this->pleinTarif = $pleinTarif;

        return $this;
    }

    public function getReduce(): ?int
    {
        return $this->reduce;
    }

    public function setReduce(?int $reduce): self
    {
        $this->reduce = $reduce;

        return $this;
    }

    public function getJeune(): ?int
    {
        return $this->jeune;
    }

    public function setJeune(?int $jeune): self
    {
        $this->jeune = $jeune;

        return $this;
    }

    public function getRSA(): ?int
    {
        return $this->RSA;
    }

    public function setRSA(?int $RSA): self
    {
        $this->RSA = $RSA;

        return $this;
    }

    public function getGrille(): ?int
    {
        return $this->grille;
    }

    public function setGrille(int $grille): self
    {
        $this->grille = $grille;

        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSession(): Collection
    {
        return $this->session;
    }

    public function addSession(Session $session): self
    {
        if (!$this->session->contains($session)) {
            $this->session[] = $session;
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->session->contains($session)) {
            $this->session->removeElement($session);
        }

        return $this;
    }
}
