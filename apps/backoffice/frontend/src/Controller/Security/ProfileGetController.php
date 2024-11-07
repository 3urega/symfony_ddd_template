<?php

namespace App\Backoffice\Frontend\Controller\Security;

use Eurega\Shared\Application\Service\Usuario\FindUsuarioByIdentifier;
use Eurega\Shared\Application\Service\Usuario\FindUsuarioRequest;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ProfileGetController {
    public function __construct(
        private JWTEncoderInterface $encoder,
        private FindUsuarioByIdentifier $findUsuarioByIdentifier,
        private Security $security
    ){ }

    public function __invoke(): Response {

        $token = $this->encoder->encode([
            'email' => "marmota@email.com",
            'exp' => time() + 3600, // 1 hour expiration
        ]);

        return new JsonResponse(['token' => $token]);

    }
}