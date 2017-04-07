<?php

namespace RPG\Races;

use RPG\Framework\BehaviorInterface;
use RPG\Framework\BehaviorTrait;

/**
 * A Race contains behaviors that modify a character's abilities.
 *
 * Any attribute not named is ordered randomly.
 */
class Race
{
    use BehaviorTrait;
}
