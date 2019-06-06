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
     * @ORM\OneToMany(targetEntity="App\Entity\SiFile", mappedBy="pictureContent")
     */
    private $picture;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->logos = new ArrayCollection();
        $this->picture = new ArrayCollection();
    }

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

    public function setContentType(int $contentType): self
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

    public function getEdition(): ?Edition
    {
        return $this->edition;
    }

    public function setEdition(?Edition $edition): self
    {
        $this->edition = $edition;

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

    public function addLogo(SiFile $logo): self
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
     * @return Collection|SiFile[]
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(SiFile $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture[] = $picture;
            $picture->setPictureContent($this);
        }

        return $this;
    }

    public function removePicture(SiFile $picture): self
    {
        if ($this->picture->contains($picture)) {
            $this->picture->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getPictureContent() === $this) {
                $picture->setPictureContent(null);
            }
        }

        return $this;
    }
}
