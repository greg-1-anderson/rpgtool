<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Attributes\Attributes;
use RPG\Random\DiceInterface;
use RPG\Generators\Attribute\Archetype\AttributeArchetypeInterface;

/**
 * A selection generator rolls the dice the specified number of times
 * and selects the best results from all that were rolled.
 */
class OrderedGenerator extends Generator
{
    protected $rolls;
    protected $orderMap;
    protected $order;

    public function __construct(DiceInterface $dice)
    {
        $this->order = Attributes::attributeIds();
        $this->rolls = [];
        $this->orderMap = [];
        parent::__construct($dice);
    }

    public function order($order)
    {
        $this->order = $order;
        return $this;
    }

    public function archetype(AttributeArchetypeInterface $archetype)
    {
        return $this->order($archetype->order());
    }

    protected function createOrderMap()
    {
        $index = 0;
        foreach ($this->order as $id) {
            $this->orderMap[$id] = $index++;
        }
        return $this;
    }

    protected function getIndex($id)
    {
        if (empty($this->orderMap)) {
            $this->createOrderMap();
        }
        return $this->orderMap[$id];
    }

    public function get($id)
    {
        if (empty($this->rolls)) {
            $this->rolls = static::rollDice($this->dice, $this->number);
        }

        return $this->rolls[$this->getIndex($id)];
    }
}
