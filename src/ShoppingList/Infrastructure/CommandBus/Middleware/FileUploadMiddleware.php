<?php

namespace Eurega\ShoppingList\Infrastructure\CommandBus\Middleware;

use Eurega\ShoppingList\Domain\Service\File\FileManager;
use League\Tactician\Middleware;
use Throwable;

final class FileUploadMiddleware implements Middleware
{
    private FileManager $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function execute($command, callable $next)
    {
        try {
            $this->fileManager->beginTransaction();

            $returnValue = $next($command);

            $this->fileManager->commit();
        } catch (Throwable $e) {
            $this->fileManager->rollback();
            $this->fileManager->clear();

            throw $e;
        }

        $this->fileManager->clear();

        return $returnValue;
    }
}
