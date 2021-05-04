<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampaignRepository::class)
 */
class Campaign
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $memo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isArchived;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $invitationCode;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="OrganizedCampaigns")
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="campaigns")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="campaign")
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity=NPC::class, mappedBy="campaign")
     */
    private $NPCs;

    /**
     * @ORM\OneToMany(targetEntity=Story::class, mappedBy="campaign")
     */
    private $stories;

    /**
     * @ORM\OneToMany(targetEntity=Map::class, mappedBy="campaign")
     */
    private $maps;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->characters = new ArrayCollection();
        $this->NPCs = new ArrayCollection();
        $this->stories = new ArrayCollection();
        $this->maps = new ArrayCollection();
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

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->isArchived;
    }

    public function setIsArchived(?bool $isArchived): self
    {
        $this->isArchived = $isArchived;

        return $this;
    }

    public function getInvitationCode(): ?string
    {
        return $this->invitationCode;
    }

    public function setInvitationCode(?string $invitationCode): self
    {
        $this->invitationCode = $invitationCode;

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

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addCampaign($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeCampaign($this);
        }

        return $this;
    }

    /**
     * @return Collection|Character[]
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setCampaign($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getCampaign() === $this) {
                $character->setCampaign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NPC[]
     */
    public function getNPCs(): Collection
    {
        return $this->NPCs;
    }

    public function addNPC(NPC $nPC): self
    {
        if (!$this->NPCs->contains($nPC)) {
            $this->NPCs[] = $nPC;
            $nPC->setCampaign($this);
        }

        return $this;
    }

    public function removeNPC(NPC $nPC): self
    {
        if ($this->NPCs->removeElement($nPC)) {
            // set the owning side to null (unless already changed)
            if ($nPC->getCampaign() === $this) {
                $nPC->setCampaign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Story[]
     */
    public function getStories(): Collection
    {
        return $this->stories;
    }

    public function addStory(Story $story): self
    {
        if (!$this->stories->contains($story)) {
            $this->stories[] = $story;
            $story->setCampaign($this);
        }

        return $this;
    }

    public function removeStory(Story $story): self
    {
        if ($this->stories->removeElement($story)) {
            // set the owning side to null (unless already changed)
            if ($story->getCampaign() === $this) {
                $story->setCampaign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Map[]
     */
    public function getMaps(): Collection
    {
        return $this->maps;
    }

    public function addMap(Map $map): self
    {
        if (!$this->maps->contains($map)) {
            $this->maps[] = $map;
            $map->setCampaign($this);
        }

        return $this;
    }

    public function removeMap(Map $map): self
    {
        if ($this->maps->removeElement($map)) {
            // set the owning side to null (unless already changed)
            if ($map->getCampaign() === $this) {
                $map->setCampaign(null);
            }
        }

        return $this;
    }
}
