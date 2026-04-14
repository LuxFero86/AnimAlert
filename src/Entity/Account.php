<?php

namespace App\Entity;

class Account {
    
    private ?int $id_account;
    private ?string $user_name;
    private ?string $user_email;
    private ?string $user_pwd;
    private ?string $created_at;
    private ?string $updated_at;
    private ?bool $status;
    private ?int $role_id;

    public function __construct(
        ?string $user_email = null,
        ?string $user_pwd = null
    ) {
        $this->user_email = $user_email;
        $this->user_pwd = $user_pwd;
    }


    public function getId(): ?int {
        return $this->id_account;
    }

    public function setId(?int $id): self {
        $this->id_account = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->user_name;
    }

    public function setName(?string $name): self {
        $this->user_name = $name;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->user_email;
    }

    public function setEmail(?string $email): self {
        $this->user_email = $email;
        return $this;
    }

    public function getPassword(): ?string {
        return $this->user_pwd;
    }

    public function setPassword(?string $password): self {
        $this->user_pwd = $password;
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

    public function getStatus(): ?bool {
        return $this->status;
    }

    public function setStatus(?bool $status): self {
        $this->status = $status;
        return $this;
    }

    public function getRole(): ?int {
        return $this->role_id;
    }

    public function setRole(?int $role): self {
        $this->role_id = $role;
        return $this;
    }
    

    /**
     * Méthode pour hasher le password en Bcript
     * @return void
     */
    public function hashPassword(): void {
        $this->user_pwd = password_hash($this->user_pwd, PASSWORD_DEFAULT);
    }

    /**
     * Méthode pour vérifier le hash du password
     * @param string $plainPassword mot de passe en clair
     * @return bool true si valide false si invalide
     */
    public function verifyPassword(string $plainPassword): bool {
        return password_verify($plainPassword, $this->user_pwd);
    }
}