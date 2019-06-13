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
    private $titleFr;

    /**
      * @ORM\Column(type="integer")
      */
    private $contentType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleEn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentFr;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contentEn;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countryFr;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $countryEn;

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
        return $this->titleFr;
    }

    public function setTitleFr(string $titleFr): self
    {
        $this->titleFr = $titleFr;
        return $this;
    }

    public function getTitleEn(): ?string
    {
        return $this->titleEn;
    }

    public function setTitleEn(?string $titleEn): self
    {
        $this->titleEn = $titleEn;
        return $this;
    }

    public function getContentFr(): ?string
    {
        return $this->contentFr;
    }

    public function setContentFr(?string $contentFr): self
    {
        $this->contentFr = $contentFr;

        return $this;
    }

    public function getContentEn(): ?string
    {
        return $this->contentEn;
    }

    public function setContentEn(?string $contentEn): self
    {
        $this->contentEn = $contentEn;
        return $this;
    }

    public function getContentType(): ?int
    {
        return $this->contentType;
    }

    public function setContentType(int $contentType): self
    {
        $this->contentType = $contentType;

        return $this;
    }

    public function getCountryFr(): ?string
    {
        return $this->countryFr;
    }

    public function setCountryFr(?string $countryFr): self
    {
        $this->countryFr = $countryFr;
        return $this;
    }

    public function getCountryEn(): ?string
    {
        return $this->countryEn;
    }

    public function setCountryEn(?string $countryEn): self
    {
        $this->countryEn = $countryEn;
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
