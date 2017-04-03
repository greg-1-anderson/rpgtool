<?php

namespace RPG\Attributes;

interface AttributeInterface
{
    const STRENGTH = 0;
    const INTELLIGENCE = 1;
    const WISDOM = 2;
    const DEXTERITY = 3;
    const CONSTITUTION = 4;
    const CHARISMA = 5;

    public function name();
    public function value();
    public function setValue($value);
}
