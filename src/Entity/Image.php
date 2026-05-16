<?php

namespace App\Entity;

class Image {
    
    private ?int $id_image;
    private ?string $stored_name;
    private ?int $width;
    private ?int $height;
    private ?int $file_size;
    private ?string $created_at;
    private ?string $updated_at;
    private ?int $pet_id;

    public function __construct(
        ?string $stored_name,
        ?int $width,
        ?int $height,
        ?int $file_size,
        ?int $pet_id
    ) {
        $this->stored_name = $stored_name;
        $this->width = $width;
        $this->height = $height;
        $this->file_size = $file_size;
        $this->pet_id = $pet_id;
    }


    public function getId(): ?int {
        return $this->id_image;
    }

    public function setId(?int $id): self {
        $this->id_image = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->stored_name;
    }

    public function setName(?string $name): self {
        $this->stored_name = $name;
        return $this;
    }

    public function getWidth(): ?int {
        return $this->width;
    }

    public function setWidth(?int $width): self {
        $this->width = $width;
        return $this;
    }

    public function getHeight(): ?int {
        return $this->height;
    }

    public function setHeight(?int $height): self {
        $this->height = $height;
        return $this;
    }

    public function getSize(): ?int {
        return $this->file_size;
    }

    public function setSize(?int $size): self {
        $this->file_size = $size;
        return $this;
    }

    public function getCreatedAt(): ?string {
        return $this->created_at;
    }

    public function setCreatedAt(?string $date): self {
        $this->created_at = $date;
        return $this;
    }

    public function getUpdatedAt(): ?string {
        return $this->updated_at;
    }

    public function setUpdatedAt(?string $date): self {
        $this->updated_at = $date;
        return $this;
    }

    public function getPet(): ?int {
        return $this->pet_id;
    }

    public function setPet(?int $id_pet): self {
        $this->pet_id = $id_pet;
        return $this;
    }
    
}
