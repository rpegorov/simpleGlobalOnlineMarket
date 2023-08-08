<?php

namespace App\Controller;

use App\Controller\Dto\RequestDto;
use App\Services\CalculateService;
use App\Services\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/market')]
class MarketControllerImpl extends AbstractController {
    private FacadeControllerImpl $facade;

    /**
     * @param FacadeControllerImpl $facade
     */
    public function __construct(FacadeControllerImpl $facade) { $this->facade = $facade; }


    #[Route('/product/buy', name: 'buy_product', methods: ['POST'])]
    function buyProduct(RequestDto $dto): JsonResponse {
        return $this->facade->buyProduct($dto);
    }

    #[Route('/product/calculate', name: 'calculate_cost', methods: ['POST'])]
    function calculateCost(RequestDto $dto): JsonResponse {
        return $this->facade->calculateCost($dto);
    }
}