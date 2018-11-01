<?php

namespace App\Controller;

use App\Service\StrengthsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/strengths")
 */
class StrengthsController extends AbstractController
{
    private $strengthsManager;

    public function __construct(StrengthsManager $strengthsManager)
    {
        $this->strengthsManager = $strengthsManager;
    }

    /**
     * @Route("/", name="strengths_index")
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->strengthsManager->getAll(), 200, [], false);
    }

    /**
     * @Route("/cylinder/{cylinder}", name="strengths_filter_by_cylinder")
     */
    public function filterByCylinder(string $cylinder): JsonResponse
    {
        return new JsonResponse($this->strengthsManager->getAllByCylinder($cylinder), 200, [], false);
    }

    /**
     * @Route("/axis/{axis}", name="strengths_filter_by_axis")
     */
    public function filterByAxis(string $axis): JsonResponse
    {
        return new JsonResponse($this->strengthsManager->filterByAxis($axis), 200, [], false);
    }
}