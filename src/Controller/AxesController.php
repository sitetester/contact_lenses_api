<?php

namespace App\Controller;

use App\Service\AxisManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/axes")
 */
class AxesController extends AbstractController
{
    private $cylindersManager;

    public function __construct(AxisManager $cylindersManager)
    {
        $this->cylindersManager = $cylindersManager;
    }

    /**
     * @Route("/", name="axis_index")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->cylindersManager->getAll(), 200, [], false);
    }

    /**
     * @Route("/cylinder/{cylinder}", name="axis_filter_by_cylinder")
     */
    public function filterByCylinder(string $cylinder): JsonResponse
    {
        return new JsonResponse($this->cylindersManager->findByCylinder($cylinder), 200, [], false);
    }

    /**
     * @Route("/strength/{strength}", name="axis_filter_by_strength")
     */
    public function findByStrength(string $strength): JsonResponse
    {
        return new JsonResponse($this->cylindersManager->findByStrength($strength), 200, [], false);
    }
}