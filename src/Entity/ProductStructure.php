<?php

namespace App\Entity;

use App\Entity\Traits\TimestampableTrait;
use App\Repository\ProductStructureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductStructureRepository::class)]
class ProductStructure extends PersistentEntity {
    use TimestampableTrait;

    #[ORM\Column(nullable: true)]
    private int $lvl;

    #[ORM\Column(length: 255, nullable: true)]
    private string $category;


    public function getLvl(): ?int {
        return $this->lvl;
    }

    public function setLvl(int $lvl): static {
        $this->lvl = $lvl;

        return $this;
    }

    public function category(): string {
        return $this->category;
    }

    public function setCategory(string $category): static {
        $this->category = $category;

        return $this;
    }
}
