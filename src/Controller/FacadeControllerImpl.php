<?php

namespace App\Controller;

use App\Controller\Dto\RequestDto;
use App\Services\CalculateService;
use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;

class FacadeControllerImpl implements FacadeMarketController {
    private ProductService $productService;
    private CalculateService $calculateService;

    /**
     * @param ProductService $productService
     * @param CalculateService $calculateService
     */
    public function __construct(ProductService $productService,
                                CalculateService $calculateService) {
        $this->productService = $productService;
        $this->calculateService = $calculateService;
    }


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

    function calculateCost(RequestDto $dto): JsonResponse {
        try {
            $calculatedPrice = $this->calculateService->calculatePrice($dto);
            return $this->json(['price' => $calculatedPrice], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}