<?php

declare(strict_types=1);

namespace Tests\Shared\Infrastructure\Repository;

use Eurega\Shared\Domain\Model\Usuario\UsuarioParticular;
use Eurega\Shared\Domain\ValueObject\Common\Id as CommonId;
use Eurega\Shared\Domain\ValueObject\Common\Id;


class MysqlUsuarioParticularWriteRepository implements \Eurega\Shared\Domain\Repository\Usuario\UsuarioParticularWriteRepository
{

    public function __construct(){}

    public function nextIdentity(): CommonId
    {
        return Id::generate();
    }

    public function save(UsuarioParticular $usuario): void { }
}
