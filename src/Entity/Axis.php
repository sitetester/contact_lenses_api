<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AxisRepository")
 * @ORM\Table(name="axes")
 */
class Axis
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
    private $option;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cylinder", inversedBy="axes")
     */
    private $cylinder;

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

    public function getCylinder(): ?Cylinder
    {
        return $this->cylinder;
    }

    public function setCylinder(?Cylinder $cylinder): self
    {
        $this->cylinder = $cylinder;

        return $this;
    }
}
