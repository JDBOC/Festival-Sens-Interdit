<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 */
class Partner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $partnerType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $partnerName;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SiFile", cascade={"persist", "remove"})
     */
    private $partnerLogo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getPartnerType(): ?int
    {
        return $this->partnerType;
    }

    public function setPartnerType(?int $partnerType): self
    {
        $this->partnerType = $partnerType;

        return $this;
    }

    public function getPartnerName(): ?string
    {
        return $this->partnerName;
    }

    public function setPartnerName(string $partnerName): self
    {
        $this->partnerName = $partnerName;

        return $this;
    }

    public function getPartnerLogo(): ?SiFile
    {
        return $this->partnerLogo;
    }

    public function setPartnerLogo(?SiFile $partnerLogo): self
    {
        $this->partnerLogo = $partnerLogo;

        return $this;
    }
}
