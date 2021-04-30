<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CharacterRepository::class)
 * @ORM\Table(name="`character`")
 */
class Character
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar_path;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $initiative;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $eyes;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $skin;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $hair;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $appearance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $personnality_traits;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ideals;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $bonds;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $flaws;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $allies_and_organizations;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $backstory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $treasure;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $alignement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $attacks_and_spellcasting;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $equipment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $other_proficiencies_and_languages;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $features_and_traits;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_At;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated_At;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAvatarPath(): ?string
    {
        return $this->avatar_path;
    }

    public function setAvatarPath(?string $avatar_path): self
    {
        $this->avatar_path = $avatar_path;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getInitiative(): ?int
    {
        return $this->initiative;
    }

    public function setInitiative(?int $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getEyes(): ?string
    {
        return $this->eyes;
    }

    public function setEyes(?string $eyes): self
    {
        $this->eyes = $eyes;

        return $this;
    }

    public function getSkin(): ?string
    {
        return $this->skin;
    }

    public function setSkin(?string $skin): self
    {
        $this->skin = $skin;

        return $this;
    }

    public function getHair(): ?string
    {
        return $this->hair;
    }

    public function setHair(?string $hair): self
    {
        $this->hair = $hair;

        return $this;
    }

    public function getAppearance(): ?string
    {
        return $this->appearance;
    }

    public function setAppearance(?string $appearance): self
    {
        $this->appearance = $appearance;

        return $this;
    }

    public function getPersonnalityTraits(): ?string
    {
        return $this->personnality_traits;
    }

    public function setPersonnalityTraits(string $personnality_traits): self
    {
        $this->personnality_traits = $personnality_traits;

        return $this;
    }

    public function getIdeals(): ?string
    {
        return $this->ideals;
    }

    public function setIdeals(?string $ideals): self
    {
        $this->ideals = $ideals;

        return $this;
    }

    public function getBonds(): ?string
    {
        return $this->bonds;
    }

    public function setBonds(?string $bonds): self
    {
        $this->bonds = $bonds;

        return $this;
    }

    public function getFlaws(): ?string
    {
        return $this->flaws;
    }

    public function setFlaws(?string $flaws): self
    {
        $this->flaws = $flaws;

        return $this;
    }

    public function getAlliesAndOrganizations(): ?string
    {
        return $this->allies_and_organizations;
    }

    public function setAlliesAndOrganizations(?string $allies_and_organizations): self
    {
        $this->allies_and_organizations = $allies_and_organizations;

        return $this;
    }

    public function getBackstory(): ?string
    {
        return $this->backstory;
    }

    public function setBackstory(?string $backstory): self
    {
        $this->backstory = $backstory;

        return $this;
    }

    public function getTreasure(): ?string
    {
        return $this->treasure;
    }

    public function setTreasure(?string $treasure): self
    {
        $this->treasure = $treasure;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getAlignement(): ?string
    {
        return $this->alignement;
    }

    public function setAlignement(?string $alignement): self
    {
        $this->alignement = $alignement;

        return $this;
    }

    public function getAttacksAndSpellcasting(): ?string
    {
        return $this->attacks_and_spellcasting;
    }

    public function setAttacksAndSpellcasting(?string $attacks_and_spellcasting): self
    {
        $this->attacks_and_spellcasting = $attacks_and_spellcasting;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(?string $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getOtherProficienciesAndLanguages(): ?string
    {
        return $this->other_proficiencies_and_languages;
    }

    public function setOtherProficienciesAndLanguages(?string $other_proficiencies_and_languages): self
    {
        $this->other_proficiencies_and_languages = $other_proficiencies_and_languages;

        return $this;
    }

    public function getFeaturesAndTraits(): ?string
    {
        return $this->features_and_traits;
    }

    public function setFeaturesAndTraits(?string $features_and_traits): self
    {
        $this->features_and_traits = $features_and_traits;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_At;
    }

    public function setCreatedAt(\DateTimeInterface $created_At): self
    {
        $this->created_At = $created_At;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_At;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_At): self
    {
        $this->updated_At = $updated_At;

        return $this;
    }
}
