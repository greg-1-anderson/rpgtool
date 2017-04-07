<?php

namespace RPG\Framework;

trait FactoryTrait
{
    /**
     * @inheritdoc
     */
    public function all()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function get($name)
    {
        $methodFunction = $this->getGeneratorMethod($name);
        return $methodFunction();
    }

    /**
     * @inheritdoc
     */
    public function has($name)
    {
        $methodFunction = $this->getGeneratorMethod($name);
        return is_callable($methodFunction);
    }

    /**
     * Get a named attribute generator
     *
     * @param string $name
     * @return callable
     */
    protected function getGeneratorMethod($name)
    {
        return [$this, $name];
    }
}
