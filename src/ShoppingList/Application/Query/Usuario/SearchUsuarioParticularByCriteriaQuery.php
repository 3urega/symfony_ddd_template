<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Application\Query\Usuario;

use Eurega\Shared\Domain\Criteria\Criteria;

/**
 * Una Query siempre devolverá como respuesta una collection de Dto
 * @return ElementoDeListaUsuarioParticularCollection
 */
final readonly class SearchUsuarioParticularByCriteriaQuery
{
	public function __construct(
		public Criteria $criteria
	) {}
	
}
