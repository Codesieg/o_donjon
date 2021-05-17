<?php

namespace App\Entity;

use App\Repository\CampaignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CampaignRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Campaign
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"browse_campaign", "read_campaign", "read_user", "browse_npc", "read_npc","browse_story", "read_story", "browse_map", "read_map"})
     */
    private $id;

    /**
     * @Groups({"browse_campaign", "read_campaign", "read_user", "browse_npc", "read_npc","browse_story", "read_story", "browse_map", "read_map"})
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $name;

    /**
     * @Groups({"browse_campaign", "read_campaign"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Groups({"browse_campaign", "read_campaign"})
     * @ORM\Column(type="text", nullable=true)
     */
    private $memo;

    /**
     * @Groups({"browse_campaign", "read_campaign"})
     * @ORM\Column(type="boolean", options={"default": 0}, nullable=true)
     */
    private $isArchived;

    /**
     * @Groups({"browse_campaign", "read_campaign"})
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $invitationCode;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"browse_campaign", "read_campaign"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"browse_campaign", "read_campaign"})
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="OrganizedCampaigns")
    * @Groups({"browse_campaign", "read_campaign"})
     */
    private $owner;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="campaigns")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="campaign")
     * @Groups({"browse_campaign_character"})
     */
    private $characters;

    /**
     * @ORM\OneToMany(targetEntity=NPC::class, mappedBy="campaign")
     * @Groups({"browse_campaign_npc"})
     */
    private $NPCs;

    /**
     * @ORM\OneToMany(targetEntity=Story::class, mappedBy="campaign")
     * @Groups({"browse_campaign_stories"})
     */
    private $stories;

    /**
     * @ORM\OneToMany(targetEntity=Map::class, mappedBy="campaign")
     *  @Groups({"browse_campaign_maps"})
     */
    private $maps;


    // fonction appelée lors de la création d'un objet
    public function __construct()
    {   
        $this->users = new ArrayCollection();
        $this->characters = new ArrayCollection();
        $this->NPCs = new ArrayCollection();
        $this->stories = new ArrayCollection();
        $this->maps = new ArrayCollection();
        // associe la date de la création de l'objet à createdAt
        $this->createdAt = new \DateTime();
        // on génère un code d'invitation
        $this->invitationCode = uniqid();
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

    /**
     * @ORM\PreUpdate
     */
    
    public function setUpdatedAt(): self
    {   
        // on associe la date à updatedAt lors d'une modification
        $this->updatedAt = new \DateTime();

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

    /**
     * @Groups({"count_characters"})
     */
    public function getCountCharacters()
    {
        return $this->characters->count();
    }

    public function addCharacter(Character $character): self
    {
        if (!$this->characters->contains($character)) {
            $this->characters[] = $character;
            $character->setCampaignId($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getCampaign() === $this) {
                $character->setCampaignID(null);
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

    /**
     * @Groups({"count_npcs"})
     */
    public function getCountNpcs()
    {
        return $this->NPCs->count();
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
     * 
     */
    public function getStories(): Collection
    {
        return $this->stories;
    }

    /**
     * @Groups({"count_stories"})
     */
    public function getCountStories()
    {
        return $this->stories->count();
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

    /**
     * @Groups({"count_maps"})
     */
    public function getCountMaps()
    {
        return $this->maps->count();
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
