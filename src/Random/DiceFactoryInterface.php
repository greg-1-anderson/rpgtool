<?php

namespace RPG\Random;

/**
 * Create an object that generates a random number. The characteristics of the
 * number depends on how the returned object is initialized.
 */
interface DiceFactoryInterface
{
    /**
     * @return DiceInterface
     */
    public function create($numberSidesModifier = '');
}
