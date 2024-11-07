<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Controller\Home;

use Eurega\Shared\Infrastructure\Symfony\WebController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Override;

final class HomeGetWebController extends WebController
{
	public function __invoke(Request $request): Response
	{
		return $this->render('@backoffice/pages/home.html.twig', [
			'title' => 'Welcome',
			'description' => 'Eurega - Backoffice',
		]);
	}

	#[Override]
	protected function exceptions(): array
	{
		return [];
	}
}
