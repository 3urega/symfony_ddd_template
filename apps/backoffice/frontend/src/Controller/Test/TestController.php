<?php

namespace App\Backoffice\Frontend\Controller\Test;

use App\Backoffice\Frontend\Command\Test\TestCommand;
use Eurega\Backoffice\Application\Exception\ApplicationException;
use Eurega\Backoffice\Domain\Exception\DomainException;
use Eurega\Shared\Infrastructure\Symfony\WebController;
use Symfony\Component\HttpFoundation\Response;

use Throwable;
use Override;

use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class TestController extends WebController {


	public function __invoke(): Response {
        
            try {

                $this->handle(
                    new TestCommand( )
                );
                
                
            } catch (DomainException|ApplicationException $e) {


            } 
        
            echo 'test ok'; die;

        return $this->render(
            '@backoffice/ProductoBackoffice/crear-producto-backoffice.twig',
            [
                'request' => []
            ] );
	}

    #[Override]
	protected function exceptions(): array
	{
		return [];
	}
    
}