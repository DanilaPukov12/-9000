<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address_from;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address_at;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time_from;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $time_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\IsTrue(message="Это поле обязательно для заполенения")
     */
    private $is_confidentiality;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OrderStatus")
     */
    private $status;

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

    public function getAddressFrom(): ?string
    {
        return $this->address_from;
    }

    public function setAddressFrom(?string $address_from): self
    {
        $this->address_from = $address_from;

        return $this;
    }

    public function getAddressAt(): ?string
    {
        return $this->address_at;
    }

    public function setAddressAt(?string $address_at): self
    {
        $this->address_at = $address_at;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTimeFrom(): ?\DateTimeInterface
    {
        return $this->time_from;
    }

    public function setTimeFrom(?\DateTimeInterface $time_from): self
    {
        $this->time_from = $time_from;

        return $this;
    }

    public function getTimeAt(): ?\DateTimeInterface
    {
        return $this->time_at;
    }

    public function setTimeAt(?\DateTimeInterface $time_at): self
    {
        $this->time_at = $time_at;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(?int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getIsConfidentiality(): ?bool
    {
        return $this->is_confidentiality;
    }

    public function setIsConfidentiality(bool $is_confidentiality): self
    {
        $this->is_confidentiality = $is_confidentiality;

        return $this;
    }

    public function getStatus(): ?OrderStatus
    {
        return $this->status;
    }

    public function setStatus(?OrderStatus $status): self
    {
        $this->status = $status;

        return $this;
    }
}
