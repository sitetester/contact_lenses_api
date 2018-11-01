<?php

namespace App\Service;

use App\Entity\Cylinder;
use App\Entity\Strength;
use App\Repository\AxisRepository;
use App\Repository\CylinderRepository;
use App\Repository\StrengthRepository;

class StrengthsManager
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

    public function filterByAxis(int $axis): array
    {
        $axis = $this->axisRepository->findOneBy(['option' => $axis]);

        if ($axis->getCylinder() !== null) {
            return $this->getAll();
        }

        return $this->getAllByCylinder(Cylinder::MINUS_2_25);
    }

    public function getAll(): array
    {
        return $this->getOptionsArray($this->strengthRepository->findAll());
    }

    /**
     * @param Strength[] $strengths
     * @return array
     */
    private function getOptionsArray(array $strengths): array
    {
        $data = [];
        foreach ($strengths as $strength) {
            $data[] = $strength->getOption();
        }

        return $data;
    }

    public function getAllByCylinder(string $option): array
    {
        if ($option === Cylinder::MINUS_2_25) {
            $cylinder = $this->cylinderRepository->findOneBy(['option' => $option]);

            return $this->getOptionsArray($cylinder->getStrengths()->toArray());
        }

        return $this->getAll();
    }
}