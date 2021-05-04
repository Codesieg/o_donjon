<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillRepository::class)
 */
class Skill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $acrobatics;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $animalHandling;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $arcana;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $athletics;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $deception;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $history;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $insight;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $intimidation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $investigation;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $medecine;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $nature;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $perception;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $performance;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $persuasion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $religion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sleightOfHand;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $stealth;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $survival;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcrobatics(): ?bool
    {
        return $this->acrobatics;
    }

    public function setAcrobatics(bool $acrobatics): self
    {
        $this->acrobatics = $acrobatics;

        return $this;
    }

    public function getAnimalHandling(): ?bool
    {
        return $this->animalHandling;
    }

    public function setAnimalHandling(?bool $animalHandling): self
    {
        $this->animalHandling = $animalHandling;

        return $this;
    }

    public function getArcana(): ?bool
    {
        return $this->arcana;
    }

    public function setArcana(?bool $arcana): self
    {
        $this->arcana = $arcana;

        return $this;
    }

    public function getAthletics(): ?bool
    {
        return $this->athletics;
    }

    public function setAthletics(?bool $athletics): self
    {
        $this->athletics = $athletics;

        return $this;
    }

    public function getDeception(): ?bool
    {
        return $this->deception;
    }

    public function setDeception(?bool $deception): self
    {
        $this->deception = $deception;

        return $this;
    }

    public function getHistory(): ?bool
    {
        return $this->history;
    }

    public function setHistory(?bool $history): self
    {
        $this->history = $history;

        return $this;
    }

    public function getInsight(): ?bool
    {
        return $this->insight;
    }

    public function setInsight(?bool $insight): self
    {
        $this->insight = $insight;

        return $this;
    }

    public function getIntimidation(): ?bool
    {
        return $this->intimidation;
    }

    public function setIntimidation(?bool $intimidation): self
    {
        $this->intimidation = $intimidation;

        return $this;
    }

    public function getInvestigation(): ?bool
    {
        return $this->investigation;
    }

    public function setInvestigation(?bool $investigation): self
    {
        $this->investigation = $investigation;

        return $this;
    }

    public function getMedecine(): ?bool
    {
        return $this->medecine;
    }

    public function setMedecine(?bool $medecine): self
    {
        $this->medecine = $medecine;

        return $this;
    }

    public function getNature(): ?bool
    {
        return $this->nature;
    }

    public function setNature(?bool $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getPerception(): ?bool
    {
        return $this->perception;
    }

    public function setPerception(?bool $perception): self
    {
        $this->perception = $perception;

        return $this;
    }

    public function getPerformance(): ?bool
    {
        return $this->performance;
    }

    public function setPerformance(?bool $performance): self
    {
        $this->performance = $performance;

        return $this;
    }

    public function getPersuasion(): ?bool
    {
        return $this->persuasion;
    }

    public function setPersuasion(?bool $persuasion): self
    {
        $this->persuasion = $persuasion;

        return $this;
    }

    public function getReligion(): ?bool
    {
        return $this->religion;
    }

    public function setReligion(?bool $religion): self
    {
        $this->religion = $religion;

        return $this;
    }

    public function getSleightOfHand(): ?bool
    {
        return $this->sleightOfHand;
    }

    public function setSleightOfHand(?bool $sleightOfHand): self
    {
        $this->sleightOfHand = $sleightOfHand;

        return $this;
    }

    public function getStealth(): ?bool
    {
        return $this->stealth;
    }

    public function setStealth(?bool $stealth): self
    {
        $this->stealth = $stealth;

        return $this;
    }

    public function getSurvival(): ?bool
    {
        return $this->survival;
    }

    public function setSurvival(?bool $survival): self
    {
        $this->survival = $survival;

        return $this;
    }
}
