<?php

declare(strict_types=1);

namespace App\Backoffice\Frontend\Request\Producto;

use Eurega\Backoffice\Infrastructure\Validation\ProductoBackoffice\NombreIsValidConstraint;

use Eurega\Shared\Infrastructure\Symfony\Request\FrontendRequest;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

/**
 * @NombreIsValidConstraint(groups={"create"})
 */
abstract class ProductoBackofficeRequest extends FrontendRequest
{
    
    /** @Assert\NotBlank(message="Campo nombre obligatorio", groups={"create", "edit"}) */
    public ?string $nombre;

    public ?string $id;

    public function __construct(
        ?string $nombre = '',
        ?string $id = ''
    ) {
        $this->nombre      = $nombre;
        $this->id          = $id;
        //$this->errors = Validation::createValidator()->validate([], new Assert\Collection([]));
    }

    public static function fromRequest(Request $request): ProductoBackofficeRequest
    {
        return new static(
            trim($request->request->get('nombre')),
            $request->request->get('id')
        );
    }

    public final function getAllAsArray(): array
    {
        return array(
            "nombre" => $this->nombre
        );
    }

    public final function validateRequest(): void
    {
        $constraint = new Assert\Collection(
            [
                'nombre'     => [new Assert\NotBlank(), new Assert\Length(['min' => 5, 'max' => 255])],
            ]
        );
        $input = $this->getAllAsArray();
        $validationErrors = Validation::createValidator()->validate($input, $constraint);

        foreach($validationErrors as $validationError) {
            $this->errors[str_replace(['[', ']'], ['', ''], $validationError->getPropertyPath())] = $validationError->getMessage();
		}
    }
}
