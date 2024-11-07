<?php

declare(strict_types=1);

namespace Eurega\Shared\Infrastructure\Symfony;

use Eurega\Shared\Domain\Bus\Command\CommandBus;
use Eurega\Shared\Domain\Bus\Query\QueryBus;
use Eurega\Shared\Infrastructure\Message\esp\Messages;
use Eurega\Shared\Infrastructure\Message\esp\SuccessMessages;
use Eurega\Shared\Infrastructure\Symfony\Flash\FlashMessageGenerator;
use Eurega\Shared\Infrastructure\Symfony\Middleware\ApiExceptionsHttpStatusCodeMapping;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Twig\Environment;

abstract class WebController extends ApiController
{
	public function __construct(
		private readonly Environment $twig,
		private readonly RouterInterface $router,
		private readonly RequestStack $requestStack,
		private readonly FlashMessageGenerator $flash,
		protected QueryBus $queryBus,
		protected CommandBus $commandBus,
		protected ApiExceptionsHttpStatusCodeMapping $exceptionHandler
	) {
		parent::__construct($queryBus, $commandBus, $exceptionHandler);
	}

	final public function render(string $templatePath, array $arguments = []): SymfonyResponse
	{
		return new SymfonyResponse($this->twig->render($templatePath, $arguments));
	}

	final public function redirect(string $routeName): RedirectResponse
	{
		return new RedirectResponse($this->router->generate($routeName), 302);
	}

	final public function redirectWithMessage(string $routeName, string $message): RedirectResponse
	{
		$this->addFlashFor('message', [$message]);

		return $this->redirect($routeName);
	}

	final public function redirectWithErrors(
		ConstraintViolationListInterface $errors
	): void {
		$this->addFlashFor('request', $this->formatFlashErrors($errors));
	}

	protected function formatFlashErrors(ConstraintViolationListInterface $violations): array
	{
		$errors = [];
		foreach ($violations as $violation) {
			$errors[str_replace(['[', ']'], ['', ''], $violation->getPropertyPath())] = $violation->getMessage();
		}

		return $errors;
	}

	protected function addFlashFor(string $prefix, array $messages): void
	{
		foreach ($messages as $key => $message) {
			$this->flash->add($prefix, Messages::message($message));
		}
	}

	protected function addSingleSuccessFlashFor(string $message): void
	{
		$this->flash->add('success', SuccessMessages::message($message));	
	}

	
}
