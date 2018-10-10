<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProviderRepository")
 */
class Provider
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
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prediction",
     *     mappedBy="provider", cascade={"persist"})
     */
    private $predictions;

    /**
     * Provider constructor.
     */
    public function __construct()
    {
        $this->active = true;
        $this->predictions = new ArrayCollection();
    }

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|Prediction[]
     */
    public function getPredictions(): Collection
    {
        return $this->predictions;
    }

    public function addPrediction(Prediction $prediction): self
    {
        if (!$this->predictions->contains($prediction)) {
            $this->predictions[] = $prediction;
            $prediction->setProvider($this);
        }

        return $this;
    }

    public function removePrediction(Prediction $prediction): self
    {
        if ($this->predictions->contains($prediction)) {
            $this->predictions->removeElement($prediction);
            // set the owning side to null (unless already changed)
            if ($prediction->getProvider() === $this) {
                $prediction->setProvider(null);
            }
        }

        return $this;
    }
}
