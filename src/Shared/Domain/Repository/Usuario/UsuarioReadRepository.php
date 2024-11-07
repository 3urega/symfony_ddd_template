<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Repository\Usuario;

use Eurega\Shared\Domain\Collection;
use Eurega\Shared\Domain\Criteria\Criteria;
use Eurega\Shared\Domain\Model\Usuario\Usuario;
use Eurega\Shared\Domain\ValueObject\Common\Id;

interface UsuarioReadRepository {

    public function ofIdOrFail(Id $id): Usuario;

    public function ofIdOrNull(Id $id): Usuario|null;

    public function search(Criteria $criteria): array;
}