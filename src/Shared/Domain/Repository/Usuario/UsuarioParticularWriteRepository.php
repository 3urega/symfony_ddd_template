<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Repository\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\Id;

interface UsuarioParticularWriteRepository 
{
    public function nextIdentity(): Id;

    public function save(UsuarioParticular $usuario): void;
}
