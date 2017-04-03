<?php

namespace RPG\Generators\Attribute;

interface AttributeGeneratorInterface
{
    /**
     * Get a generated attribute score.
     *
     * @param mixed $id Identifier for which attribute is being generated.
     */
    public function get($id);
}
