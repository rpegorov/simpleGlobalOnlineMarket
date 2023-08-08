<?php

namespace App\Entity\Coupons;

use App\Entity\PersistentEntity;
use App\Repository\CouponsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsRepository::class)]
class Coupons extends PersistentEntity {
    #[ORM\Column(length: 255)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $type;

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    #[ORM\Column]
    private float $amount;

    public function getAmount(): float {
        return $this->amount;
    }

    public function setAmount(float $amount): void {
        $this->amount = $amount;
    }


    public function getCode(): string {
        return $this->code;
    }

    public function setCode(string $code): static {
        $this->code = $code;

        return $this;
    }
}
