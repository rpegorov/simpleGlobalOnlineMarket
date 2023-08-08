<?php

namespace App\Entity\Products;

use App\Entity\BaseProduct;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\AccessoriesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccessoriesRepository::class)]
#[ORM\Table(name: "accessories")]
class Accessories extends BaseProduct {
    use TimestampableTrait;
}
