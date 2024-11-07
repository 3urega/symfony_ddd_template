<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Infrastructure\Factory\Usuario;

use Eurega\Shared\Domain\Model\Usuario\UsuarioAdministradorModel;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method        Post|Proxy create(array|callable $attributes = [])
 * @method static Post|Proxy createOne(array $attributes = [])
 * @method static Post|Proxy find(object|array|mixed $criteria)
 * @method static Post|Proxy findOrCreate(array $attributes)
 * @method static Post|Proxy first(string $sortedField = 'id')
 * @method static Post|Proxy last(string $sortedField = 'id')
 * @method static Post|Proxy random(array $attributes = [])
 * @method static Post|Proxy randomOrCreate(array $attributes = []))
 * @method static PostRepository|RepositoryProxy repository()
 * @method static Post[]|Proxy[] all()
 * @method static Post[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Post[]&Proxy[] createSequence(iterable|callable $sequence)
 * @method static Post[]|Proxy[] findBy(array $attributes)
 * @method static Post[]|Proxy[] randomRange(int $min, int $max, array $attributes = []))
 * @method static Post[]|Proxy[] randomSet(int $number, array $attributes = []))
 *
 * @phpstan-method Proxy<Post>&Post create(array|callable $attributes = [])
 * @phpstan-method static Proxy<Post>&Post createOne(array $attributes = [])
 * @phpstan-method static Proxy<Post>&Post find(object|array|mixed $criteria)
 * @phpstan-method static Proxy<Post>&Post findOrCreate(array $attributes)
 * @phpstan-method static Proxy<Post>&Post first(string $sortedField = 'id')
 * @phpstan-method static Proxy<Post>&Post last(string $sortedField = 'id')
 * @phpstan-method static Proxy<Post>&Post random(array $attributes = [])
 * @phpstan-method static Proxy<Post>&Post randomOrCreate(array $attributes = [])
 * @phpstan-method static list<Proxy<Post>&Post> all()
 * @phpstan-method static list<Proxy<Post>&Post> createMany(int $number, array|callable $attributes = [])
 * @phpstan-method static list<Proxy<Post>&Post> createSequence(array|callable $sequence)
 * @phpstan-method static list<Proxy<Post>&Post> findBy(array $attributes)
 * @phpstan-method static list<Proxy<Post>&Post> randomRange(int $min, int $max, array $attributes = [])
 * @phpstan-method static list<Proxy<Post>&Post> randomSet(int $number, array $attributes = [])
 * @phpstan-method static RepositoryProxy<Post>&Post repository()
 */
final class UsuarioAdministradorFactory extends PersistentProxyObjectFactory
{
    protected function defaults(): array
    {
        return [
            'id' => Id::generate(),
            'nombre' => Nombre::fromString(self::faker()->name()),
            'direccionEmail' => EmailAddress::fromString(self::faker()->email),
            'password' => PasswordHash::fromString('12345'),
        ];
    }

    protected function initialize(): static
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this->afterInstantiate(function(UsuarioAdministradorModel $usuarioAdministrador) {});
    }

    public static function class(): string
    {
        return UsuarioAdministradorModel::class;
    }
}
