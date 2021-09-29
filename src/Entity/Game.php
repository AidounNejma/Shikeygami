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
     * @ORM\Column(type="string", length=50, nullable=true)
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
     * @ORM\Column(type="string", length=255)
     */
    private $synopsis;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="game", orphanRemoval=true)
     */
    private $calendars;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageUrl2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageUrl3;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $difficulty;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->calendars = new ArrayCollection();
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

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getCalendars(): Collection
    {
        return $this->calendars;
    }

    public function addCalendar(Calendar $calendar): self
    {
        if (!$this->calendars->contains($calendar)) {
            $this->calendars[] = $calendar;
            $calendar->setGame($this);
        }

        return $this;
    }

    public function removeCalendar(Calendar $calendar): self
    {
        if ($this->calendars->removeElement($calendar)) {
            // set the owning side to null (unless already changed)
            if ($calendar->getGame() === $this) {
                $calendar->setGame(null);
            }
        }

        return $this;
    }

    public function getImageUrl2(): ?string
    {
        return $this->imageUrl2;
    }

    public function setImageUrl2(string $imageUrl2): self
    {
        $this->imageUrl2 = $imageUrl2;

        return $this;
    }

    public function getImageUrl3(): ?string
    {
        return $this->imageUrl3;
    }

    public function setImageUrl3(string $imageUrl3): self
    {
        $this->imageUrl3 = $imageUrl3;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }
}
