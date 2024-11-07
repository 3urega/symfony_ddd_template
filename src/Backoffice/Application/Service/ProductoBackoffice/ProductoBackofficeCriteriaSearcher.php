<?php

namespace Eurega\Backoffice\Application\Service\ProductoBackoffice;

use Eurega\Backoffice\Domain\Collection\ProductoBackoffice\ProductoBackofficeCollection;
use Eurega\Backoffice\Domain\Dto\ProductoBackoffice\ProductoBackofficeResponse;
use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;
use Eurega\Backoffice\Domain\Repository\ProductoBackoffice\ProductoBackofficeReadRepository;
use Eurega\Shared\Domain\Criteria\Criteria;

use function Lambdish\Phunctional\map;

final class ProductoBackofficeCriteriaSearcher {

    public function __construct(
        private ProductoBackofficeReadRepository $repository)
    { }

    public function __invoke(
        Criteria $criteria
    ): ProductoBackofficeCollection {

        
    $elements = map(
                $this->toResponse(), 
                $this->repository->searchByCriteria(
                    $criteria, 
                    ProductoBackoffice::class, 
                    ['id' => 'id', 'nombre' => 'nombre']
                )
            );

    $response = ProductoBackofficeCollection::fromElements($elements);
    
    return $response;
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