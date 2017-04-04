<?php

namespace RPG\Generators\Attribute\Archetype;

use RPG\Attributes\Attributes;

class AttributeArchetype implements AttributeArchetypeInterface
{
    protected $best = [];
    protected $worst = [];

    public function __construct($best, $worst)
    {
        $this->best = $best;
        $this->worst = $worst;
    }

    public function best()
    {
        return $this->best;
    }

    public function worst()
    {
        return $this->worst;
    }

    public function order()
    {
        $others = Attributes::attributeIds();
        shuffle($others);
        $others = array_diff($others, $this->best, $this->worst);

        return array_merge($this->best, $others, $this->worst);
    }
}
