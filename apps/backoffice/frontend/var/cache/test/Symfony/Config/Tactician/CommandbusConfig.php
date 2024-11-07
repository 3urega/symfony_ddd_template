<?php

namespace Symfony\Config\Tactician;

use Symfony\Component\Config\Loader\ParamConfigurator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

/**
 * This class is automatically generated to help in creating a config.
 */
class CommandbusConfig 
{
    private $middleware;
    private $methodInflector;
    private $_usedProperties = [];

    /**
     * @return $this
     */
    public function middleware(string $name, mixed $value): static
    {
        $this->_usedProperties['middleware'] = true;
        $this->middleware[$name] = $value;

        return $this;
    }

    /**
     * @default null
     * @param ParamConfigurator|mixed $value
     * @return $this
     */
    public function methodInflector($value): static
    {
        $this->_usedProperties['methodInflector'] = true;
        $this->methodInflector = $value;

        return $this;
    }

    public function __construct(array $value = [])
    {
        if (array_key_exists('middleware', $value)) {
            $this->_usedProperties['middleware'] = true;
            $this->middleware = $value['middleware'];
            unset($value['middleware']);
        }

        if (array_key_exists('method_inflector', $value)) {
            $this->_usedProperties['methodInflector'] = true;
            $this->methodInflector = $value['method_inflector'];
            unset($value['method_inflector']);
        }

        if ([] !== $value) {
            throw new InvalidConfigurationException(sprintf('The following keys are not supported by "%s": ', __CLASS__).implode(', ', array_keys($value)));
        }
    }

    public function toArray(): array
    {
        $output = [];
        if (isset($this->_usedProperties['middleware'])) {
            $output['middleware'] = $this->middleware;
        }
        if (isset($this->_usedProperties['methodInflector'])) {
            $output['method_inflector'] = $this->methodInflector;
        }

        return $output;
    }

}
