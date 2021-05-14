<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StoryRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Story
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $isDone;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $report;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"browse_story", "read_story", "browse_campaign_stories"})
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Campaign::class, inversedBy="stories")
     * @Groups({"browse_story", "read_story"})
     */
    private $campaign;

    public function __construct()
    {   
        // associe la date de la création de l'objet à createdAt
        $this->createdAt = new \DateTime();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(?bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getReport(): ?string
    {
        return $this->report;
    }

    public function setReport(?string $report): self
    {
        $this->report = $report;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate
     */

    public function setUpdatedAt(): self
    {
        // on associe la date à updatedAt lors d'une modification
        $this->updatedAt = new \DateTime();

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
