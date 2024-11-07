<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Application\Handler\Usuario;

use Eurega\ShoppingList\Application\Query\Usuario\SearchUsuarioParticularByCriteriaQuery;
use Eurega\ShoppingList\Application\Service\Usuario\UsuarioParticularByCriteriaSearcher;
use Eurega\ShoppingList\Domain\Dto\Usuario\ElementoDeListaUsuarioParticularCollection;

class SearchUsuarioParticularByCriteriaQueryHandler
{
	public function __construct(
        private UsuarioParticularByCriteriaSearcher $searcher
    ) {}

	public function handle(
        SearchUsuarioParticularByCriteriaQuery $query
    ): ElementoDeListaUsuarioParticularCollection 
    {

		return $this->searcher->__invoke($query->criteria);
	}
}
