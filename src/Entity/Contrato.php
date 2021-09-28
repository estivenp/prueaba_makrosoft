<?php

namespace App\Entity;

use App\Repository\ContratoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratoRepository::class)
 */
class Contrato
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_contrato;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_contrato;

    /**
     * @ORM\Column(type="integer")
     */
    private $valor_total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumContrato(): ?int
    {
        return $this->num_contrato;
    }

    public function setNumContrato(int $num_contrato): self
    {
        $this->num_contrato = $num_contrato;

        return $this;
    }

    public function getFechaContrato(): ?\DateTimeInterface
    {
        return $this->fecha_contrato;
    }

    public function setFechaContrato(\DateTimeInterface $fecha_contrato): self
    {
        $this->fecha_contrato = $fecha_contrato;

        return $this;
    }

    public function getValorTotal(): ?int
    {
        return $this->valor_total;
    }

    public function setValorTotal(int $valor_total): self
    {
        $this->valor_total = $valor_total;

        return $this;
    }
}
