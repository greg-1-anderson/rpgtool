<?php

namespace RPG\Random;

/**
 * Generate random numbers.
 */
class Random implements RandomInterface
{
    public function random($min, $max)
    {
        return rand($min, $max);
    }
}
