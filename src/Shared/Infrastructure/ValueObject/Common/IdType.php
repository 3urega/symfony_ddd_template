<?php

namespace Eurega\Shared\Infrastructure\ValueObject\Common;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Eurega\Shared\Domain\ValueObject\Common\Id;
use Ramsey\Uuid\Doctrine\UuidType;
use Ramsey\Uuid\UuidInterface;

final class IdType extends UuidType
{
    /** @var string */
    public const TYPE_NAME = 'vo_id';

    
    public function convertToPHPValue($value, AbstractPlatform $platform): null|UuidInterface
    {
        $id = parent::convertToPHPValue($value, $platform);

        return $id !== null ? Id::fromString($id->toString()) : null;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

    public function getName(): string
    {
        return self::TYPE_NAME;
    }
}