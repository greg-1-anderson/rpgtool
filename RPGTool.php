<?php

use Consolidation\OutputFormatters\StructuredData\PropertyList;
use RPG\Attributes\Archetypes;
use RPG\Attributes\Attributes;
use RPG\Generators\Attribute\BestRollsOrderedGenerator;
use RPG\Generators\Attribute\Generator;
use RPG\Generators\Attribute\MontyGenerator;
use RPG\Generators\Attribute\SimpleGenerator;
use RPG\Random\DiceFactory;
use RPG\Random\Random;
use RPG\Generators\Attribute\Method\GeneratorMethodFactory;
use RPG\Generators\Attribute\Archetype\ArchetypesFactory;
use RPG\Generators\Attribute\Archetype\ArchetypesFactoryInterface;
use RPG\Generators\Races\RaceFactory;

use RPG\Attributes\AttributeAdjustmentInterface;
use RPG\Attributes\AttributeLimitsInterface;

class RPGTool
{
    protected $random;
    protected $dice;
    protected $generatorMethod;
    protected $generator;
    protected $archetypeFactory;
    protected $raceFactory;

    public function __construct()
    {
        $this->random = new Random();
        $this->dice = new DiceFactory($this->random);
        $this->generatorMethod = new GeneratorMethodFactory($this->dice);
        $this->archetypeFactory = new ArchetypesFactory();
        $this->generator = new Generator($this->generatorMethod, $this->archetypeFactory);
        $this->raceFactory = new RaceFactory();
    }

    /**
     * Roll the specified number of dice (e.g. '3d6+1') a number of times.
     */
    public function roll($diceDescription = '1d20', $times = 1)
    {
        $dice = $this->dice->create($diceDescription);
        $result = [];
        foreach (range(1, $times) as $i) {
            $result[] = $dice->roll();
        }

        return implode("\n", $result);
    }

    /**
     * Attack (roll d20) at a given THAC0 a number of times, and
     * report the armor class hit.
     */
    public function attack($thac0, $times = 1)
    {
        $dice = $this->dice->create()
          ->sides(20);

        $result = [];
        foreach (range(1, $times) as $i) {
            $roll = $dice->roll();
            $ac = $thac0 - $roll;
            $mark = '';
            if ($roll == 20) {
                $roll += 4;
                $mark = ' *';
            }
            $result[] = "Hit A.C. $ac$mark";
        }

        return implode("\n", $result);
    }

    /**
     * Randomly generate ability scores for a character.
     *
     * @return PropertyList
     */
    public function gen(
        $generatorDescription = 'basic',
        $archetypeName = '',
        $options = [
            'race' => 'human'
        ]
    ) {
        $generator = $this->generator->create($generatorDescription, $archetypeName);
        $attributes = $generator->attributes();

        $race = $this->raceFactory->get($options['race']);

        $racialAdjustments = $race->getBehaviors(AttributeAdjustmentInterface::class);
        $attributes = $attributes->alter($racialAdjustments);

        $racialLimits = $race->getBehaviors(AttributeLimitsInterface::class);
        if (!$attributes->valid($racialLimits)) {
            throw new Exception('The generated character does not have high enough stats to be a ' . $options['race']);
        }
        $attributes = $attributes->constrainToLimit($racialLimits);

        return $attributes->attributeDescriptions();
    }
}
