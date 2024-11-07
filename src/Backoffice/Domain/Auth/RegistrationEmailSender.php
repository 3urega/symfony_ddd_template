<?php

namespace Eurega\Backoffice\Domain\Auth;

use Eurega\Shared\Domain\Model\Usuario\Usuario;

interface RegistrationEmailSender {

    public function sendTo(Usuario $usuario): void;

}