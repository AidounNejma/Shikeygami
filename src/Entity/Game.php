<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $room;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageUrl;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxPlayers;

    /**
     * @ORM\Column(type="integer")
     */
    private $minPlayers;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $gameMaster;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $gameDuration;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $pricePerPerson;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="game", orphanRemoval=true)
     */
    private $orders;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $synopsis;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function setRoom(?int $room): self
    {
        $this->room = $room;

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

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }

    public function setMaxPlayers(int $maxPlayers): self
    {
        $this->maxPlayers = $maxPlayers;

        return $this;
    }

    public function getMinPlayers(): ?int
    {
        return $this->minPlayers;
    }

    public function setMinPlayers(int $minPlayers): self
    {
        $this->minPlayers = $minPlayers;

        return $this;
    }

    public function getGameMaster(): ?string
    {
        return $this->gameMaster;
    }

    public function setGameMaster(string $gameMaster): self
    {
        $this->gameMaster = $gameMaster;

        return $this;
    }

    public function getGameDuration(): ?string
    {
        return $this->gameDuration;
    }

    public function setGameDuration(string $gameDuration): self
    {
        $this->gameDuration = $gameDuration;

        return $this;
    }

    public function getPricePerPerson(): ?string
    {
        return $this->pricePerPerson;
    }

    public function setPricePerPerson(string $pricePerPerson): self
    {
        $this->pricePerPerson = $pricePerPerson;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setGame($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getGame() === $this) {
                $order->setGame(null);
            }
        }

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }
}
