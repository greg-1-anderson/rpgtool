<?php

namespace RPG\Generators\Attribute;

use RPG\Random\DiceInterface;

/**
 * A simple generator rolls exactly one time for each attribute,
 * using the type of dice provided.  Attributes may not be ordered.
 */
class SimpleGenerator extends DiceGenerator
{
    public static function create(DiceInterface $dice)
    {
        return new self($dice);
    }
}
