<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Attributes\Attributes;
use RPG\Random\DiceInterface;
use RPG\Generators\Attribute\Archetype\AttributeArchetypeInterface;

/**
 * Provide methods that allows the rolls to be ordered by
 * some selection mechanism.
 */
trait OrderedRollsTrait
{
    protected $orderMap = [];
    protected $order = [];

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
        if (empty($this->order)) {
            $this->order = Attributes::attributeIds();
            shuffle($this->order);
        }
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
}
