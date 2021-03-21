<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 * @Vich\Uploadable
 */
class Hotel
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $starsNumber;

    /**
     * @var string
     * @ORM\Column(type="text", length=65535)
     * @Assert\NotBlank(message="your message")
     **/
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $localisation;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;


    /**
     * @Vich\UploadableField(mapping="happyTrip_images", fileNameProperty="image")
     * @Assert\NotBlank(message="please select an image")
     * @var File
     */
    private $imageHotel;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="hotel_comments")
     */
    private $comments;


    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, mappedBy="hotel_reservation", cascade={"persist", "remove"})
     */
    private $reservation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @return mixed
     */
    public function getAvailableRooms()
    {
        return $this->availableRooms;
    }

    /**
     * @param mixed $availableRooms
     */
    public function setAvailableRooms($availableRooms): void
    {
        $this->availableRooms = $availableRooms;
    }


    /**
     * @ORM\Column(type="integer")
     */
    private $availableRooms;

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }


    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStarsNumber()
    {
        return $this->starsNumber;
    }

    /**
     * @param mixed $starsNumber
     */
    public function setStarsNumber($starsNumber): void
    {
        $this->starsNumber = $starsNumber;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }



    /**
     * @return mixed
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * @param mixed $localisation
     */
    public function setLocalisation($localisation): void
    {
        $this->localisation = $localisation;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return File
     */
    public function getImageHotel(): File
    {
        return $this->imageHotel;
    }

    /**
     * @param File $imageHotel
     */
    public function setImageHotel(File $imageHotel): void
    {
        $this->imageHotel = $imageHotel;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setHotelComments($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getHotelComments() === $this) {
                $comment->setHotelComments(null);
            }
        }

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        // set the owning side of the relation if necessary
        if ($reservation->getHotelReservation() !== $this) {
            $reservation->setHotelReservation($this);
        }

        $this->reservation = $reservation;

        return $this;
    }



}
