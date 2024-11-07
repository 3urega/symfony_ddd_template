<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony\Middleware;
use Eurega\Shared\Application\Command\Auth\AuthenticateUserCommand;
use Eurega\Backoffice\Domain\Exception\Auth\InvalidAuthCredentials;
use Eurega\Shared\Domain\Auth\InvalidAuthUsername;
use Eurega\Shared\Domain\Bus\Command\CommandBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final readonly class BasicHttpAuthMiddleware
{
	public function __construct(private CommandBus $bus) {}

	public function onKernelRequest(RequestEvent $event): void
	{
		$shouldAuthenticate = $event->getRequest()->attributes->get('auth', false);

		if ($shouldAuthenticate) {
			$user = $event->getRequest()->headers->get('php-auth-user');
			$pass = $event->getRequest()->headers->get('php-auth-pw');

			$this->hasIntroducedCredentials($user)
				? $this->authenticate($user, $pass, $event)
				: $this->askForCredentials($event);
		} else {
			
		}
	}

	private function hasIntroducedCredentials(?string $user): bool
	{
		return $user !== null;
	}

	private function authenticate(string $user, string $pass, RequestEvent $event): void
	{
		try {
			$this->bus->handle(new AuthenticateUserCommand($user, $pass));
			$this->addUserDataToRequest($user, $event);
		} catch (InvalidAuthCredentials|InvalidAuthUsername) {
			$event->setResponse(new JsonResponse(['error' => 'Invalidate credentials ... '], Response::HTTP_FORBIDDEN));
		}
	}

	private function addUserDataToRequest(string $user, RequestEvent $event): void
	{
		$event->getRequest()->attributes->set('authenticated_username', $user);
	}

	private function askForCredentials(RequestEvent $event): void
	{
		$event->setResponse(
			new Response('', Response::HTTP_UNAUTHORIZED, [
				'WWW-Authenticate' => 'Basic realm="Eurega"',
			])
		);
	}
}
