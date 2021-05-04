<?php

namespace App\Entity;

use App\Repository\CaracteristicRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaracteristicRepository::class)
 */
class Caracteristic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $inspiration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $armor_class;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $currentHP;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalHP;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $hitDice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deathSavesSuccess;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $deathSavesFailures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(?int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getInspiration(): ?bool
    {
        return $this->inspiration;
    }

    public function setInspiration(?bool $inspiration): self
    {
        $this->inspiration = $inspiration;

        return $this;
    }

    public function getArmorClass(): ?int
    {
        return $this->armor_class;
    }

    public function setArmorClass(?int $armor_class): self
    {
        $this->armor_class = $armor_class;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getCurrentHP(): ?int
    {
        return $this->currentHP;
    }

    public function setCurrentHP(?int $currentHP): self
    {
        $this->currentHP = $currentHP;

        return $this;
    }

    public function getTotalHP(): ?int
    {
        return $this->totalHP;
    }

    public function setTotalHP(?int $totalHP): self
    {
        $this->totalHP = $totalHP;

        return $this;
    }

    public function getHitDice(): ?string
    {
        return $this->hitDice;
    }

    public function setHitDice(?string $hitDice): self
    {
        $this->hitDice = $hitDice;

        return $this;
    }

    public function getDeathSavesSuccess(): ?int
    {
        return $this->deathSavesSuccess;
    }

    public function setDeathSavesSuccess(?int $deathSavesSuccess): self
    {
        $this->deathSavesSuccess = $deathSavesSuccess;

        return $this;
    }

    public function getDeathSavesFailures(): ?int
    {
        return $this->deathSavesFailures;
    }

    public function setDeathSavesFailures(?int $deathSavesFailures): self
    {
        $this->deathSavesFailures = $deathSavesFailures;

        return $this;
    }
}
