<?php

namespace App\Entity;

use App\Repository\CaracteristicRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

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
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $level;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $experience;

    /**
     * @ORM\Column(type="boolean", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $inspiration;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $armorClass;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $currentHP;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $totalHP;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"read_character"})
     */
    private $hitDice;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $deathSavesSuccess;

    /**
     * @ORM\Column(type="integer", options={"default": 0})
     * @Groups({"read_character"})
     */
    private $deathSavesFailures;

    public function __construct()
    {   
        $this->level = 0;
        $this->experience = 0;
        $this->inspiration = 0;
        $this->armorClass = 0;
        $this->speed = 0;
        $this->currentHP = 0;
        $this->totalHP = 0;
        $this->deathSavesSuccess = 0;
        $this->deathSavesFailures = 0;
    }

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
        return $this->armorClass;
    }

    public function setArmorClass(?int $armorClass): self
    {
        $this->armor_class = $armorClass;

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
