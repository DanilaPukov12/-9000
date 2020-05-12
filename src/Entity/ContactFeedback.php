<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactFeedbackRepository")
 */
class ContactFeedback
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "Имя не должно быть пустым"
     * )
     */
    private $nameclient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message = "Тема сообщения должна быть заполнена"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "Email - {{ value }} не является действительным адресом электронной почты."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(
     *     message = "Вы забыли написать сообщение"
     * )
     */
    private $content;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameclient(): ?string
    {
        return $this->nameclient;
    }

    public function setNameclient(string $nameclient): self
    {
        $this->nameclient = $nameclient;

        return $this;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
}
