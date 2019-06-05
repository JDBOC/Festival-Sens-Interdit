<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title_fr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contentType;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content_fr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content_en;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country_fr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mapadoLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleFr(): ?string
    {
        return $this->title_fr;
    }

    public function setTitleFr(string $title_fr): self
    {
        $this->title_fr = $title_fr;

        return $this;
    }

    public function getTitleEn(): ?string
    {
        return $this->title_en;
    }

    public function setTitleEn(?string $title_en): self
    {
        $this->title_en = $title_en;

        return $this;
    }

    public function getContentFr(): ?string
    {
        return $this->content_fr;
    }

    public function setContentFr(?string $content_fr): self
    {
        $this->content_fr = $content_fr;

        return $this;
    }

    public function getContentEn(): ?string
    {
        return $this->content_en;
    }

    public function setContentEn(?string $content_en): self
    {
        $this->content_en = $content_en;

        return $this;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(string $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCountryFr(): ?string
    {
        return $this->country_fr;
    }

    public function setCountryFr(?string $country_fr): self
    {
        $this->country_fr = $country_fr;

        return $this;
    }

    public function getCountryEn(): ?string
    {
        return $this->country_en;
    }

    public function setCountryEn(?string $country_en): self
    {
        $this->country_en = $country_en;

        return $this;
    }

    public function getMapadoLink(): ?string
    {
        return $this->mapadoLink;
    }

    public function setMapadoLink(?string $mapadoLink): self
    {
        $this->mapadoLink = $mapadoLink;

        return $this;
    }
}
