<?php

namespace App\Entity;

use App\Repository\SavingThrowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SavingThrowRepository::class)
 */
class SavingThrow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", options={"default": "false"})
     */
    private $strength;

    /**
     * @ORM\Column(type="boolean", options={"default": "false"})
     */
    private $dexterity;

    /**
     * @ORM\Column(type="boolean", options={"default": "false"})
     */
    private $constitution;

    /**
     * @ORM\Column(type="boolean", options={"default": "false"})
     */
    private $intelligence;

    /**
     * @ORM\Column(type="boolean", options={"default": "false"})
     */
    private $wisdom;

    /**
     * @ORM\Column(type="boolean", options={"default": "false"})
     */
    private $charisma;

    /**
     * @ORM\OneToOne(targetEntity=Character::class, inversedBy="savingTrows", cascade={"persist", "remove"})
     */
    private $character;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrength(): ?bool
    {
        return $this->strength;
    }

    public function setStrength(bool $strength): self
    {
        $this->strengh = $strength;

        return $this;
    }

    public function getDexterity(): ?bool
    {
        return $this->dexterity;
    }

    public function setDexterity(bool $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?bool
    {
        return $this->constitution;
    }

    public function setConstitution(bool $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?bool
    {
        return $this->intelligence;
    }

    public function setIntelligence(bool $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?bool
    {
        return $this->wisdom;
    }

    public function setWisdom(bool $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?bool
    {
        return $this->charisma;
    }

    public function setCharisma(bool $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getCharacter(): ?Character
    {
        return $this->character;
    }

    public function setCharacter(?Character $character): self
    {
        $this->character = $character;

        return $this;
    }
}
