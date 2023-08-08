<?php

namespace App\Controller;

use App\Controller\Dto\RequestDto;
use App\Controller\Dto\ResponseBuyDto;
use App\Controller\Dto\ResponseCalculateDto;
use Symfony\Component\HttpFoundation\JsonResponse;

interface FacadeMarketController {


    function buyProduct(RequestDto $dto): JsonResponse;

    function calculateCost(RequestDto $dto): JsonResponse;

}