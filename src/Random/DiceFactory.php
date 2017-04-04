<?php

namespace RPG\Random;

/**
 * Generate a number from one to N, where N is the "sides" of the dice.
 * Multiple dice can be rolled by stipulating the number of dice.
 * A modifier can also be provided if desired.
 *
 * Example: 3d6+1
 *
 * $dice = $factory->create()
 *   ->number(3)
 *   ->sides(6)
 *   ->modifier(1);
 *  $result = $dice->roll();
 *
 * Equivalently:
 * $dice = $factory->create('3d6+1');
 * $result = $dice->roll();
 *
 */
class DiceFactory implements DiceFactoryInterface
{
    /** var RandomInterface */
    protected $random;

    public function __construct(RandomInterface $random)
    {
        $this->random = $random;
    }

    public function create($numberSidesModifier = '')
    {
        $dice = new Dice($this->random);
        $this->parseDiceDescription($dice, $numberSidesModifier);
        return $dice;
    }

    protected function parseDiceDescription($dice, $numberSidesModifier)
    {
        if (empty($numberSidesModifier)) {
            return;
        }

        if (!preg_match('/^([0-9]*)d([0-9]+)(\+([0-9]+))*$/', $numberSidesModifier, $matches)) {
            throw new \Exception('Formatting error: use 1d4+1');
        }
        $matches[] = '+0';
        $dice
          ->number($matches[1] === '' ? 1 : $matches[1])
          ->sides($matches[2])
          ->modifier((int)$matches[3]);
    }
}

