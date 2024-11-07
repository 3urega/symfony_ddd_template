<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function assert;
use function count;
use Generator;
use ReflectionClass;
use ReflectionException;

final class FrontendRequestResolver implements ArgumentResolverInterface
{
    private ValidatorInterface $validator;

    private CsrfTokenManagerInterface $tokenManager;

    public function __construct(
        ValidatorInterface $validator,
        CsrfTokenManagerInterface $tokenManager
    ) {
        $this->validator    = $validator;
        $this->tokenManager = $tokenManager;
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        try {
            $reflection = new ReflectionClass($argument->getType());
            if ($reflection->implementsInterface(FrontendRequest::class)) {
                return true;
            }
        } catch (ReflectionException $e) {
        }

        return false;
    }


    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $class = $argument->getType();
        $token = $request->request->get('csrf_token');

        $backendRequest = $class::fromRequest($request);
        assert($backendRequest instanceof FrontendRequest);

        if (! $this->isJsonRequest($request)
            && ! $this->tokenManager->isTokenValid(new CsrfToken($class, $token))
        ) {
            $backendRequest->setCsrfTokenError();
        }


        $errors = $this->validator->validate(
            $backendRequest,
            null,
            $backendRequest->validationGroups()
        );

        if (count($errors) > 0) {
            $backendRequest->setErrors($errors);
        }

        yield $backendRequest;
    }

    private function isJsonRequest(Request $request): bool
    {
        return $request->getContentTypeFormat() === 'json';
    }

    public function getArguments(
        Request $request, 
        callable $controller, 
        ?\ReflectionFunctionAbstract $reflector = null
    ): array {
        return [];
    }
}
