<?php

namespace RPG\Attributes;

use RPG\Generators\Attribute\Method\AttributeGeneratorInterface;

class Attributes
{
    protected $attributes = [];

    public function __construct($attributes)
    {
        $this->attributes = $attributes;
    }

    public static function attributeNames()
    {
        return [
            Attribute::STRENGTH => 'Strength',
            Attribute::INTELLIGENCE => 'Intelligence',
            Attribute::WISDOM => 'Wisdom',
            Attribute::DEXTERITY => 'Dexterity',
            Attribute::CONSTITUTION => 'Constitution',
            Attribute::CHARISMA => 'Charisma',
        ];
    }

    public static function attributeIds()
    {
        return array_keys(static::attributeNames());
    }

    public function attributeDescriptions()
    {
        $result = [];

        foreach ($this->attributes as $id => $attribute) {
            $result[$attribute->name()] = $attribute->describe();
        }

        return $result;
    }
}
