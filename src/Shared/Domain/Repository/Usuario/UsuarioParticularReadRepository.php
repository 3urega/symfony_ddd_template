<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Repository\Usuario;

use Eurega\Shared\Domain\Exception\Usuario\UsuarioNotFoundException;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;

interface UsuarioParticularReadRepository extends UsuarioReadRepository {
    /**
     * @throws UsuarioNotFoundException 
     */
    public function ofDireccionEmailAndActivoOrFail(EmailAddress $email): UsuarioParticular;

    public function ofDireccionEmailAndFail(EmailAddress $emailAddress): void;

    public function ofIdOrFail(Id $id): UsuarioParticular;

}
