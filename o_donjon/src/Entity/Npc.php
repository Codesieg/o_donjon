<?php

namespace App\Entity;

use App\Repository\NpcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NpcRepository::class)
 */
class Npc
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=64, options={"default": "NEUTRAL"})
     */
    private $is_ally;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Campaign::class, inversedBy="npcs")
     */
    private $campaign;

    /**
     * @ORM\ManyToMany(targetEntity=Story::class, inversedBy="npcs")
     */
    private $story;

    public function __construct()
    {
        $this->story = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIsAlly(): ?string
    {
        return $this->is_ally;
    }

    public function setIsAlly(string $is_ally): self
    {
        $this->is_ally = $is_ally;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): self
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * @return Collection|Story[]
     */
    public function getStory(): Collection
    {
        return $this->story;
    }

    public function addStory(Story $story): self
    {
        if (!$this->story->contains($story)) {
            $this->story[] = $story;
        }

        return $this;
    }

    public function removeStory(Story $story): self
    {
        $this->story->removeElement($story);

        return $this;
    }
}
