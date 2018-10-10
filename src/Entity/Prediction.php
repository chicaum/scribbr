<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PredictionRepository")
 */
class Prediction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="predictions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $provider;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scale;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $date;

    /**
     * @ORM\Column(type="time_immutable")
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $expires;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }

    public function getScale(): ?string
    {
        return $this->scale;
    }

    public function setScale(string $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?\DateTimeImmutable
    {
        return $this->time;
    }

    public function setTime(\DateTimeImmutable $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getExpires(): ?\DateTimeImmutable
    {
        return $this->expires;
    }

    public function setExpires(\DateTimeImmutable $expires): self
    {
        $this->expires = $expires;

        return $this;
    }
}
