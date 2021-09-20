<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfOrder;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $totalPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $paymentStatus;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $player_quantity;

    /**
     * @ORM\OneToOne(targetEntity=Calendar::class, mappedBy="booked", cascade={"persist", "remove"})
     */
    private $calendar;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOfOrder(): ?\DateTimeInterface
    {
        return $this->dateOfOrder;
    }

    public function setDateOfOrder(\DateTimeInterface $dateOfOrder): self
    {
        $this->dateOfOrder = $dateOfOrder;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(string $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getPaymentStatus(): ?int
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(int $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPlayerQuantity(): ?int
    {
        return $this->player_quantity;
    }

    public function setPlayerQuantity(int $player_quantity): self
    {
        $this->player_quantity = $player_quantity;

        return $this;
    }

    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function setCalendar(?Calendar $calendar): self
    {
        // unset the owning side of the relation if necessary
        if ($calendar === null && $this->calendar !== null) {
            $this->calendar->setBooked(null);
        }

        // set the owning side of the relation if necessary
        if ($calendar !== null && $calendar->getBooked() !== $this) {
            $calendar->setBooked($this);
        }

        $this->calendar = $calendar;

        return $this;
    }
}
