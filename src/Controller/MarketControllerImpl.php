<?php

namespace App\Controller;

use App\Controller\Dto\RequestDto;
use App\Services\CalculateService;
use App\Services\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/api/market')]
class MarketControllerImpl extends AbstractController implements FacadeMarketController {
    private ProductService $productService;
    private CalculateService $calculateService;
    private ProductValidator $productValidator;

    #[Route('/product/buy', name: 'buy_product', methods: ['POST'])]
    function buyProduct(RequestDto $dto): JsonResponse {
        try {
            $calculatedPrice = $this->calculateService->calculatePrice($dto);
            $buyResult = $this->productService->buyProduct($dto, $calculatedPrice);
            return $this->json([
                'price' => $calculatedPrice,
                'product' => $buyResult],
                JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/product/calculate', name: 'calculate_cost', methods: ['POST'])]
    function calculateCost(RequestDto $dto): JsonResponse {
        try {
            $calculatedPrice = $this->calculateService->calculatePrice($dto);
            return $this->json(['price' => $calculatedPrice], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}