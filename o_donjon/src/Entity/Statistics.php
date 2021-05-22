<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $strength;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $dexterity;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $constitution;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $intelligence;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $wisdom;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $charisma;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $passiveWisdom;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character", "browse_character", "browse_campaign_character"})
     */
    private $proficiencyBonus;

    public function __construct()
    {   
        $this->strength = 0;
        $this->dexterity = 0;
        $this->constitution = 0;
        $this->intelligence = 0;
        $this->wisdom = 0;
        $this->charisma = 0;
        $this->passiveWisdom = 0;
        $this->proficiencyBonus = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(?int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(?int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(?int $constitution): self
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(?int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(?int $wisdom): self
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(?int $charisma): self
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getPassiveWisdom(): ?int
    {
        return $this->passiveWisdom;
    }

    public function setPassiveWisdom(?int $passiveWisdom): self
    {
        $this->passiveWisdom = $passiveWisdom;

        return $this;
    }

    public function getProficiencyBonus(): ?int
    {
        return $this->proficiencyBonus;
    }

    public function setProficiencyBonus(?int $proficiencyBonus): self
    {
        $this->proficiencyBonus = $proficiencyBonus;

        return $this;
    }
}
