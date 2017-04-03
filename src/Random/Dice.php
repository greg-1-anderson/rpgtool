<?php

namespace RPG\Random;

/**
 * Generate a number from one to N, where N is the "sides" of the dice.
 * Multiple dice can be rolled by stipulating the number of dice.
 * A modifier can also be provided if desired.
 *
 * Example: 3d6+1
 *
 * $dice = Dice::create()
 *   ->number(3)
 *   ->sides(6)
 *   ->modifier(1);
 *  $result = $dice->roll();
 *
 * Equivalently:
 * $dice = Dice::create()
 *   ->describe('3d6+1')
 *  $result = $dice->roll();
 *
 */
class Dice implements DiceInterface
{
    protected $sides;
    protected $number;
    protected $modifier;

    public function __construct()
    {
        $this->sides = 20;
        $this->number = 1;
        $this->modifier = 0;
    }

    public static function create()
    {
        return new self();
    }

    public function describe($numberSidesModifier)
    {
        if (!preg_match('/^([0-9]*)d([0-9]+)(\+([0-9]+))*$/', $numberSidesModifier, $matches)) {
            throw new \Exception('Formatting error: use 1d4+1');
        }
        $matches[] = '+0';
        $this->number($matches[1] === '' ? 1 : $matches[1]);
        $this->sides($matches[2]);
        $this->modifier((int)$matches[3]);
        return $this;
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

    protected function get()
    {
        $result = [];
        foreach (range(1, $this->number) as $i) {
            $result[] = rand(1, $this->sides);
        }
        return $result;
    }

    public function roll()
    {
        $rolled = $this->get();
        $result = $this->modifier + array_sum($rolled);

        return $result;
    }
}
