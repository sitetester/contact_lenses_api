<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CylinderRepository")
 * @ORM\Table(name="cylinders")
 */
class Cylinder
{
    public const MINUS_2_25 = '-2.25';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $option;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Axis", mappedBy="cylinder")
     */
    private $axes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Strength", mappedBy="cylinder")
     */
    private $strengths;

    public function __construct()
    {
        $this->axes = new ArrayCollection();
        $this->strengths = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOption(): ?string
    {
        return $this->option;
    }

    public function setOption(string $option): self
    {
        $this->option = $option;

        return $this;
    }

    /**
     * @return Collection|Axis[]
     */
    public function getAxes(): Collection
    {
        return $this->axes;
    }

    public function addAxe(Axis $axe): self
    {
        if (!$this->axes->contains($axe)) {
            $this->axes[] = $axe;
            $axe->setCylinder($this);
        }

        return $this;
    }

    public function removeAxe(Axis $axe): self
    {
        if ($this->axes->contains($axe)) {
            $this->axes->removeElement($axe);
            // set the owning side to null (unless already changed)
            if ($axe->getCylinder() === $this) {
                $axe->setCylinder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Strength[]
     */
    public function getStrengths(): Collection
    {
        return $this->strengths;
    }

    public function addStrength(Strength $strength): self
    {
        if (!$this->strengths->contains($strength)) {
            $this->strengths[] = $strength;
            $strength->setCylinder($this);
        }

        return $this;
    }

    public function removeStrength(Strength $strength): self
    {
        if ($this->strengths->contains($strength)) {
            $this->strengths->removeElement($strength);
            // set the owning side to null (unless already changed)
            if ($strength->getCylinder() === $this) {
                $strength->setCylinder(null);
            }
        }

        return $this;
    }
}
