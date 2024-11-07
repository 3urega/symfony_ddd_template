<?php

declare(strict_types=1);

namespace Eurega\ShoppingList\Infrastructure\Command\Usuario;

use Eurega\Shared\Domain\Bus\Command\CommandBusWrite;
use Eurega\ShoppingList\Application\Command\Usuario\CrearUsuarioParticularCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user.',
    hidden: false,
    aliases: ['app:add-user']
)]
class AppCommand extends Command
{

    public function __construct(
		private KernelInterface $appKernel,
        private CommandBusWrite $commandBusWrite,
		private ParameterBagInterface $params
    ) {
        parent::__construct();
    }

	protected function configure(): void
    {
        $this
            ->setDescription('Creates a new user.')
            ->addArgument('email', InputArgument::REQUIRED, 'introduzca email')
            ->addArgument('password', InputArgument::REQUIRED, 'introduzca password')
			->addArgument('nombre', InputArgument::OPTIONAL, 'introduzca nombre');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
		$email = $input->getArgument('email');
        $password = $input->getArgument('password');
		$nombre = $input->getArgument('nombre');

		$this->commandBusWrite->handle(
			new CrearUsuarioParticularCommand(
				$email,
				$password,
				$nombre
			)
		);
        
        return Command::SUCCESS;
    }
}
