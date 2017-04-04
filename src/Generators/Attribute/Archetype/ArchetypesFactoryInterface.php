<?php

namespace RPG\Generators\Attribute\Archetype;

interface ArchetypesFactoryInterface
{
    /**
     * Get a named archetype
     */
    public function get($name);
    public function has($name);
}
