<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContentRepository")
 */
class Content
{

    const CONTENT_TYPE = [
        'show' => 1,
        'news' => 2,
        'static_page' => 3
    ];
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
     * @ORM\Column(type="integer")
     */
    private $content_type;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Edition", inversedBy="contents")
     */
    private $edition;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Session", mappedBy="content", orphanRemoval=true)
     */
    private $sessions;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\SiFile", inversedBy="logoContents")
     */
    private $logos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SiFile", mappedBy="pictureContent")
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $complete;

    /**
     * @ORM\Column(type="boolean")
     */
    private $translated;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->logos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleFr(): ?string
    {
        return $this->title_fr;
    }

    public function setTitleFr(string $titleFr): self
    {
        $this->title_fr = $titleFr;

        return $this;
    }

    public function getTitleEn(): ?string
    {
        return $this->title_en;
    }

    public function setTitleEn(?string $titleEn): self
    {
        $this->title_en = $titleEn;

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

    public function setContentEn(?string $contentEn): self
    {
        $this->content_en = $contentEn;

        return $this;
    }

    public function getContentType(): ?int
    {
        return $this->content_type;
    }

    public function setContentType(int $contentType): self
    {
        $this->content_type = $contentType;

        return $this;
    }

    public function getCountryFr(): ?string
    {
        return $this->country_fr;
    }

    public function setCountryFr(?string $countryFr): self
    {
        $this->country_fr = $countryFr;

        return $this;
    }

    public function getCountryEn(): ?string
    {
        return $this->country_en;
    }

    public function setCountryEn(?string $countryEn): self
    {
        $this->country_en = $countryEn;

        return $this;
    }

    public function getEdition(): ?Edition
    {
        return $this->edition;
    }

    public function setEdition(?Object $edition): self
    {
        if ($edition instanceof Edition) {
            $this->edition = $edition;
        }
        return $this;
    }

    /**
     * @return Collection|Session[]
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions[] = $session;
            $session->setContent($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->contains($session)) {
            $this->sessions->removeElement($session);
            // set the owning side to null (unless already changed)
            if ($session->getContent() === $this) {
                $session->setContent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SiFile[]
     */
    public function getLogos(): Collection
    {
        return $this->logos;
    }

    public function addLogo(Object $logo): self
    {
        if (!$this->logos->contains($logo)) {
            $this->logos[] = $logo;
        }

        return $this;
    }

    public function removeLogo(SiFile $logo): self
    {
        if ($this->logos->contains($logo)) {
            $this->logos->removeElement($logo);
        }

        return $this;
    }

    /**
     * @return SiFile
     */
    public function getPicture(): SiFile
    {
        return $this->picture;
    }

    public function setPicture(Object $picture): self
    {
        if ($picture instanceof SiFile) {
            $this->picture = $picture;
        }
        return $this;
    }

    public function getComplete(): ?bool
    {
        return $this->complete;
    }

    public function setComplete(bool $complete): self
    {
        $this->complete = $complete;

        return $this;
    }

    public function getTranslated(): ?bool
    {
        return $this->translated;
    }

    public function setTranslated(bool $translated): self
    {
        $this->translated = $translated;

        return $this;
    }
}
