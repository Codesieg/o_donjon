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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $strength;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $dexterity;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $constitution;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $intelligence;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $wisdom;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $charisma;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrength(): ?bool
    {
        return $this->strength;
    }

    public function setStrength(?bool $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?bool
    {
        return $this->dexterity;
    }

    public function setDexterity(?bool $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?bool
    {
        return $this->constitution;
    }

    public function setConstitution(?bool $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?bool
    {
        return $this->intelligence;
    }

    public function setIntelligence(?bool $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?bool
    {
        return $this->wisdom;
    }

    public function setWisdom(?bool $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?bool
    {
        return $this->charisma;
    }

    public function setCharisma(?bool $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }
}
