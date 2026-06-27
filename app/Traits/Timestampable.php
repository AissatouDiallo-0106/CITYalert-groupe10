<?php
declare(strict_types=1);
namespace App\Traits;

/**
 * Ajoute la gestion des dates de création / mise à jour à une entité.
 */
trait Timestampable
{
    protected ?\DateTimeImmutable $createdAt = null;
    protected ?\DateTimeImmutable $updatedAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
    public function getUpdatedAt(): ?\DateTimeImmutable { return $this->updatedAt; }

    public function setCreatedAt(\DateTimeImmutable|string|null $v): void { $this->createdAt = $this->toDate($v); }
    public function setUpdatedAt(\DateTimeImmutable|string|null $v): void { $this->updatedAt = $this->toDate($v); }

    public function touch(): void { $this->updatedAt = new \DateTimeImmutable(); }

    private function toDate(\DateTimeImmutable|string|null $v): ?\DateTimeImmutable
    {
        if ($v === null || $v === '') return null;
        return $v instanceof \DateTimeImmutable ? $v : new \DateTimeImmutable($v);
    }
}