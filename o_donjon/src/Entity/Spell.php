<?php

namespace App\Entity;

use App\Repository\SpellRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpellRepository::class)
 */
class Spell
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
    private $spellcasting_class;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}))
     */
    private $spell_attack_bonus;

    /**
     * @ORM\Column(type="integer", options={"default": "0"}))
     */
    private $spellcasting_ability;

    /**
     * @ORM\Column(type="integer", options={"default": "0"})
     */
    private $spell_save_dc;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $spells_list;

    /**
     * @ORM\OneToOne(targetEntity=Character::class, inversedBy="spells", cascade={"persist", "remove"})
     */
    private $character;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpellcastingClass(): ?string
    {
        return $this->spellcasting_class;
    }

    public function setSpellcastingClass(string $spellcasting_class): self
    {
        $this->spellcasting_class = $spellcasting_class;

        return $this;
    }

    public function getSpellAttackBonus(): ?int
    {
        return $this->spell_attack_bonus;
    }

    public function setSpellAttackBonus(int $spell_attack_bonus): self
    {
        $this->spell_attack_bonus = $spell_attack_bonus;

        return $this;
    }

    public function getSpellcastingAbility(): ?int
    {
        return $this->spellcasting_ability;
    }

    public function setSpellcastingAbility(int $spellcasting_ability): self
    {
        $this->spellcasting_ability = $spellcasting_ability;

        return $this;
    }

    public function getSpellSaveDc(): ?int
    {
        return $this->spell_save_dc;
    }

    public function setSpellSaveDc(int $spell_save_dc): self
    {
        $this->spell_save_dc = $spell_save_dc;

        return $this;
    }

    public function getSpellsList(): ?string
    {
        return $this->spells_list;
    }

    public function setSpellsList(?string $spells_list): self
    {
        $this->spells_list = $spells_list;

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