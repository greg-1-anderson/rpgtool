<?php

namespace RPG\Attributes;

interface AttributeAdjustmentInterface
{
    /**
     * Return the value of the provided attribute after it has been altered.
     *
     * @return string
     */
    public function alterAttribute($id, Attribute $attribute);
}
