<?php

namespace RPG\Generators\Attribute\Method;

use RPG\Random\DiceFactoryInterface;

class GeneratorMethodFactory implements GeneratorMethodFactoryInterface
{
    /** var DiceFactoryInterface */
    protected $dice;

    public function __construct(DiceFactoryInterface $dice)
    {
        $this->dice = $dice;
    }

    /**
     * Get a named attribute generator
     */
    public function get($name)
    {
        $methodFunction = $this->getGeneratorMethod($name);
        return $methodFunction();
    }

    public function has($name)
    {
        $methodFunction = $this->getGeneratorMethod($name);
        return is_callable($methodFunction);
    }

    protected function getGeneratorMethod($name)
    {
        return [$this, $name];
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
