<?php

namespace App\Entity\Products;

use App\Entity\BaseProduct;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\HeadphoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeadphoneRepository::class)]
#[ORM\Table(name: "headphones")]
class Headphone extends BaseProduct {
    use TimestampableTrait;
}
