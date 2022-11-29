<?php

declare(strict_types=1);

namespace Atenea\Posts\Application\SearchByCriteria;

final class SearchPostsByCriteriaQuery
{
    private function __construct(
        private readonly array $filters,
        private readonly ?string $orderBy,
        private readonly ?string $order,
        private readonly ?int $limit,
        private readonly ?int $offset
    ) {
    }

    public static function create(
        array $filters,
        ?string $orderBy,
        ?string $order,
        ?int $limit,
        ?int $offset
    ): self {
        return new self(
            $filters,
            $orderBy,
            $order,
            $limit,
            $offset
        );
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
    {
        return $this->order;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }

    public function offset(): ?int
    {
        return $this->offset;
    }
}
