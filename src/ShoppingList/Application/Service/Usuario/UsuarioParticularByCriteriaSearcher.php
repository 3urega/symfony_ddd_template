<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Application\Service\Usuario;

use Eurega\Shared\Domain\Criteria\Criteria;

use Eurega\ShoppingList\Domain\Dto\Usuario\ElementoDeListaUsuarioParticularCollection;
use Eurega\ShoppingList\Domain\Dto\Usuario\ElementoDeListaUsuarioParticularResponse;
use Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;

use function Lambdish\Phunctional\map;

final readonly class UsuarioParticularByCriteriaSearcher
{
	public function __construct(
        private UsuarioParticularReadRepository $usuarioParticularReadRepository
    ) {}

	public function __invoke(Criteria $criteria): ElementoDeListaUsuarioParticularCollection 
    {
		/** @var ElementoDeListaUsuarioParticularCollection $lista */
        $lista = ElementoDeListaUsuarioParticularCollection::createEmpty();

		array_map(
            fn (UsuarioParticular $usuario) => 
                $lista->addElement(
                    new ElementoDeListaUsuarioParticularResponse(
                        $usuario->id(),
                        $usuario->nombre(),
                        $usuario->direccionEmail()
                    )
                )
            ,
            $this->usuarioParticularReadRepository->search($criteria)
        );
		return $lista;
	}
}
