<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiFileRepository")
 * @Vich\Uploadable()
 */
class SiFile
{

    const FILE_TYPE = [
        'cover' => 1,  // used on the top of the show
        'logo' => 2,   // logo shared by multiple shows
        'editionPicture' => 3,  // picture illustrating the edition
        'contentPicture' => 4,  // picture displayed inside the content, can be multiple
        'thumbnail' => 5,
        'carouselPicture' => 6  // ude to illustrate show with a small squared picture"
    ];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="Uploaded_file", fileNameProperty="mediaFileName")
     * @Assert\NotBlank
     */
    private $mediaFile;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $mediaFileName;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Content", mappedBy="logos")
     */
    private $logoContents;

     /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Edition", mappedBy="editionPicture", cascade={"persist", "remove"})
     */
    private $edition;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="pictures")
     */
    private $pictureContent;


    public function __construct()
    {
        $this->logoContents = new ArrayCollection();
    }

    /**
     * returns the key linkd to the value of the filetype const
     * @return string
     */
    public function getFileTypeName():string
    {
        return array_search($this->type, self::FILE_TYPE);
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

    /**
     * @return File|null
     */
    public function getMediaFile(): ?File
    {
        return $this->mediaFile;
    }

    /**
     * @param File|null $mediaFile
     * @return SiFile
     */
    public function setMediaFile(?File $mediaFile): SiFile
    {
        $this->mediaFile = $mediaFile;

        // Only change the updated at if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->mediaFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMediaFileName(): ?string
    {
        return $this->mediaFileName;
    }

    /**
     * @param string|null $mediaFileName
     * @return SiFile
     */
    public function setMediaFileName(?string $mediaFileName): SiFile
    {
        $this->mediaFileName = $mediaFileName;

        // Only change the updated at if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->mediaFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }


    /**
     * @return \DateTimeInterface
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     * @return SiFile
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getEdition(): ?Edition
    {
        return $this->edition;
    }

    public function setEdition(?Edition $edition): self
    {
        $this->edition = $edition;

        // set (or unset) the owning side of the relation if necessary
        $newEditionPicture = $edition === null ? null : $this;
        if ($newEditionPicture !== $edition->getEditionPicture()) {
            $edition->setEditionPicture($newEditionPicture);
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
