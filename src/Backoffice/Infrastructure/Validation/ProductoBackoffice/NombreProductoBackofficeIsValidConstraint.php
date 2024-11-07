<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Infrastructure\Validation\ProductoBackoffice;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
final class NombreProductoBackofficeIsValidConstraint extends Constraint
{
    public string $message = 'El nombre especificado para el producto no es válido.';

    public function validatedBy(): string
    {
        return NombreProductoBackofficeIsValidValidator::class;
    }

    /**
     * @return string|string[]
     */
    public function getTargets(): string|array {
        return self::CLASS_CONSTRAINT;
    }
}
