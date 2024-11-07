<?php

namespace Eurega\Backoffice\Infrastructure\Service\Auth;

use Eurega\Backoffice\Domain\Auth\RegistrationEmailSender;
use Eurega\Shared\Domain\Model\Usuario\Usuario;

final class MailtrapRegistrationEmailSender implements RegistrationEmailSender {

    public function sendTo(Usuario $usuario): void {

        return;
    }

}