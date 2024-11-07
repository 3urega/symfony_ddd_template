<?php

namespace Symfony\Config;

require_once __DIR__.\DIRECTORY_SEPARATOR.'Tactician'.\DIRECTORY_SEPARATOR.'CommandbusConfig.php';

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Loader\ParamConfigurator;

/**
 * This class is automatically generated to help in creating a config.
 */
class TacticianConfig implements \Symfony\Component\Config\Builder\ConfigBuilderInterface
{
    private $commandbus;
    private $defaultBus;
    private $methodInflector;
    private $security;
    private $loggerFormatter;
    private $_usedProperties = [];

    /**
     * @default {"default":{"middleware":["tactician.middleware.command_handler"]}}
    */
    public function commandbus(string $name, array $value = []): \Symfony\Config\Tactician\CommandbusConfig
    {
        if (!isset($this->commandbus[$name])) {
            $this->_usedProperties['commandbus'] = true;
            $this->commandbus[$name] = new \Symfony\Config\Tactician\CommandbusConfig($value);
        } elseif (1 < \func_num_args()) {
            throw new InvalidConfigurationException('The node created by "commandbus()" has already been initialized. You cannot pass values the second time you call commandbus().');
        }

        return $this->commandbus[$name];
    }

    /**
     * @default 'default'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function defaultBus($value): static
    {
        $this->_usedProperties['defaultBus'] = true;
        $this->defaultBus = $value;

        return $this;
    }

    /**
     * @default 'tactician.handler.method_name_inflector.handle'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function methodInflector($value): static
    {
        $this->_usedProperties['methodInflector'] = true;
        $this->methodInflector = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function security(string $name, ParamConfigurator|array $value): static
    {
        $this->_usedProperties['security'] = true;
        $this->security[$name] = $value;

        return $this;
    }

    /**
     * @default 'tactician.logger.class_properties_formatter'
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function loggerFormatter($value): static
    {
        $this->_usedProperties['loggerFormatter'] = true;
        $this->loggerFormatter = $value;

        return $this;
    }

    public function getExtensionAlias(): string
    {
        return 'tactician';
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('commandbus', $value)) {
            $this->_usedProperties['commandbus'] = true;
            $this->commandbus = array_map(fn ($v) => new \Symfony\Config\Tactician\CommandbusConfig($v), $value['commandbus']);
            unset($value['commandbus']);
        }

        if (array_key_exists('default_bus', $value)) {
            $this->_usedProperties['defaultBus'] = true;
            $this->defaultBus = $value['default_bus'];
            unset($value['default_bus']);
        }

        if (array_key_exists('method_inflector', $value)) {
            $this->_usedProperties['methodInflector'] = true;
            $this->methodInflector = $value['method_inflector'];
            unset($value['method_inflector']);
        }

        if (array_key_exists('security', $value)) {
            $this->_usedProperties['security'] = true;
            $this->security = $value['security'];
            unset($value['security']);
        }

        if (array_key_exists('logger_formatter', $value)) {
            $this->_usedProperties['loggerFormatter'] = true;
            $this->loggerFormatter = $value['logger_formatter'];
            unset($value['logger_formatter']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['commandbus'])) {
            $output['commandbus'] = array_map(fn ($v) => $v->toArray(), $this->commandbus);
        }
        if (isset($this->_usedProperties['defaultBus'])) {
            $output['default_bus'] = $this->defaultBus;
        }
        if (isset($this->_usedProperties['methodInflector'])) {
            $output['method_inflector'] = $this->methodInflector;
        }
        if (isset($this->_usedProperties['security'])) {
            $output['security'] = $this->security;
        }
        if (isset($this->_usedProperties['loggerFormatter'])) {
            $output['logger_formatter'] = $this->loggerFormatter;
        }

        return $output;
    }

}
