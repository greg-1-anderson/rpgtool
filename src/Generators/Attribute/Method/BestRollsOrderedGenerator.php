<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Generators\Attribute\Archetype\AttributeArchetypeInterface;
use RPG\Attributes\Attributes;
use RPG\Random\DiceInterface;

/**
 * A selection generator rolls the dice the specified number of times
 * and selects the best results from all that were rolled.
 */
class BestRollsOrderedGenerator extends DiceGenerator implements OrderedRollsInterface
{
    use OrderedRollsTrait;

    protected $number;
    protected $rolls;

    public function __construct(DiceInterface $dice, $number)
    {
        $this->number = $number;
        $this->rolls = [];
        parent::__construct($dice);
    }

    public function get($id)
    {
        if (empty($this->rolls)) {
            $this->rolls = static::rollDice($this->dice, $this->number);
        }

        return $this->rolls[$this->getIndex($id)];
    }

    protected static function rollDice($dice, $number)
    {
        $rolls = [];
        foreach (range(1, $number) as $i) {
          $rolls[] = $dice->roll();
        }
        rsort($rolls);
        return $rolls;
    }
}
