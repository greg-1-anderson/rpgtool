<?php

namespace RPG\Generators\Attribute\Archetype;

use RPG\Attributes\Attribute;
use RPG\Framework\FactoryTrait;

/**
 * Archetypes describe certain combinations of attributes.  The first
 * list is the archetype's BEST attributes, ordered from best to worst.
 * The second list is the WORST attributes, with the absolute worst at
 * the end.
 *
 * Any attribute not named is ordered randomly.
 */
class ArchetypesFactory implements ArchetypesFactoryInterface
{
    use FactoryTrait;

    /**
     * Return a list of all archetypes.
     */
    public function all()
    {
        return [
            'brick',
            'hero',
            'genius',
            'scholar',
            'crusader',
            'rogue',
            'fox',
            'ox',
            'con',
            'persuader',
        ];
    }

    /**
     * Strong and dumb.
     */
    public function brick()
    {
        return new AttributeArchetype(
            [
                Attribute::STRENGTH,
                Attribute::CONSTITUTION,
                Attribute::DEXTERITY,
            ],
            [
                Attribute::CHARISMA,
                Attribute::WISDOM,
                Attribute::INTELLIGENCE,
            ]
        );
    }

    /**
     * Strong and lithe.
     */
    public function hero()
    {
        return new AttributeArchetype(
            [
                Attribute::STRENGTH,
                Attribute::DEXTERITY,
                Attribute::CONSTITUTION,
            ],
            [
            ]
        );
    }

    /**
     * Smart, but not very strong.
     */
    public function genius()
    {
        return new AttributeArchetype(
            [
                Attribute::INTELLIGENCE,
            ],
            [
                Attribute::STRENGTH,
            ]
        );
    }

    /**
     * Knowledgable about many things.
     */
    public function scholar()
    {
        return new AttributeArchetype(
            [
                Attribute::WISDOM,
                Attribute::INTELLIGENCE,
            ],
            [
                Attribute::STRENGTH,
            ]
        );
    }

    /**
     * Devout and prepared.
     */
    public function crusader()
    {
        return new AttributeArchetype(
            [
                Attribute::WISDOM,
                Attribute::STRENGTH,
                Attribute::CONSTITUTION,
            ],
            [
                Attribute::DEXTERITY,
                Attribute::INTELLIGENCE,
                Attribute::CHARISMA,
            ]
        );
    }

    /**
     * Tough and streetwise.
     */
    public function rogue()
    {
        return new AttributeArchetype(
            [
                Attribute::DEXTERITY,
                Attribute::CONSTITUTION,
                Attribute::STRENGTH,
            ],
            [
            ]
        );
    }

    /**
     * Quick, persuasive and smart, but not necessarily prudent.
     */
    public function fox()
    {
        return new AttributeArchetype(
            [
                Attribute::DEXTERITY,
                Attribute::INTELLIGENCE,
                Attribute::CHARISMA,
            ],
            [
                Attribute::WISDOM,
            ]
        );
    }

    /**
     * Hardy, strong and slow-moving.
     */
    public function ox()
    {
        return new AttributeArchetype(
            [
                Attribute::CONSTITUTION,
                Attribute::STRENGTH,
            ],
            [
                Attribute::DEXTERITY,
            ]
        );
    }

    /**
     * Convincing and smart.
     */
    public function con()
    {
        return new AttributeArchetype(
            [
                Attribute::CHARISMA,
                Attribute::INTELLIGENCE,
            ],
            [
                Attribute::STRENGTH,
                Attribute::WISDOM,
            ]
        );
    }

    /**
     * Whether leading a holy war or running a protection racket, has
     * brawn to back up arguments with action.
     */
    public function persuader()
    {
        return new AttributeArchetype(
            [
                Attribute::CHARISMA,
                Attribute::STRENGTH,
            ],
            [
            ]
        );
    }
}
