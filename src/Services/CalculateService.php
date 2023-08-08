<?php

namespace App\Services;

use App\Controller\Dto\RequestDto;
use App\Entity\ProductStructure;
use App\Repository\AccessoriesRepository;
use App\Repository\CouponsRepository;
use App\Repository\HeadphoneRepository;
use App\Repository\PhoneRepository;
use App\Repository\ProductDao;
use App\Repository\ProductStructureRepository;
use App\Repository\TaxRateRepository;
use phpDocumentor\Reflection\Types\This;

class CalculateService {
    private PhoneRepository $phoneRepository;
    private HeadphoneRepository $headphoneRepository;
    private AccessoriesRepository $accessoriesRepository;
    private TaxRateRepository $rateRepository;
    private ProductStructureRepository $productStructureRepository;
    private CouponsRepository $couponsRepository;
    private ProductDao $productDao;

    public function getProductDao(): ProductDao {
        return $this->productDao;
    }

    public function getProductStructureRepository(): ProductStructureRepository {
        return $this->productStructureRepository;
    }

    public function getCouponsRepository(): CouponsRepository {
        return $this->couponsRepository;
    }

    public function getPhoneRepository(): PhoneRepository {
        return $this->phoneRepository;
    }

    public function getHeadphoneRepository(): HeadphoneRepository {
        return $this->headphoneRepository;
    }

    public function getAccessoriesRepository(): AccessoriesRepository {
        return $this->accessoriesRepository;
    }

    public function getRateRepository(): TaxRateRepository {
        return $this->rateRepository;
    }

    public function calculatePrice(RequestDto $dto): float|int {
        $productRepository = $this->getProductDao()->findProductRepos($dto);
        $taxRate = $this->findTaxRate($dto);

        $product = $productRepository->findOneBy(['uuid' => $dto->productUuid]);
        if (!$product) {
            throw new \InvalidArgumentException('Product not found');
        }
        $productPrice = $product->getPrice();

        $taxRateValue = $this->findTaxRate($dto);

        $finalPrice = $productPrice + ($productPrice * $taxRateValue);

        if ($dto->couponCode) {
            $coupon = $this->couponsRepository->findOneBy(['code' => $dto->couponCode]);
            if ($coupon) {
                $couponType = $coupon->getType();

                if ($couponType === 'fixed') {
                    $discount = $coupon->getAmount();
                } elseif ($couponType === 'percentage') {
                    $discount = $finalPrice * ($coupon->getAmount() / 100);
                }
                $finalPrice -= $discount;
            }
        }
        return $finalPrice;
    }



    private function findTaxRate(RequestDto $dto): float|int {
        $countryCode = substr($dto->taxNumber, 0, 2);

        switch ($countryCode) {
            case 'DE':
                $countryTaxRate = $this->getRateRepository()->findOneBy(['countryName' => 'Germany']);
                break;
            case 'IT':
                $countryTaxRate = $this->getRateRepository()->findOneBy(['countryName' => 'Italy']);
                break;
            case 'GR':
                $countryTaxRate = $this->getRateRepository()->findOneBy(['countryName' => 'Greece']);
                break;
            case 'FR':
                $countryTaxRate = $this->getRateRepository()->findOneBy(['countryName' => 'France']);
                break;
            default:
                throw new \InvalidArgumentException('Invalid country code');
        }

        if (!$countryTaxRate) {
            throw new \InvalidArgumentException('Tax rate not found for the provided country');
        }

        return $countryTaxRate->getTaxRate() / 100;
    }

}