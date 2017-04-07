<?php

namespace RPG\Attributes;

interface AttributeLimitsInterface
{
    /**
     * Determine if provided attribute is within range.
     *
     * @return boolean
     */
    public function isValid($id, Attribute $attribute);

    /**
     * Check to see if the provided attribute meets the minimum requirements.
     */
    public function meetsMinimum($id, Attribute $attribute);

    /**
     * Pin the provided attribute to lie within the range allowed by the
     * constraints imposed by this object.
     *
     * @return boolean
     */
    public function constrainToLimit($id, Attribute $attribute);
}
