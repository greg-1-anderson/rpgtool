<?php

namespace RPG\Random;

/**
 * Generate a random number. The characteristics of the number
 * depends on the implementation.
 */
interface DiceInterface
{
    public function roll();
}
