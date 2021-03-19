<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfNights;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfAdults;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfChilds;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomType;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\OneToOne(targetEntity=Hotel::class, inversedBy="reservation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel_reservation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getNumberOfNights(): ?int
    {
        return $this->numberOfNights;
    }

    public function setNumberOfNights(int $numberOfNights): self
    {
        $this->numberOfNights = $numberOfNights;

        return $this;
    }

    public function getNumberOfrooms(): ?int
    {
        return $this->numberOfrooms;
    }

    public function setNumberOfrooms(int $numberOfrooms): self
    {
        $this->numberOfrooms = $numberOfrooms;

        return $this;
    }

    public function getNumberOfAdults(): ?int
    {
        return $this->numberOfAdults;
    }

    public function setNumberOfAdults(int $numberOfAdults): self
    {
        $this->numberOfAdults = $numberOfAdults;

        return $this;
    }

    public function getNumberOfChilds(): ?int
    {
        return $this->numberOfChilds;
    }

    public function setNumberOfChilds(int $numberOfChilds): self
    {
        $this->numberOfChilds = $numberOfChilds;

        return $this;
    }

    public function getRoomType(): ?string
    {
        return $this->roomType;
    }

    public function setRoomType(string $roomType): self
    {
        $this->roomType = $roomType;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getHotelReservation(): ?Hotel
    {
        return $this->hotel_reservation;
    }

    public function setHotelReservation(Hotel $hotel_reservation): self
    {
        $this->hotel_reservation = $hotel_reservation;

        return $this;
    }
}
