<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiFileRepository")
 */
class SiFile
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mimeType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Content", mappedBy="logos")
     */
    private $logoContents;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Content", inversedBy="picture")
     */
    private $pictureContent;

    public function __construct()
    {
        $this->logoContents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getLogoContents(): Collection
    {
        return $this->logoContents;
    }

    public function addLogoContent(Content $logoContent): self
    {
        if (!$this->logoContents->contains($logoContent)) {
            $this->logoContents[] = $logoContent;
            $logoContent->addLogo($this);
        }

        return $this;
    }

    public function removeLogoContent(Content $logoContent): self
    {
        if ($this->logoContents->contains($logoContent)) {
            $this->logoContents->removeElement($logoContent);
            $logoContent->removeLogo($this);
        }

        return $this;
    }

    public function getPictureContent(): ?Content
    {
        return $this->pictureContent;
    }

    public function setPictureContent(?Content $pictureContent): self
    {
        $this->pictureContent = $pictureContent;

        return $this;
    }
}
