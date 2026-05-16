<?php

namespace App\Entity;

class Pet {
    
    private ?int $id_pet;
    private ?string $pet_name;
    private ?int $pet_age;
    private ?bool $pet_sex;
    private ?string $pet_breed;
    private ?string $pet_coat;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $finish_on;
    private ?int $type_id;
    private ?int $account_id;

    public function __construct(
        ?int $type_id = null
    ) {
        $this->type_id = $type_id;
    }


    public function getId(): ?int {
        return $this->id_pet;
    }

    public function setId(?int $id): self {
        $this->id_pet = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->pet_name;
    }

    public function setName(?string $name): self {
        $this->pet_name = $name;
        return $this;
    }

    public function getAge(): ?int {
        return $this->pet_age;
    }

    public function setAge(?int $age): self {
        $this->pet_age = $age;
        return $this;
    }

    public function getSex(): ?bool {
        return $this->pet_sex;
    }

    public function setSex(?bool $sex): self {
        $this->pet_sex = $sex;
        return $this;
    }

    public function getBreed(): ?string {
        return $this->pet_breed;
    }

    public function setBreed(?string $breed): self {
        $this->pet_breed = $breed;
        return $this;
    }

    public function getCoat(): ?string {
        return $this->pet_coat;
    }

    public function setCoat(?string $coat): self {
        $this->pet_coat = $coat;
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

    public function getFinishOn(): ?string {
        return $this->finish_on;
    }

    public function setFinishOn(?string $date): self {
        $this->finish_on = $date;
        return $this;
    }

    public function getType(): ?int {
        return $this->type_id;
    }

    public function setType(?int $id_type): self {
        $this->type_id = $id_type;
        return $this;
    }

    public function getAccount(): ?int {
        return $this->account_id;
    }

    public function setAccount(?int $id_account): self {
        $this->account_id = $id_account;
        return $this;
    }
    
}
