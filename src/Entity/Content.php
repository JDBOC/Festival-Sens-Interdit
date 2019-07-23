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
        'festival' => 1,
        'actualités' => 2,
        'static_page' => 3,
        'hors scène' => 4,
        'tournée' => 5
    ];

    /**
     *
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
     * @ORM\Column(type="boolean")
     */
    private $complete = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $translated = false;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SiFile", cascade={"persist", "remove"})
     */
    private $cover;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SiFile", cascade={"persist", "remove"})
     */
    private $thumbnail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SiFile", mappedBy="pictureContent",cascade={"persist"})
     */
    private $pictures;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Content", inversedBy="isEcho")
     */
    private $enEcho;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Content", mappedBy="enEcho")
     */
    private $isEcho;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archive = false;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $director;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Theme", mappedBy="contents")
     */
    private $themes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $topArticle;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SiFile", cascade={"persist", "remove"})
     */
    private $carouselPicture;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
        $this->logos = new ArrayCollection();
        $this->pictures = new ArrayCollection();
        $this->enEcho = new ArrayCollection();
        $this->isEcho = new ArrayCollection();
        $this->themes = new ArrayCollection();
    }

    public function __toString():string
    {
        return array_search($this->getContentType(), self::CONTENT_TYPE)."-".$this->getTitleFr();
    }

    /**
    * returns the key linked to the value of the contentType const
    * @return string
    */
    public function getContentTypeName():string
    {
        return array_search($this->contentType, self::CONTENT_TYPE);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
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

    public function getCover(): ?SiFile
    {
        return $this->cover;
    }

    public function setCover(?Object $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getThumbnail(): ?SiFile
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?Object $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Collection|SiFile[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Object $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setPictureContent($this);
        }

        return $this;
    }

    public function removePicture(SiFile $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getPictureContent() === $this) {
                $picture->setPictureContent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getEnEcho(): Collection
    {
        return $this->enEcho;
    }

    public function addEnEcho(self $enEcho): self
    {
        if (!$this->enEcho->contains($enEcho)) {
            $this->enEcho[] = $enEcho;
        }

        return $this;
    }

    public function removeEnEcho(self $enEcho): self
    {
        if ($this->enEcho->contains($enEcho)) {
            $this->enEcho->removeElement($enEcho);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getIsEcho(): Collection
    {
        return $this->isEcho;
    }

    public function addIsEcho(self $isEcho): self
    {
        if (!$this->isEcho->contains($isEcho)) {
            $this->isEcho[] = $isEcho;
            $isEcho->addEnEcho($this);
        }

        return $this;
    }

    public function removeIsEcho(self $isEcho): self
    {
        if ($this->isEcho->contains($isEcho)) {
            $this->isEcho->removeElement($isEcho);
            $isEcho->removeEnEcho($this);
        }

        return $this;
    }

    public function getArchive(): ?bool
    {
        return $this->archive;
    }

    public function setArchive(bool $archive): self
    {
        $this->archive = $archive;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getDirector(): ?string
    {
        return $this->director;
    }

    public function setDirector(?string $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     *
     * @return self
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Object $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->addContent($this);
        }

        return $this;
    }

    public function removeTheme(Object $theme): self
    {
        if ($this->themes->contains($theme)) {
            $this->themes->removeElement($theme);
            $theme->removeContent($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTopArticle(): ?bool
    {
        return $this->topArticle;
    }

    public function setTopArticle(?bool $topArticle): self
    {
        $this->topArticle = $topArticle;

        return $this;
    }

    public function getCarouselPicture(): ?Object
    {
        return $this->carouselPicture;
    }

    public function setCarouselPicture(?Object $carouselPicture): self
    {
        $this->carouselPicture = $carouselPicture;

        return $this;
    }
}
