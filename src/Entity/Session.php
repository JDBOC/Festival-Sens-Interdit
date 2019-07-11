<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $sessionDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="sessions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mapadoLink;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tarif", mappedBy="session")
     */
    private $tarifs;


    public function __construct()
    {
        $this->tarifs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSessionDate(): ?\DateTimeInterface
    {
        return $this->sessionDate;
    }

    public function setSessionDate(\DateTimeInterface $sessionDate): self
    {
        $this->sessionDate = $sessionDate;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getContent(): ?Content
    {
        return $this->content;
    }

    public function setContent(?Object $content): self
    {
        if ($content instanceof Content) {
            $this->content = $content;
        }
            return $this;
    }

    /**
     * @return Collection|Tarif[]
     */
    public function getTarifs(): Collection
    {
        return $this->tarifs;
    }

    public function addTarif(Object $tarif): self
    {
        if (!$this->tarifs->contains($tarif)) {
            $this->tarifs[] = $tarif;
            $tarif->addSession($this);
        }

        return $this;
    }

    public function removeTarif(Object $tarif): self
    {
        if ($this->tarifs->contains($tarif)) {
            $this->tarifs->removeElement($tarif);
            $tarif->removeSession($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMapadoLink()
    {
        return $this->mapadoLink;
    }

    /**
     * @param mixed $mapadoLink
     *
     * @return self
     */
    public function setMapadoLink($mapadoLink)
    {
        $this->mapadoLink = $mapadoLink;

        return $this;
    }
}
