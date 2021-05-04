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
     * @ORM\Column(type="integer", options={"default": "1"}))
     */
    private $level;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}))
     */
    private $experience;

    /**
     * @ORM\Column(type="boolean", options={"default": 0}))
     */
    private $inspiration;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}))
     */
    private $armor_class;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}))
     */
    private $current_hp;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $total_hp;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $hit_dice;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}))
     */
    private $death_saves_success;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $death_saves_failures;

    /**
     * @ORM\OneToOne(targetEntity=Character::class, inversedBy="caracteristics", cascade={"persist", "remove"})
     */
    private $character;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getInspiration(): ?bool
    {
        return $this->inspiration;
    }

    public function setInspiration(bool $inspiration): self
    {
        $this->inspiration = $inspiration;

        return $this;
    }

    public function getArmorClass(): ?int
    {
        return $this->armor_class;
    }

    public function setArmorClass(int $armor_class): self
    {
        $this->armor_class = $armor_class;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getCurrentHp(): ?int
    {
        return $this->current_hp;
    }

    public function setCurrentHp(int $current_hp): self
    {
        $this->current_hp = $current_hp;

        return $this;
    }

    public function getTotalHp(): ?int
    {
        return $this->total_hp;
    }

    public function setTotalHp(int $total_hp): self
    {
        $this->total_hp = $total_hp;

        return $this;
    }

    public function getHitDice(): ?string
    {
        return $this->hit_dice;
    }

    public function setHitDice(?string $hit_dice): self
    {
        $this->hit_dice = $hit_dice;

        return $this;
    }

    public function getDeathSavesSuccess(): ?int
    {
        return $this->death_saves_success;
    }

    public function setDeathSavesSuccess(int $death_saves_success): self
    {
        $this->death_saves_success = $death_saves_success;

        return $this;
    }

    public function getDeathSavesFailures(): ?int
    {
        return $this->death_saves_failures;
    }

    public function setDeathSavesFailures(int $death_saves_failures): self
    {
        $this->death_saves_failures = $death_saves_failures;

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
