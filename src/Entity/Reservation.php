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
     * @ORM\Column(type="string", length=255)
     */
    private $TypeChambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $NombreDeChambre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pension;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Dispo;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrDeNuits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categorieChambre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeChambre(): ?string
    {
        return $this->TypeChambre;
    }

    public function setTypeChambre(string $TypeChambre): self
    {
        $this->TypeChambre = $TypeChambre;

        return $this;
    }

    public function getNombreDeChambre(): ?int
    {
        return $this->NombreDeChambre;
    }

    public function setNombreDeChambre(int $NombreDeChambre): self
    {
        $this->NombreDeChambre = $NombreDeChambre;

        return $this;
    }

    public function getPension(): ?string
    {
        return $this->Pension;
    }

    public function setPension(string $Pension): self
    {
        $this->Pension = $Pension;

        return $this;
    }

    public function getDispo(): ?string
    {
        return $this->Dispo;
    }

    public function setDispo(string $Dispo): self
    {
        $this->Dispo = $Dispo;

        return $this;
    }

    public function getNbrDeNuits(): ?int
    {
        return $this->nbrDeNuits;
    }

    public function setNbrDeNuits(int $nbrDeNuits): self
    {
        $this->nbrDeNuits = $nbrDeNuits;

        return $this;
    }

    public function getCategorieChambre(): ?string
    {
        return $this->categorieChambre;
    }

    public function setCategorieChambre(string $categorieChambre): self
    {
        $this->categorieChambre = $categorieChambre;

        return $this;
    }
}
