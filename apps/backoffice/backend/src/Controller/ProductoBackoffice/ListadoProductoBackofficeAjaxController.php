<?php

declare(strict_types=1);

namespace App\Backoffice\Backend\Controller\ProductoBackoffice;

use DateTime;
use Eurega\Backoffice\Application\Query\ProductoBackoffice\CountProductoBackofficeFilteredQuery;
use Eurega\Backoffice\Application\Query\ProductoBackoffice\SearchProductoBackofficeQuery;
use Eurega\Backoffice\Domain\Dto\ProductoBackoffice\ProductoBackofficeResponse;
use Eurega\Shared\Domain\Bus\Command\CommandBusRead;
use Eurega\Shared\Infrastructure\Service\DataTableService;
use Eurega\Shared\Infrastructure\ValueObject\Common\Cantidad;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

use function array_map;
use function iterator_to_array;

class ListadoProductoBackofficeAjaxController
{

    public function __construct(
        private CommandBusRead $commandBusRead,
        private DataTableService $dataTableService,
        private Security $security
    ) { }

    public function __invoke(): JsonResponse
    {

        /**  @var ProductoBackofficeCollection $response */
        $response = $this->commandBusRead->handle(
            new SearchProductoBackofficeQuery(
                $this->dataTableService->filters(),
				$this->dataTableService->orderBy(),
				$this->dataTableService->limit()
            )
        );
        /** @var Cantidad $filtered */
        $filtered = $this->commandBusRead->handle(
            new CountProductoBackofficeFilteredQuery(
                $this->dataTableService->filters()
            )
        );

        /** @var Cantidad $total */
        $total = $this->commandBusRead->handle(
            new CountProductoBackofficeFilteredQuery()
        );


        $webResponse = new JsonResponse(
            [
                'start' => $this->dataTableService->limit()->offset(),
                'recordsTotal'  => $total->asInt(),
                'recordsFiltered' => $filtered->asInt(),
                'data'  => array_map(
                    [$this, 'formatData'],
                    iterator_to_array($response->getIterator())
                ),
                200,
                ['Access-Control-Allow-Origin' => '*']
            ]
        );

        $hash = md5((string)$filtered);

        $webResponse->setEtag($hash);
        // $response->setExpires((new DateTime())->modify('+15 days'));

        return $webResponse;
    }

    /**
     * @return string[]
     */
    protected function formatData(ProductoBackofficeResponse $producto): array
    {
        return [
            'id' => $producto->id()->asString(),
            'nombre' => $producto->nombre()->asString()
        ];
    }
}
