<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Infrastructure\Fixtures\Usuario;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\ShoppingList\Infrastructure\Factory\Usuario\UsuarioAdministradorFactory;
use Eurega\ShoppingList\Infrastructure\Factory\Usuario\UsuarioParticularFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class UsuarioFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        UsuarioAdministradorFactory::createMany(1);
        UsuarioParticularFactory::createOne([
            'direccionEmail' => EmailAddress::fromString('superadmin@test.com'),
        ]);
        UsuarioAdministradorFactory::createOne([
            'direccionEmail' => EmailAddress::fromString('admin@test.com'),
        ]);
    }

    public static function getGroups(): array {
        return ['usuarios'];
    }
}
