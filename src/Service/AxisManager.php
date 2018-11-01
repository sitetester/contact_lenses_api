<?php

namespace App\Service;

use App\Entity\Axis;
use App\Entity\Cylinder;
use App\Repository\AxisRepository;
use App\Repository\CylinderRepository;
use App\Repository\StrengthRepository;

class AxisManager
{
    private $strengthRepository;
    private $cylinderRepository;
    private $axisRepository;

    public function __construct(
        StrengthRepository $strengthRepository,
        CylinderRepository $cylinderRepository,
        AxisRepository $axisRepository
    ) {
        $this->strengthRepository = $strengthRepository;
        $this->cylinderRepository = $cylinderRepository;
        $this->axisRepository = $axisRepository;
    }

    public function findByStrength(string $strengthOption): array
    {
        $strength = $this->strengthRepository->findOneBy(['option' => $strengthOption]);

        if ($strength->getCylinder() === null) {
            $axes = $this->findByCylinder(Cylinder::MINUS_2_25);
            $filteredAxes = array_filter($axes, function ($value) {
                return $value !== '20';
            });

            return $filteredAxes;
        }

        $axes = $this->getAll();
        unset($axes[0]);

        return $axes;
    }

    public function findByCylinder(string $cylinderOption): array
    {
        if ($cylinderOption === Cylinder::MINUS_2_25) {
            $cylinder = $this->cylinderRepository->findOneBy(['option' => $cylinderOption]);

            return $this->getOptionsArray($cylinder->getAxes()->toArray());
        }

        return $this->getAll();
    }

    /**
     * @param Axis[] $strengths
     * @return array
     */
    private function getOptionsArray(array $axes): array
    {
        $data = [];
        foreach ($axes as $axis) {
            $data[] = $axis->getOption();
        }

        return $data;
    }

    public function getAll(): array
    {
        return $this->getOptionsArray($this->axisRepository->findAll());
    }

}