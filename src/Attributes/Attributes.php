<?php

namespace RPG\Attributes;

use RPG\Generators\Attribute\Method\AttributeGeneratorInterface;

class Attributes
{
    protected $attributes = [];

    public static function create(AttributeGeneratorInterface $generator)
    {
        $attributes = new self();

        foreach (static::attributeNames() as $id => $name) {
            $attributes->assignAttribute($id, $name, $generator->get($id));
        }

        return $attributes;
    }

    protected function assignAttribute($id, $name, $value)
    {
        $this->attributes[$id] = new Attribute($name, $value);
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
