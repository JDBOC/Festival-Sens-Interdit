<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 */
class Partner
{
    const TYPE = [
        'Partenaires Institutionnels'   => 1,
        'Grand Partenaire'              => 2,
        'Mécènes et Partenaires'        => 3,
        'Partenaires et Médias'         => 4,
        'Les Lieux Partenaires'         => 5,
        'Autres Partenaires'            => 6
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
    private $link;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\SiFile", cascade={"persist", "remove"})
     */
    private $logo;

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

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getLogo(): ?SiFile
    {
        return $this->logo;
    }

    public function setLogo(?SiFile $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTypeName(): string
    {
        return array_search($this->type, self::TYPE);
    }
}
