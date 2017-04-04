<?php

namespace RPG\Random;

/**
 * Generate a random number. The characteristics of the number
 * depends on the implementation.
 */
interface RollInterface
{
    public function roll();
}
