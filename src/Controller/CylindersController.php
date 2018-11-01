<?php

namespace App\Controller;

use App\Service\CylindersManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cylinders")
 */
class CylindersController extends AbstractController
{
    private $cylindersManager;

    public function __construct(CylindersManager $cylindersManager)
    {
        $this->cylindersManager = $cylindersManager;
    }

    /**
     * @Route("/", name="cylinders_index")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->cylindersManager->getAll(), 200, [], false);
    }

    /**
     * @Route("/strength/{strength}", name="cylinders_filter_by_strength")
     */
    public function filterByStrength(string $strength): JsonResponse
    {
        return new JsonResponse($this->cylindersManager->findByStrength($strength), 200, [], false);
    }

    /**
     * @Route("/axis/{axis}", name="cylinders_filter_by_axis")
     */
    public function filterByAxis(string $axis): JsonResponse
    {
        return new JsonResponse($this->cylindersManager->findByAxis($axis), 200, [], false);
    }
}