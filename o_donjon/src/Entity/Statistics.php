<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticsRepository::class)
 */
class Statistics
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $dexterity;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $constitution;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $intelligence;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $wisdom;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $charisma;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $passive_wisdom;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $proficiency_bonus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(int $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getPassiveWisdom(): ?int
    {
        return $this->passive_wisdom;
    }

    public function setPassiveWisdom(int $passive_wisdom): self
    {
        $this->passive_wisdom = $passive_wisdom;

        return $this;
    }

    public function getProficiencyBonus(): ?int
    {
        return $this->proficiency_bonus;
    }

    public function setProficiencyBonus(int $proficiency_bonus): self
    {
        $this->proficiency_bonus = $proficiency_bonus;

        return $this;
    }
}
