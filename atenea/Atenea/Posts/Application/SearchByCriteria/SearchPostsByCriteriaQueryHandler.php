<?php

declare(strict_types=1);

namespace Atenea\Posts\Application\SearchByCriteria;

use Atenea\Posts\Domain\PostRepository;
use Atenea\Shared\Domain\Criteria\Criteria;
use Atenea\Shared\Domain\Criteria\Filters;
use Atenea\Shared\Domain\Criteria\Order;

final class SearchPostsByCriteriaQueryHandler
{
    public function __construct(private readonly PostRepository $repository)
    {
    }

    public function __invoke(SearchPostsByCriteriaQuery $query): array
    {
        $filters = Filters::fromValues($query->filters());
        $order = Order::fromValues($query->orderBy(), $query->order());
        $limit = $query->limit();
        $offset = $query->offset();

        $criteria = new Criteria(
            $filters,
            $order,
            $offset,
            $limit
        );

        return $this->repository->matching($criteria);
    }
}
