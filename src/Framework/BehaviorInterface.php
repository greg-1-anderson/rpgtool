<?php

namespace RPG\Framework;

interface BehaviorInterface
{
    /**
     * Return all of the attached behaviors that implement the provided interface.
     *
     * @param string $interfaceName
     * @return mixed[]
     */
    public function getBehaviors(string $interfaceName);

    /**
     * Add a behavior to this object.
     *
     * @param mixed $behavior
     */
    public function addBehavior($behavior);
}
