<?php

namespace App\Service;

use App\Entity\Cylinder;
use App\Repository\AxisRepository;
use App\Repository\CylinderRepository;
use App\Repository\StrengthRepository;

class CylindersManager
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
            return $this->getAll(Cylinder::MINUS_2_25);
        }

        return $this->getAll();
    }

    public function getAll($excludeOption = null): array
    {
        $cylinders = $this->cylinderRepository->findAll();

        $data = [];
        foreach ($cylinders as $cylinder) {
            if ($cylinder->getOption() !== $excludeOption) {
                $data[] = $cylinder->getOption();
            }
        }

        return $data;
    }

    public function findByAxis(string $axisOption): array
    {
        $axis = $this->axisRepository->findOneBy(['option' => $axisOption]);

        if ($axis->getCylinder() === null) {
            $cylinders = $this->cylinderRepository->filterByOption(Cylinder::MINUS_2_25);

            return $this->getOptionsArray($cylinders);
        }

        return $this->getAll();
    }

    /**
     * @param Cylinder[] $strengths
     * @return array
     */
    private function getOptionsArray(array $cylinders): array
    {
        $data = [];
        foreach ($cylinders as $cylinder) {
            $data[] = $cylinder->getOption();
        }

        return $data;
    }

}