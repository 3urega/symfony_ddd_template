<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\ValueObject\Usuario;

use Eurega\Shared\Domain\Exception\ValueObject\Usuario\EstadoIsNotValid;
use InvalidArgumentException;
use Webmozart\Assert\Assert;

use function mb_strtolower;
use function trim;

final class EstadoUsuario
{   
    // Estado normal de los usuarios
    public const ACTIVO    = 'activo';
    // Este es el estado de un usuario cuyo email aún no ha sido confirmado
    public const INACTIVO    = 'inactivo';
    public const BLOQUEADO = 'bloqueado';
    public const ELIMINADO = 'eliminado';

    public const VALID_VALUES = [
        self::ACTIVO,
        self::INACTIVO,
        self::BLOQUEADO,
        self::ELIMINADO,
    ];

    private const DESCRIPTION_MAP = [
        self::ACTIVO => 'Activo',
        self::INACTIVO => 'Inactivo',
        self::BLOQUEADO => 'Bloqueado',
        self::ELIMINADO => 'Eliminado',
    ];

    private string $code;

    private function __construct(string $code)
    {
        $this->code = $code;
    }

    /**
     * @throws EstadoIsNotValid
     */
    public static function fromString(string $code): self
    {
        $code = mb_strtolower(
            trim($code)
        );

        try {
            Assert::inArray($code, self::VALID_VALUES);
        } catch (InvalidArgumentException $e) {
            throw EstadoIsNotValid::becauseCodeIsNotValid($code);
        }

        return new self($code);
    }

    /**
     * @throws EstadoIsNotValid
     */
    public static function fromStringOrNull(?string $code): ?EstadoUsuario
    {
        if ($code === null) {
            return null;
        }

        return self::fromString($code);
    }

    public static function activo(): self
    {
        return new self(self::ACTIVO);
    }

    public static function inactivo(): self
    {
        return new self(self::INACTIVO);
    }

    public static function bloqueado(): self
    {
        return new self(self::BLOQUEADO);
    }

    public static function eliminado(): self
    {
        return new self(self::ELIMINADO);
    }

    public function equalsTo(EstadoUsuario $anotherEstado): bool
    {
        return $this->code === $anotherEstado->code;
    }

    public function asString(): string
    {
        return $this->code;
    }

    public function description(): string
    {
        return self::DESCRIPTION_MAP[$this->code];
    }
}
