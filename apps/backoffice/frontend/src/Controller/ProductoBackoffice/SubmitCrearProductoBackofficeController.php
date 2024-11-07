<?php

namespace App\Backoffice\Frontend\Controller\ProductoBackoffice;

use App\Backoffice\Frontend\Request\Producto\CrearProductoBackofficeRequest;
use Eurega\Backoffice\Application\Command\ProductoBackoffice\CreaProductoBackofficeCommand;
use Eurega\Backoffice\Application\Exception\ApplicationException;
use Eurega\Shared\Domain\Exception\DomainException;
use Eurega\Backoffice\Domain\SuccessCodes;
use Eurega\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Response;

use Throwable;
use Override;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class SubmitCrearProductoBackofficeController extends WebController {


	public function __invoke(
        #[MapRequestPayload()] CrearProductoBackofficeRequest $request
    ): Response {
        
        if ($request->isValid()) {
            try {

                $this->handle(
                    new CreaProductoBackofficeCommand(
                        $request->nombre,
                        $request->id
                    )
                );
                
                $this->addSingleSuccessFlashFor(SuccessCodes::$codes['PRODUCTO_BACKOFFICE']['CREATED'] );
                
            } catch (DomainException|ApplicationException $e) {
                // El canal de error deberia ser 'error' en lugar de 'danger'
                $this->addFlashFor('danger',[$e->getMessage()]);

            } catch (Throwable $exception) {
                throw $exception;
                $this->addFlashFor('danger',['Ha ocurrido un error del sistema, contacte con el webmaster.']);
            }

        } 

        return $this->render(
            '@backoffice/ProductoBackoffice/crear-producto-backoffice.twig',
            [
                'request' => $request
            ] );
	}

    #[Override]
	protected function exceptions(): array
	{
		return [];
	}
    
}