<?php

declare(strict_types = 1);

namespace App\Backoffice\Frontend\Controller;

use Eurega\Shared\Domain\RandomNumberGenerator;

use Symfony\Component\HttpFoundation\JsonResponse;

final class HealthCheckGetController {

    public function __construct(
        private RandomNumberGenerator $random
    ) { }

    public function __invoke() {

        return new JsonResponse(
            [
                "shl-backend" => "ok",
                "rand" => $this->random->generate()
            ]
        );
    }
}