<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Infrastructure\Validation\ProductoBackoffice;


use Eurega\Shared\Domain\Bus\Command\CommandBusRead;
use Eurega\Shared\Domain\Exception\ValueObject\NombreIsNotValid;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class NombreProductoBackofficeIsValidValidator extends ConstraintValidator
{
    private CommandBusRead $commandBusRead;

    public function __construct(
        CommandBusRead $commandBusRead
    ) {
        $this->commandBusRead = $commandBusRead;
    }

    public function validate($formData, Constraint $constraint): void {

        try {
            Nombre::fromString($formData->nombre);
        } catch (NombreIsNotValid $e) {

            $this->context
                ->buildViolation($constraint->message)
                ->atPath('nombre')
                ->addViolation();
        }
    }
}
