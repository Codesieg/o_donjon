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
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $memo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_archived;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $invitation_code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="campaign")
     */
    private $characters;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="campaigns")
     */
    private $dm;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="campaignsPlayed")
     */
    private $campaignUsers;

    /**
     * @ORM\OneToMany(targetEntity=Map::class, mappedBy="campaign")
     */
    private $maps;

    /**
     * @ORM\OneToMany(targetEntity=Npc::class, mappedBy="campaign")
     */
    private $npcs;

    /**
     * @ORM\OneToMany(targetEntity=Story::class, mappedBy="campaign")
     */
    private $stories;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->campaignUsers = new ArrayCollection();
        $this->maps = new ArrayCollection();
        $this->npcs = new ArrayCollection();
        $this->stories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getIsArchived(): ?bool
    {
        return $this->is_archived;
    }

    public function setIsArchived(bool $is_archived): self
    {
        $this->is_archived = $is_archived;

        return $this;
    }

    public function getInvitationCode(): ?string
    {
        return $this->invitation_code;
    }

    public function setInvitationCode(string $invitation_code): self
    {
        $this->invitation_code = $invitation_code;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
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

    public function getDm(): ?User
    {
        return $this->dm;
    }

    public function setDm(?User $dm): self
    {
        $this->dm = $dm;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getCampaignUsers(): Collection
    {
        return $this->campaignUsers;
    }

    public function addCampaignUser(User $campaignUser): self
    {
        if (!$this->campaignUsers->contains($campaignUser)) {
            $this->campaignUsers[] = $campaignUser;
        }

        return $this;
    }

    public function removeCampaignUser(User $campaignUser): self
    {
        $this->campaignUsers->removeElement($campaignUser);

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

    /**
     * @return Collection|Npc[]
     */
    public function getNpcs(): Collection
    {
        return $this->npcs;
    }

    public function addNpc(Npc $npc): self
    {
        if (!$this->npcs->contains($npc)) {
            $this->npcs[] = $npc;
            $npc->setCampaign($this);
        }

        return $this;
    }

    public function removeNpc(Npc $npc): self
    {
        if ($this->npcs->removeElement($npc)) {
            // set the owning side to null (unless already changed)
            if ($npc->getCampaign() === $this) {
                $npc->setCampaign(null);
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
}
