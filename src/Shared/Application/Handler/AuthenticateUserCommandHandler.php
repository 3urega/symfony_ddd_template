<?php

declare(strict_types=1);

namespace Eurega\Shared\Application\Handler;

use Eurega\Shared\Application\Command\Auth\AuthenticateUserCommand;
use Eurega\Shared\Application\Service\Auth\UserAuthenticator;
use Eurega\Shared\Domain\Bus\Command\CommandHandler;
use Eurega\Shared\Domain\ValueObject\Security\AuthPassword;
use Eurega\Shared\Domain\ValueObject\Security\AuthUsername;

final readonly class AuthenticateUserCommandHandler implements CommandHandler
{
	public function __construct(private UserAuthenticator $authenticator) {}

	public function handle(AuthenticateUserCommand $command): void {

		$username = new AuthUsername($command->username());
		$password = new AuthPassword($command->password());
	
		$this->authenticator->authenticate($username, $password);
	
	}
}
