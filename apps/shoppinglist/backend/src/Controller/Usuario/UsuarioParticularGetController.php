<?php

namespace App\ShoppingList\Backend\Controller\Usuario;

use Eurega\Shared\Domain\Bus\Command\CommandBusRead;
use Eurega\Shared\Domain\Criteria\Criteria;
use Eurega\ShoppingList\Application\Query\Usuario\SearchUsuarioParticularByCriteriaQuery;
use Eurega\ShoppingList\Domain\Dto\Usuario\ElementoDeListaUsuarioParticularCollection;
use Eurega\ShoppingList\Domain\Dto\Usuario\ElementoDeListaUsuarioParticularResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class UsuarioParticularGetController {

    public function __construct(
        private CommandBusRead $readBus
    ) { }

    public function __invoke(
        Request $request
    ) {
        
        /** @var ElementoDeListaUsuarioParticularCollection $collection */
        $collection = $this->readBus->handle(
            new SearchUsuarioParticularByCriteriaQuery(
                Criteria::allWithPagination()
            )
        );
        
        return new JsonResponse(
            [
                'start' => 1,
                'recordsTotal'  => 2,
                'recordsFiltered' => 2,
                'data'  => array_map(
                    [$this, 'formatData'],
                    iterator_to_array($collection)
                )
            ],
            Response::HTTP_CREATED
        );
    }

    /** 
     * Formateamos la colección de elementos del tipo ElementoDeListaUsuarioParticularResponse 
     * al formato concreto que queremos usar para la response de este endpoint concreto 
     */
    protected function formatData(ElementoDeListaUsuarioParticularResponse $elemento): array
    {
        return [
            'id' => $elemento->id->asString(),
            'nombre' => $elemento->nombre?->asString(),
            'direccionEmail' => $elemento->email->asString()
        ];
    }
}