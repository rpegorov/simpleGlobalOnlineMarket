<?php

namespace App\Entity\TaxRate;

use App\Entity\PersistentEntity;
use App\Entity\Traits\TimestampableTrait;
use App\Repository\TaxRateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaxRateRepository::class)]
class TaxRate extends PersistentEntity {
    use TimestampableTrait;

    #[ORM\Column(length: 255)]
    private string $countryName;

    #[ORM\Column]
    private int $taxRate;

    public function getCountryName(): string {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): static {
        $this->countryName = $countryName;

        return $this;
    }

    public function getTaxRate(): int {
        return $this->taxRate;
    }

    public function setTaxRate(int $taxRate): static {
        $this->taxRate = $taxRate;

        return $this;
    }
}
