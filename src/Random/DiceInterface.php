<?php

namespace RPG\Random;

/**
 * Generate a random number. The characteristics of the number
 * depends on how the object is initialized.
 */
interface DiceInterface extends RollInterface
{
    public function sides($sides);
    public function number($number);
    public function modifier($modifier);
    public function best($keep);
}
