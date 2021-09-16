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
     * @ORM\Column(type="datetime")
     */
    private $bookedTime;

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
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $game;

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

    public function getBookedTime(): ?\DateTimeInterface
    {
        return $this->bookedTime;
    }

    public function setBookedTime(\DateTimeInterface $bookedTime): self
    {
        $this->bookedTime = $bookedTime;

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

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }
}
