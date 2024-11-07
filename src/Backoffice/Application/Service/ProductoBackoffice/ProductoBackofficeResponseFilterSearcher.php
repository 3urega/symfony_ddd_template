<?php

namespace Eurega\Backoffice\Application\Service\ProductoBackoffice;

use Eurega\Backoffice\Domain\Dto\ProductoBackoffice\ProductoBackofficeResponse;
use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeReadRepository;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\ValueObject\Repository\OrderBy;

use function Lambdish\Phunctional\map;

final class ProductoBackofficeResponseFilterSearcher {

    public function __construct(
        private ProductoBackofficeReadRepository $repository)
    { }
    
    /**
     * @return Array ProductoBackofficeResponse
     */
    public function __invoke(
        ?Limit $limit,
        ?OrderBy $orderBy,
        array $filters
    ): array {

        
    $elements = map(
                $this->toResponse(), 
                $this->repository->searchFiltered(
                    $limit,
                    $orderBy,
                    $filters
                )
            );
    
    return $elements;
    }

    private function toResponse(): callable
    {
        return static function (ProductoBackoffice $producto) {
            return new ProductoBackofficeResponse(
                $producto->id(), 
                $producto->nombre()
            );
        };
    }
}