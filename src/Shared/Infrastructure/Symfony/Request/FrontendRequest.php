<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Request;

use Eurega\Shared\Infrastructure\Symfony\FrontendRequestInterface;

use Symfony\Component\Validator\ConstraintViolationListInterface;

use function count;
use function preg_replace;

abstract class FrontendRequest implements FrontendRequestInterface
{
    public array $errors = [];

    public function isValid(): bool
    {
        // Este método se definirá en cada una de las distintas implementaciones
        $this->validateRequest();

        return count($this->errors) === 0;
    }

    public function getAllErrors()
    {
        return $this->errors;
    }

    public function setErrors(ConstraintViolationListInterface $errors): void
    {
        // Remove array keys
        $re = '/(\[\d*\])/';

        foreach ($errors as $error) {
            $this->errors[preg_replace($re, '', $error->getPropertyPath())] = $error->getMessage();
        }
    }

    public function addError(string $propertyName, string $error): void
    {
        $this->errors[$propertyName] = $error;
    }

    /**
     * Sets csrf token error
     */
    public function setCsrfTokenError(): void
    {
        $this->errors['csrf_error'] = 'El token no és valido';
    }

    public function error(string $propertyName): ?string
    {
        return $this->errors[$propertyName] ?? null;
    }

    /**
     * @return string[]
     */
    public function validationGroups(): array
    {
        return [];
    }

    public abstract function validateRequest(): void;

    public abstract function getAllAsArray(): array ;
}
