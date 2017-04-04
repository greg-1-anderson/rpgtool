<?php

namespace RPG\Generators\Attribute;

trait FactoryTrait
{
    /**
     * Get a named attribute generator
     */
    public function get($name)
    {
        $methodFunction = $this->getGeneratorMethod($name);
        return $methodFunction();
    }

    public function has($name)
    {
        $methodFunction = $this->getGeneratorMethod($name);
        return is_callable($methodFunction);
    }

    protected function getGeneratorMethod($name)
    {
        return [$this, $name];
    }
}
