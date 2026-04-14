<?php

namespace App\Entity;

class Type {
    
    private int $id_type;
    private string $pet_type;

    public function __construct(
        string $pet_type
    ) {
        $this->pet_type = $pet_type;
    }

    
    public function getId(): int {
        return $this->id_type;
    }

    public function setId(int $id): self {
        $this->id_type = $id;
        return $this;
    }

    public function getType(): string {
        return $this->pet_type;
    }

    public function setType(string $type): self {
        $this->pet_type = $type;
        return $this;
    }
}