<?php

namespace App\Repository;

use App\Controller\Dto\RequestDto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class ProductDao extends ServiceEntityRepository {
    private PhoneRepository $phoneRepository;
    private HeadphoneRepository $headphoneRepository;
    private AccessoriesRepository $accessoriesRepository;
    private ProductStructureRepository $productStructureRepository;

    /**
     * @param PhoneRepository $phoneRepository
     * @param HeadphoneRepository $headphoneRepository
     * @param AccessoriesRepository $accessoriesRepository
     * @param ProductStructureRepository $productStructureRepository
     */
    public function __construct(PhoneRepository $phoneRepository,
                                HeadphoneRepository $headphoneRepository,
                                AccessoriesRepository $accessoriesRepository,
                                ProductStructureRepository $productStructureRepository) {
        $this->phoneRepository = $phoneRepository;
        $this->headphoneRepository = $headphoneRepository;
        $this->accessoriesRepository = $accessoriesRepository;
        $this->productStructureRepository = $productStructureRepository;
    }


    public function findProductRepos(RequestDto $dto): AccessoriesRepository|HeadphoneRepository|PhoneRepository {
        $productStructure = $this->productStructureRepository->findOneBy(['lvl' => $dto->product]);
        if (!$productStructure) {
            throw new \InvalidArgumentException('Product structure not found');
        }
        $productCategory = $productStructure->category();

        $productRepository = null;
        switch ($productCategory) {
            case 'phone':
                $productRepository = $this->phoneRepository;
                break;
            case 'headphone':
                $productRepository = $this->headphoneRepository;
                break;
            case 'accessories':
                $productRepository = $this->accessoriesRepository;
                break;
            default:
                throw new \InvalidArgumentException('Invalid product category');
        }
        return $productRepository;
    }


}