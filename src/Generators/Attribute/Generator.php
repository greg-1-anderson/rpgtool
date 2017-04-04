<?php

namespace RPG\Generators\Attribute;

use RPG\Random\Dice;
use RPG\Generators\Attribute\Archetype\Archetypes;
use RPG\Generators\Attribute\Method\OrderedRollsInterface;
use RPG\Generators\Attribute\Method\BestRollsOrderedGenerator;
use RPG\Generators\Attribute\Method\SimpleGenerator;
use RPG\Random\DiceInterface;
use RPG\Random\DiceFactoryInterface;

/**
 * A class full of factory methods for instantiating character attribute
 * generators.
 */
class Generator
{
    protected $dice;

    public function __construct(DiceFactoryInterface $dice)
    {
        $this->dice = $dice;
    }

    public function create($generatorDescription = 'basic', $archetypeName = '')
    {
        $generatorMethod = [$this, $generatorDescription];
        $archetypeMethod = [Archetypes::class, $archetypeName];
        if (!is_callable($generatorMethod) && empty($archetypeName)) {
            $generatorMethod = [$this, 'basic'];
            $archetypeMethod = [Archetypes::class, $generatorDescription];
        }
        if (!empty($archetypeMethod[1]) && !is_callable($archetypeMethod)) {
            throw new \Exception('Unknown character generation method: ' . $generatorDescription . ' ' . $archetypeName);
        }

        $generator = $generatorMethod();
        if (!empty($archetypeMethod[1])) {
            $archetype = $archetypeMethod();
            if (!$generator instanceof OrderedRollsInterface) {
                throw new \Exception("The $generatorDescription generator cannot be used with an archetype (e.g. $archetypeName).");
            }
            $generator->archetype($archetype);
        }
        return $generator;
    }

    public function basic()
    {
        $dice = $this->dice->create()
          ->sides(6)
          ->number(3)
          ->best(3);
        return new BestRollsOrderedGenerator($dice, 6);
    }

    public function inept()
    {
        $dice = $this->dice->create()
          ->sides(6)
          ->number(2)
          ->modifier(1);
        return new BestRollsOrderedGenerator($dice, 6);
    }

    public function average()
    {
        $dice = $this->dice->create()
          ->sides(4)
          ->number(3)
          ->modifier(3);
        return new BestRollsOrderedGenerator($dice, 6);
    }

    protected function heroic()
    {
        $dice = $this->dice->create()
          ->sides(6)
          ->number(4)
          ->best(3);
        return new BestRollsOrderedGenerator($dice, 12);
    }

    protected function incredible()
    {
        $dice = $this->dice->create()
          ->sides(6)
          ->number(1)
          ->modifier(12);
        return new BestRollsOrderedGenerator($dice, 6);
    }

    protected function monty()
    {
        $dice = $this->dice->create()
          ->sides(6)
          ->number(1)
          ->modifier(12);
        return new BestRollsOrderedGenerator($dice, 8);
    }

    protected function random()
    {
        $dice = $this->dice->create()
          ->sides(6)
          ->number(6)
          ->best(3);

        return new SimpleGenerator($dice);
    }
}
