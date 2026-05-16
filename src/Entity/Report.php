<?php

namespace App\Entity;

class Report {
    
    private ?int $id_report;
    private ?bool $report_type;
    private ?string $location;
    private ?string $comment;
    private ?bool $is_deceased;
    private ?string $reported_at;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $finish_on;
    private ?bool $status;
    private ?int $pet_id;
    private ?int $account_id;

    public function __construct(
        ?bool $report_type = null,
        ?int $pet_id = null
    ) {
        $this->report_type = $report_type;
        $this->pet_id = $pet_id;
    }


    public function getId(): ?int {
        return $this->id_report;
    }

    public function setId(?int $id): self {
        $this->id_report = $id;
        return $this;
    }

    public function getType(): ?bool {
        return $this->report_type;
    }

    public function setType(?bool $type): self {
        $this->report_type = $type;
        return $this;
    }

    public function getLocation(): ?string {
        return $this->location;
    }

    public function setLocation(?string $location): self {
        $this->location = $location;
        return $this;
    }

    public function getComment(): ?string {
        return $this->comment;
    }

    public function setComment(?string $comment): self {
        $this->comment = $comment;
        return $this;
    }

    public function getIsDeceased(): ?bool {
        return $this->is_deceased;
    }

    public function setIsDeceased(?bool $isDeceased): self {
        $this->is_deceased = $isDeceased;
        return $this;
    }
    
    public function getReportedAt(): ?string {
        return $this->reported_at;
    }

    public function setReportedAt(?string $date): self {
        $this->reported_at = $date;
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

    public function getStatus(): ?bool {
        return $this->status;
    }

    public function setStatus(?bool $status): self {
        $this->status = $status;
        return $this;
    }

    public function getPet(): ?int {
        return $this->pet_id;
    }

    public function setPet(?int $id_pet): self {
        $this->pet_id = $id_pet;
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
