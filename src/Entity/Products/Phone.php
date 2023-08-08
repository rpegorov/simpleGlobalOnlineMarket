<?php

namespace App\Entity\Products;

use App\Entity\BaseProduct;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
#[ORM\Table(name: "phones")]
class Phone extends BaseProduct {
    use TimestampableTrait;
}