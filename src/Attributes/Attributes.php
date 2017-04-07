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

    /**
     * Alter the attribute values stored in this object. Return a new
     * object containing the results.
     *
     * @param AttributeAdjustmentInterface[] $alterations
     * @return Attributes
     */
    public function alter($alterations)
    {
        $attributes = $this->attributes;

        foreach ($this->attributes as $id => $attribute) {
            foreach ($alterations as $alteration) {
                $attributes[$id] = $alteration->alterAttribute($id, $attributes[$id]);
            }
        }

        return new self($attributes);
    }

    /**
     * Check to see if the attributes are valid per the provided constraints.
     */
    public function valid($constraints)
    {
        foreach ($this->attributes as $id => $attribute) {
            foreach ($constraints as $constraint) {
                if (!$constraint->meetsMinimum($id, $attribute)) {
                    return false;
                }
            }
        }
        return true;
    }

    public function constrainToLimit($constraints)
    {
        $attributes = $this->attributes;

        foreach ($this->attributes as $id => $attribute) {
            foreach ($constraints as $constraint) {
                $attributes[$id] = $constraint->constrainToLimit($id, $attributes[$id]);
            }
        }

        return new self($attributes);
    }
}
