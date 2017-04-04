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
use RPG\Generators\Attribute\Archetype\ArchetypesFactoryInterface;

/**
 * A class full of factory methods for instantiating character attribute
 * generators.
 */
class Generator
{
    /** var GeneratorMethodFactoryInterface */
    protected $generatorMethod;

    /** var ArchetypesFactoryInterface */
    protected $archetypeFactory;

    public function __construct(GeneratorMethodFactory $generatorMethod, ArchetypesFactoryInterface $archetypeFactory)
    {
        $this->generatorMethod = $generatorMethod;
        $this->archetypeFactory = $archetypeFactory;
    }

    public function create($generatorDescription = 'basic', $archetypeDescription = '')
    {
        $generatorName = $generatorDescription;
        $archetypeName = $archetypeDescription;
        if (!$this->generatorMethod->has($generatorName) && empty($archetypeName)) {
            $generatorName = 'basic';
        }

        if (!empty($archetypeName) && !$this->archetypeFactory->has($archetypeName)) {
            throw new \Exception('Unknown character generation method: ' . $generatorDescription . ' ' . $archetypeDescription);
        }

        $generator = $this->generatorMethod->get($generatorName);
        if (!empty($archetypeName)) {
            if (!$generator instanceof OrderedRollsInterface) {
                throw new \Exception("The $generatorDescription generator cannot be used with an archetype (e.g. $archetypeDescription).");
            }
            $archetype = $this->archetypeFactory->get($archetypeName);
            $generator->archetype($archetype);
        }
        return $generator;
    }
}
