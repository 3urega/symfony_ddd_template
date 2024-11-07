<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Validation;

use Eurega\Shared\Domain\Bus\Command\CommandBusRead;
use Eurega\Shared\Domain\Exception\ValueObject\EmailAddressIsNotValid;
use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class EmailUsuarioAlreadyExistsValidator extends ConstraintValidator
{
    private CommandBusRead $commandBusRead;

    public function __construct(
        CommandBusRead $commandBusRead
    ) {
        $this->commandBusRead = $commandBusRead;
    }

    public function validate($formData, Constraint $constraint): void
    {
        if (! $formData->email) {
            return;
        }

        try {
            EmailAddress::fromString($formData->email);
        } catch (EmailAddressIsNotValid $e) {
            return;
        }
        /*
        $emailExists = $this->commandBusRead->handle(
            new EmailUsuarioExistsQuery($formData->email)
        );
       
        if (! $emailExists) {
            return;
        }
        */
        $this->context
            ->buildViolation($constraint->message)
            ->atPath('email')
            ->addViolation();
    }
}
