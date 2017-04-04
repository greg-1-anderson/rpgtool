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

class RPGTool
{
    protected $generator;

    public function __construct()
    {
        $this->dice = new DiceFactory(new Random());
        $this->generator = new Generator($this->dice);
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
    public function gen($generatorDescription = 'basic', $archetypeName = '')
    {
        $generator = $this->generator->create($generatorDescription, $archetypeName);
        $attributes = Attributes::create($generator);

        return $attributes->attributeDescriptions();
    }
}
