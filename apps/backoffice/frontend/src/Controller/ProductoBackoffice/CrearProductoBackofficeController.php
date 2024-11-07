<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Controller\ProductoBackoffice;

use App\Backoffice\Frontend\Request\Producto\CrearProductoBackofficeRequest;

use Eurega\Shared\Infrastructure\Symfony\WebController;

use Symfony\Component\HttpFoundation\Response;

use Override;

final class CrearProductoBackofficeController extends WebController {
	

	public function __invoke(): Response
	{
		return $this->render(
                '@backoffice/ProductoBackoffice/crear-producto-backoffice.twig',
                [
                    'request' => CrearProductoBackofficeRequest::createEmpty()
                ]
        );
	}

	#[Override]
	protected function exceptions(): array
	{
		return [];
	}
}