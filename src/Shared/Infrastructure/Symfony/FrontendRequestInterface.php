<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface FrontendRequestInterface
{
    public static function fromRequest(Request $request): FrontendRequestInterface;

    public function getAllAsArray(): array ;

    public function isValid(): bool;

    public function validateRequest(): void;

    public function setErrors(ConstraintViolationListInterface $errors): void;

    public function addError(string $propertyName, string $error): void;

    /**
     * Sets Csrf validation error
     */
    public function setCsrfTokenError(): void;

    public function error(string $propertyName): ?string;

    /**
     * @return string[]
     */
    public function validationGroups(): array;
}
