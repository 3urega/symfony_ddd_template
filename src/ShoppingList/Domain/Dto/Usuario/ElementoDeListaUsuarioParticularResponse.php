<?php

namespace Eurega\ShoppingList\Domain\Dto\Usuario;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;

/**
 * Estos dto que terminan con la palabra "response" se usan para devolver datos estructurados desde un repositorio a un controlador
 */
class ElementoDeListaUsuarioParticularResponse
{
    public function __construct(
        public Id $id,
        public ?Nombre $nombre,
        public EmailAddress $email,
    ) { }
}