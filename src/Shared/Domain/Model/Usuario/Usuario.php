<?php

declare(strict_types=1);

namespace Eurega\Shared\Domain\Model\Usuario;

use Eurega\Shared\Domain\ValueObject\Common\EmailAddress;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Eurega\Shared\Domain\ValueObject\Common\Nombre;
use Eurega\Shared\Domain\ValueObject\Security\PasswordHash;
use Eurega\Shared\Domain\ValueObject\Security\RecoveryToken;
use Eurega\Shared\Domain\ValueObject\Security\Token\SplittedToken;
use Eurega\Shared\Domain\Aggregate\AggregateRoot;
use Eurega\Shared\Domain\ValueObject\Usuario\EstadoUsuario;

abstract class Usuario extends AggregateRoot {
    
    protected ?Id $id = null;
    protected ?Nombre $nombre;
    protected EmailAddress $direccionEmail;
    protected PasswordHash $password;
    protected EstadoUsuario $estado;
    protected ?RecoveryToken $recoveryToken;

    

    /*
    public function activar(): void
    {
        if ($this->estado->equalsTo(EstadoUsuario::activo())) {
            throw UsuarioAlreadyActivo::throw();
        }

        $this->estado = EstadoUsuario::activo();
    }

    public function bloquear(): void
    {
        if ($this->estado->equalsTo(EstadoUsuario::bloqueado())) {
            throw UsuarioAlreadyBloqueado::throw();
        }

        $this->estado = EstadoUsuario::bloqueado();
    }
    

    public function eliminar(): void
    {
        $this->estado = EstadoUsuario::eliminado();
    }

    */

    abstract public function toPrimitives(): array;

    public function recuperarContrasena(): void
    {
        $splittedToken = SplittedToken::generate();

        $this->recoveryToken = RecoveryToken::fromSplittedToken(
            $splittedToken
        );
        
        /*
        DomainEventPublisher::instance()->publish(
            new NotifyUsuarioRecordarContrasena(
                $this->id->asString(),
                $splittedToken->asString()
            )
        );
        */
    }

    public function cambiarContrasena(PasswordHash $passwordHash): void
    {
        $this->password = $passwordHash;
        $this->recoveryToken = null;
    }

    public function acceder(): void
    {
        // $this->ultimoAccesoEl = DateTime::now();
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function nombre(): ?Nombre
    {
        return $this->nombre;
    }

    public function direccionEmail(): EmailAddress
    {
        return $this->direccionEmail;
    }

    public function password(): PasswordHash
    {
        return $this->password;
    }
}
