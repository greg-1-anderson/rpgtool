<?php

namespace RPG\Generators\Attribute;

use RPG\Attributes\AttributeArchetypeInterface;
use RPG\Attributes\Attributes;
use RPG\Generators\Attribute\OrderedRollsInterface;
use RPG\Random\DiceInterface;

/**
 * A generator that just gives characters a stack of ridiculous stats.
 */
class MontyGenerator implements AttributeGeneratorInterface, OrderedRollsInterface
{
    use OrderedRollsTrait;

    protected $startValue;
    protected $minRange;
    protected $maxRange;
    protected $rolls;

    public function __construct($startValue, $minRange, $maxRange)
    {
        $this->startValue = $startValue;
        $this->minRange = $minRange;
        $this->maxRange = $maxRange;
        $this->rolls = [];
    }

    public static function create($startValue, $minRange, $maxRange)
    {
        return new self($startValue, $minRange, $maxRange);
    }

    public function get($id)
    {
        if (empty($this->rolls)) {
            $this->rolls = static::montify($this->startValue, $this->minRange, $this->maxRange);
        }

        return $this->rolls[$this->getIndex($id)];
    }

    protected static function montify($startValue, $minRange, $maxRange)
    {
        $needed = count(Attributes::attributeIds());
        $rolls = [];
        while (count($rolls) < $needed) {
            $number = rand($minRange, $maxRange);
            $current = array_fill(0, $number, $startValue);
            $rolls = array_merge($rolls, $current);
            --$startValue;
        }
        return $rolls;
    }
}
