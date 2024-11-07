<?php

namespace ContainerCkA6dzx;

class MinkProxy621b941 extends \Behat\Mink\Mink implements \Symfony\Component\VarExporter\LazyObjectInterface
{
    use \Symfony\Component\VarExporter\LazyProxyTrait;

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'defaultSessionName' => [parent::class, 'defaultSessionName', null],
        "\0".parent::class."\0".'sessions' => [parent::class, 'sessions', null],
        'defaultSessionName' => [parent::class, 'defaultSessionName', null],
        'sessions' => [parent::class, 'sessions', null],
    ];
}

// Help opcache.preload discover always-needed symbols
class_exists(\Symfony\Component\VarExporter\Internal\Hydrator::class);
class_exists(\Symfony\Component\VarExporter\Internal\LazyObjectRegistry::class);
class_exists(\Symfony\Component\VarExporter\Internal\LazyObjectState::class);

if (!\class_exists('MinkProxy621b941', false)) {
    \class_alias(__NAMESPACE__.'\\MinkProxy621b941', 'MinkProxy621b941', false);
}
