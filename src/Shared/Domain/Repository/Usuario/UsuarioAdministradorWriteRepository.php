<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Repository\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\ValueObject\Common\Id;

interface UsuarioAdministradorWriteRepository 
{

    public function nextIdentity(): Id;

    public function save(UsuarioAdministradorModel $usuarioAdministrador): void;
}
