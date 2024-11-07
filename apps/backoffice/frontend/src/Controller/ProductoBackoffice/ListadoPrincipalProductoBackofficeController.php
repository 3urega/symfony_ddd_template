<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Controller\ProductoBackoffice;

use Eurega\Backoffice\Application\Query\ProductoBackoffice\SearchProductoBackofficeQuery;
use Eurega\Backoffice\Domain\Collection\ProductoBackoffice\ProductoBackofficeCollection;
use Eurega\Shared\Infrastructure\Symfony\WebController;
use Eurega\Shared\Domain\Model\Usuario\Usuario;
use Eurega\Shared\Infrastructure\Symfony\Security\Usuario\SfUsuario;
use Override;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

use function Lambdish\Phunctional\map;

class ListadoPrincipalProductoBackofficeController extends WebController
{

    public function __invoke(
        #[CurrentUser] ?SfUsuario $user, 
        Request $request
    ): Response {

        $parameters = json_decode($request->getContent(), true);

        $orderBy = $parameters['order_by']??null;
		$order = $parameters['order']??null;
		$limit = $parameters['limit']??0;
		$offset = $parameters['offset']??0;
        //$filters = $parameters['filters']??[];

        /**  @var ProductoBackofficeCollection $response */
        $response = $this->commandBus->handle(
            new SearchProductoBackofficeQuery(
                ["nombre" => "pruebas_5"],
				$orderBy,
				$order,
				$limit === null ? null : (int) $limit,
				$offset === null ? null : (int) $offset
            )
        );
        
        return $this->render(
            '@backoffice/ProductoBackoffice/listado-producto-backoffice.twig'
        );
    }

    #[Override]
	protected function exceptions(): array
	{
		return [];
	}
}
