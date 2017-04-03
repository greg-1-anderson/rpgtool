<?php

namespace RPG\Generators\Attribute;

use RPG\Random\BestDice;
use RPG\Attributes\Archetypes;
use RPG\Generators\Attribute\OrderedRollsInterface;
use RPG\Random\DiceInterface;

/**
 * A class full of static factory methods for instantiating character attribute
 * generators.
 */
class Generator
{
    public static function create($generatorDescription = 'basic', $archetypeName = '')
    {
        $generatorMethod = [Generator::class, $generatorDescription];
        $archetypeMethod = [Archetypes::class, $archetypeName];
        if (!is_callable($generatorMethod) && empty($archetypeName)) {
            $generatorMethod = [Generator::class, 'basic'];
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

    public static function basic()
    {
        $dice = BestDice::create()
          ->sides(6)
          ->number(3)
          ->best(3);
        return BestRollsOrderedGenerator::create($dice, 6);
    }

    public static function inept()
    {
        $dice = BestDice::create()
          ->sides(6)
          ->number(2)
          ->modifier(1);
        return BestRollsOrderedGenerator::create($dice, 6);
    }

    public static function average()
    {
        $dice = BestDice::create()
          ->sides(4)
          ->number(3)
          ->modifier(3);
        return BestRollsOrderedGenerator::create($dice, 6);
    }

    protected static function heroic()
    {
        $dice = BestDice::create()
          ->sides(6)
          ->number(4)
          ->best(3);
        return BestRollsOrderedGenerator::create($dice, 12);
    }

    protected static function incredible()
    {
        $dice = BestDice::create()
          ->sides(6)
          ->number(1)
          ->modifier(12);
        return BestRollsOrderedGenerator::create($dice, 6);
    }

    protected static function monty()
    {
        $dice = BestDice::create()
          ->sides(6)
          ->number(1)
          ->modifier(12);
        return BestRollsOrderedGenerator::create($dice, 8);
    }

    protected static function random()
    {
        $dice = BestDice::create()
          ->sides(6)
          ->number(6)
          ->best(3);

        return SimpleGenerator::create($dice);
    }
}
