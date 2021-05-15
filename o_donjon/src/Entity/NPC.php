<?php

namespace App\Entity;

use App\Repository\NPCRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NPCRepository::class)
 */
class NPC
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"browse_npc", "read_npc", "browse_campaign_npc"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"browse_npc", "read_npc", "browse_campaign_npc"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"browse_npc", "read_npc", "browse_campaign_npc"})
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"browse_npc", "read_npc", "browse_campaign_npc"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"browse_npc", "read_npc", "browse_campaign_npc"})
     */
    private $isAlly;

    /**
     * @ORM\ManyToOne(targetEntity=Campaign::class, inversedBy="NPCs")
     * @Groups({"browse_npc", "read_npc"})
     */
    private $campaign;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsAlly(): ?int
    {
        return $this->isAlly;
    }

    public function setIsAlly(?int $isAlly): self
    {
        $this->isAlly = $isAlly;

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
}
