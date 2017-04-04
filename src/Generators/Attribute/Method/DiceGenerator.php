<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Random\DiceInterface;
use RPG\Attributes\Attribute;
use RPG\Attributes\Attributes;

/**
 * Generator that uses a DiceInterface for generating attributes.
 */
class DiceGenerator implements AttributeGeneratorInterface
{
    protected $dice;

    public function __construct(DiceInterface $dice)
    {
        $this->dice = $dice;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        return $this->dice->roll();
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        $attributes = [];

        foreach (Attributes::attributeNames() as $id => $name) {
            $attributes[$id] = new Attribute($name, $this->get($id));
        }

        return new Attributes($attributes);
    }
}
