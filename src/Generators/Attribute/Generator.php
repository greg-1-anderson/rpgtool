<?php

namespace RPG\Generators\Attribute;

use RPG\Random\Dice;
use RPG\Generators\Attribute\Archetype\Archetypes;
use RPG\Generators\Attribute\Method\OrderedRollsInterface;
use RPG\Generators\Attribute\Method\BestRollsOrderedGenerator;
use RPG\Generators\Attribute\Method\SimpleGenerator;
use RPG\Random\DiceInterface;
use RPG\Random\DiceFactoryInterface;

use RPG\Generators\Attribute\Method\GeneratorMethodFactory;
use RPG\Generators\Attribute\Method\GeneratorMethodFactoryInterface;

/**
 * A class full of factory methods for instantiating character attribute
 * generators.
 */
class Generator
{
    /** var GeneratorMethodFactoryInterface */
    protected $generatorMethod;

    public function __construct(GeneratorMethodFactory $generatorMethod)
    {
        $this->generatorMethod = $generatorMethod;
    }

    public function create($generatorDescription = 'basic', $archetypeName = '')
    {
        $archetypeMethod = [Archetypes::class, $archetypeName];
        if (!$this->generatorMethod->has($generatorDescription) && empty($archetypeName)) {
            $archetypeMethod = [Archetypes::class, $generatorDescription];
            $generatorDescription = 'basic';
        }
        if (!empty($archetypeMethod[1]) && !is_callable($archetypeMethod)) {
            throw new \Exception('Unknown character generation method: ' . $generatorDescription . ' ' . $archetypeName);
        }

        $generator = $this->generatorMethod->get($generatorDescription);
        if (!empty($archetypeMethod[1])) {
            $archetype = $archetypeMethod();
            if (!$generator instanceof OrderedRollsInterface) {
                throw new \Exception("The $generatorDescription generator cannot be used with an archetype (e.g. $archetypeName).");
            }
            $generator->archetype($archetype);
        }
        return $generator;
    }
}
