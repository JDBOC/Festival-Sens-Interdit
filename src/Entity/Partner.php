<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartnerRepository")
 */
class Partner
{
    const TYPE = [
        1   => 'Partenaires Institutionnels',
        2   => 'Grand Partenaire',
        3   => 'Mécènes et Partenaires',
        4   => 'Partenaires et Médias',
        5   => 'Les Lieux Partenaires'
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
     * @ORM\Column(type="integer", nullable=true)
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

    public function getType() :?int
    {
        return $this->type;
    }

    public function getTypeByIndex(): ?string
    {
        return self::TYPE[$this->type];
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

    public function getLogo(): ?Object
    {
        return $this->logo;
    }

    public function setLogo(?Object $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTypeName(): string
    {
        return array_search($this->type, self::TYPE);
    }
}
