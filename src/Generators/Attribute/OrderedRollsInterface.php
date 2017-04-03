<?php

namespace RPG\Generators\Attribute;

use RPG\Attributes\Attributes;
use RPG\Random\DiceInterface;
use RPG\Attributes\AttributeArchetypeInterface;

/**
 * Provide methods that allows the rolls to be ordered by
 * some selection mechanism.
 */
interface OrderedRollsInterface
{
    /**
     * Specify the order that the attributes should be placed in
     * @param string[] $order
     */
    public function order($order);

    /**
     * Specify an archetype that will set the order that the attributes
     * should be placed in.
     *
     * @param AttributeArchetypeInterface $archetype
     */
    public function archetype(AttributeArchetypeInterface $archetype);
}
