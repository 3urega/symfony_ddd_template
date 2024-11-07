<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Repository\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;

interface UsuarioAdministradorReadRepository {

    public function ofDireccionEmailAndActivoOrFail(EmailAddress $email): UsuarioAdministradorModel;
    
    public function ofIdOrFail(Id $id): UsuarioAdministradorModel;

    public function ofIdOrNull(Id $id): UsuarioAdministradorModel;

    public function ofDireccionEmailAndFail(EmailAddress $emailAddress): void;

    // public function search(Id $id): ?UsuarioAdministradorModel;

	// public function searchByCriteria(Criteria $criteria): Collection;
    
}
