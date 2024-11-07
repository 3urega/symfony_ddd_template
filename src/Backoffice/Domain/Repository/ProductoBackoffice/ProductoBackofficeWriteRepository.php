<?php

declare(strict_types=1);

namespace Eurega\Backoffice\Domain\Repository\ProductoBackoffice;

use Eurega\Backoffice\Domain\Model\ProductoBackoffice\ProductoBackoffice;

use Eurega\Shared\Domain\ValueObject\Common\Id;

interface ProductoBackofficeWriteRepository 
{
    public function nextIdentity(): Id;

    public function save(ProductoBackoffice $producto): void;
}
