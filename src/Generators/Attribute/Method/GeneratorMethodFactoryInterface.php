<?php

namespace RPG\Generators\Attribute\Method;

interface GeneratorMethodFactoryInterface
{
    /**
     * Get a named attribute generator
     */
    public function get($name);
    public function has($name);
}
