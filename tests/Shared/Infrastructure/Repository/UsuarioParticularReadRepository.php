<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure\Repository;

use Eurega\Shared\Domain\Criteria\Criteria;
use Eurega\Shared\Domain\Criteria\OrderBy;
use Eurega\Shared\Domain\ValueObject\Repository\Limit;
use Eurega\Shared\Domain\Model\Usuario\Usuario;
use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;

class UsuarioParticularReadRepository implements \Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularReadRepository
{

    public function __construct(){}

    public function ofDireccionEmailAndFail(EmailAddress $emailAddress): void {}

    public function ofDireccionEmailAndActivoOrFail(EmailAddress $direccionEmail): UsuarioAdministradorModel
    {
    }

    public function ofIdOrFail(Id $id): UsuarioParticular { 
        return UsuarioParticular::crear(
            $id,
            EmailAddress::fromStringOrNull(),
            PasswordHash::generateRandom(),
            Nombre::fromStringOrNull("")
        );
    }

    public function ofIdOrNull(Id $id): Usuario|null {return null;}

    public function search(Criteria $criteria): array { return []; }
}
