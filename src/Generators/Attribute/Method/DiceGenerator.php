<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Random\DiceInterface;

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
}
