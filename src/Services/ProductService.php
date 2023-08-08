<?php

namespace App\Services;

use App\Controller\Dto\RequestDto;
use App\Repository\AccessoriesRepository;
use App\Repository\HeadphoneRepository;
use App\Repository\PhoneRepository;
use App\Repository\ProductDao;
use PaypalPaymentProcessor;
use StripePaymentProcessor;

class ProductService {
    private ProductDao $productDao;
    private StripePaymentProcessor $stripePaymentProcessor;
    private PaypalPaymentProcessor $paypalPaymentProcessor;

    /**
     * @param StripePaymentProcessor $stripePaymentProcessor
     * @param PaypalPaymentProcessor $paypalPaymentProcessor
     */
    public function __construct(StripePaymentProcessor $stripePaymentProcessor,
                                PaypalPaymentProcessor $paypalPaymentProcessor) {
        $this->stripePaymentProcessor = $stripePaymentProcessor;
        $this->paypalPaymentProcessor = $paypalPaymentProcessor;
    }

    public function getProductDao(): ProductDao {
        return $this->productDao;
    }



    public function buyProduct(RequestDto $dto, $calculatedPrice) {
        $productRepository = $this->productDao->findProductRepos($dto);
        try {
            if ($dto->paymentProcessor === 'stripe') {
                $paymentSuccess = $this->stripePaymentProcessor->processPayment($calculatedPrice);
            } elseif ($dto->paymentProcessor === 'paypal') {
                $this->paypalPaymentProcessor->pay($calculatedPrice);
                $paymentSuccess = true;
            } else {
                throw new \InvalidArgumentException('Invalid payment processor');
            }

            if (!$paymentSuccess) {
                throw new \Exception('Payment processing failed');
            }
            $product = $productRepository->findOneBy(['uuid' => $dto->productUuid]);
            $productName = $product->getName();

            return [
                'productName' => $productName,
                'productUuid' => $product->getUuid()
            ];
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}