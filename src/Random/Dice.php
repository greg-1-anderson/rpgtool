<?php

namespace RPG\Random;

/**
 * Generate a number from one to N, where N is the "sides" of the dice.
 * Multiple dice can be rolled by stipulating the number of dice.
 * A modifier can also be provided if desired.
 */
class Dice implements DiceInterface
{
    /** var RandomInterface */
    protected $random;
    protected $sides;
    protected $number;
    protected $modifier;
    protected $keep;

    public function __construct(RandomInterface $random)
    {
        $this->random = $random;
        $this->sides = 20;
        $this->number = 1;
        $this->modifier = 0;
        $this->keep = 0;
    }

    public function sides($sides)
    {
        $this->sides = $sides;
        return $this;
    }

    public function number($number)
    {
        $this->number = $number;
        return $this;
    }

    public function modifier($modifier)
    {
        $this->modifier = $modifier;
        return $this;
    }

    public function best($keep)
    {
        $this->keep = $keep;
        return $this;
    }

    protected function keepBest($result)
    {
        if (!$this->keep) {
            return $result;
        }
        rsort($result);
        return array_slice($result, 0, $this->keep);
    }

    protected function get()
    {
        $result = [];
        foreach (range(1, $this->number) as $i) {
            $result[] = $this->random->random(1, $this->sides);
        }

        return $this->keepBest($result);
    }

    public function roll()
    {
        $rolled = $this->get();
        $result = $this->modifier + array_sum($rolled);

        return $result;
    }
}
