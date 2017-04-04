<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Attributes\Attributes;

interface AttributeGeneratorInterface
{
    /**
     * Get a generated attribute score.
     *
     * @param mixed $id Identifier for which attribute is being generated.
     */
    public function get($id);

    /**
     * Generate an entire set of attributes
     * @return Attributes
     */
    public function attributes();
}
