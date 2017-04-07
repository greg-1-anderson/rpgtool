<?php

namespace RPG\Generators\Races;

use RPG\Attributes\Attribute;
use RPG\Attributes\AttributeAdjustment;
use RPG\Attributes\AttributeLimits;
use RPG\Framework\FactoryTrait;
use RPG\Races\Race;

/**
 * Archetypes describe certain combinations of attributes.  The first
 * list is the archetype's BEST attributes, ordered from best to worst.
 * The second list is the WORST attributes, with the absolute worst at
 * the end.
 *
 * Any attribute not named is ordered randomly.
 */
class RaceFactory
{
    use FactoryTrait;

    public function all()
    {
        return [
            'human',
            'dwarf',
            'elf',
            'gnome',
            'halfling',
        ];
    }

    public function human()
    {
        return new Race();
    }

    public function dwarf()
    {
        $attributeAdjustment = new AttributeAdjustment(
            [
                Attribute::CONSTITUTION => 1,
                Attribute::CHARISMA => -1,
            ]
        );

        $attributeLimits = new AttributeLimits(
            [
                Attribute::STRENGTH => [8, 18],
                Attribute::DEXTERITY => [3, 17],
                Attribute::CONSTITUTION => [11, 18],
                Attribute::CHARISMA => [3, 17],
            ]
        );

        $race = (new Race())
            ->addBehavior($attributeAdjustment)
            ->addBehavior($attributeLimits);

        return $race;
    }

    public function elf()
    {
        $attributeAdjustment = new AttributeAdjustment(
            [
                Attribute::DEXTERITY => -1,
                Attribute::CONSTITUTION => -1,
            ]
        );

        $attributeLimits = new AttributeLimits(
            [
                Attribute::DEXTERITY => [6, 18],
                Attribute::INTELLIGENCE => [8, 18],
                Attribute::CONSTITUTION => [7, 18],
                Attribute::CHARISMA => [8, 18],
            ]
        );

        $race = (new Race())
            ->addBehavior($attributeAdjustment)
            ->addBehavior($attributeLimits);

        return $race;
    }

    public function gnome()
    {
        $attributeAdjustment = new AttributeAdjustment(
            [
                Attribute::INTELLIGENCE => 1,
                Attribute::WISDOM => -1,
            ]
        );

        $attributeLimits = new AttributeLimits(
            [
                Attribute::STRENGTH => [6, 18],
                Attribute::INTELLIGENCE => [6, 18],
                Attribute::CONSTITUTION => [8, 18],
            ]
        );

        $race = (new Race())
            ->addBehavior($attributeAdjustment)
            ->addBehavior($attributeLimits);

        return $race;
    }

    public function halfling()
    {
        $attributeAdjustment = new AttributeAdjustment(
            [
                Attribute::DEXTERITY => 1,
                Attribute::STRENGTH => -1,
            ]
        );

        $attributeLimits = new AttributeLimits(
            [
                Attribute::STRENGTH => [7, 18],
                Attribute::INTELLIGNCE => [6, 18],
                Attribute::INTELLIGNCE => [3, 17],
                Attribute::DEXTERITY => [7, 18],
                Attribute::CONSTITUTION => [10, 18],
            ]
        );

        $race = (new Race())
            ->addBehavior($attributeAdjustment)
            ->addBehavior($attributeLimits);

        return $race;
    }
}
