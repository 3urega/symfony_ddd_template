<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Validation;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
final class EmailUsuarioAlreadyExistsConstraint extends Constraint
{
    public string $message = 'Ya existe un usuario con el correo electrónico indicado';

    public function validatedBy(): string
    {
        return EmailUsuarioAlreadyExistsValidator::class;
    }

    /**
     * @return string|string[]
     */
    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
