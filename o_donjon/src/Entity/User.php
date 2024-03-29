<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"browse_user", "read_user", "browse_campaign", "list_character", "read_character", "read_campaign", "browse_campaign_character"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read_user", "browse_campaign_character"})
     */
    private $email;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     * @Groups({"browse_user", "read_user", "list_campaign", "list_character", "read_character", "browse_campaign", "read_campaign", "browse_campaign_character"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"browse_user", "read_user"})
     */
    private $avatarPath;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Campaign::class, mappedBy="owner")
     */
    private $OrganizedCampaigns;

    /**
     * @ORM\ManyToMany(targetEntity=Campaign::class, inversedBy="users")
     * @Groups({"list_campaign", "read_user"})
     */
    private $campaigns;

    /**
     * @ORM\OneToMany(targetEntity=Character::class, mappedBy="user")
     * @Groups({"list_character", "read_user"})
     */
    private $characters;

    public function __construct()
    {
        $this->OrganizedCampaigns = new ArrayCollection();
        $this->campaigns = new ArrayCollection();
        $this->characters = new ArrayCollection();
        // associe la date de la création de l'objet à createdAt
        $this->createdAt = new \DateTime();
        $this->status = 1;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getAvatarPath(): ?string
    {
        return $this->avatarPath;
    }

    public function setAvatarPath(?string $avatarPath): self
    {
        $this->avatarPath = $avatarPath;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

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

    /**
     * @return Collection|Campaign[]
     */
    public function getOrganizedCampaigns(): Collection
    {
        return $this->OrganizedCampaigns;
    }

    public function addOrganizedCampaign(Campaign $organizedCampaign): self
    {
        if (!$this->OrganizedCampaigns->contains($organizedCampaign)) {
            $this->OrganizedCampaigns[] = $organizedCampaign;
            $organizedCampaign->setOwner($this);
        }

        return $this;
    }

    public function removeOrganizedCampaign(Campaign $organizedCampaign): self
    {
        if ($this->OrganizedCampaigns->removeElement($organizedCampaign)) {
            // set the owning side to null (unless already changed)
            if ($organizedCampaign->getOwner() === $this) {
                $organizedCampaign->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Campaign[]
     */
    public function getCampaigns(): Collection
    {
        return $this->campaigns;
    }

    public function addCampaign(Campaign $campaign): self
    {
        if (!$this->campaigns->contains($campaign)) {
            $this->campaigns[] = $campaign;
        }

        return $this;
    }

    public function removeCampaign(Campaign $campaign): self
    {
        $this->campaigns->removeElement($campaign);

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
            $character->setUser($this);
        }

        return $this;
    }

    public function removeCharacter(Character $character): self
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getUser() === $this) {
                $character->setUser(null);
            }
        }

        return $this;
    }
}
