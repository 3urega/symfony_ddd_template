<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Flash;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Throwable;

final class FlashMessageGenerator
{
    private SessionInterface $session;

    private string $env;


    public function __construct(
        private RequestStack $requestStack,
        string $env = 'dev'
    ) {
        $this->session = $requestStack->getSession();
        $this->env     = $env;
    }

    public function add(
        string $type,
        string $message,
        ?Throwable $exception = null,
        ?bool $test = false
    ): void {
        if ($this->session instanceof FlashBagAwareSessionInterface) {
            
            $this->session->getFlashBag()->add(
                $type,
                $this->getFinalMessage($message, $exception, $test)
            );
         }
    }

    /**
     * Returns the correct message depending on the current environment. If test is true returns prod message.
     */
    private function getFinalMessage(string $message, ?Throwable $exception, bool $test): string
    {
        if (! $exception) {
            return $message;
        }

        if ($test) {
            return $message;
        }

        return $this->isDevEnv()
            ? $exception->getFile() . ': ' . $exception->getMessage()
            : $message;
    }

    private function isDevEnv(): bool
    {
        return $this->env === 'dev' || $this->env === 'test';
    }
}
