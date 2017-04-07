<?php

namespace RPG\Attributes;

interface AttributeInterface
{
    const STRENGTH = 0;
    const INTELLIGENCE = 1;
    const WISDOM = 2;
    const DEXTERITY = 3;
    const CONSTITUTION = 4;
    const CHARISMA = 5;

    /**
     * Return another attribute of this same kind, but with a different value.
     *
     * @return AttributeInterface
     */
    public function another($value);

    /**
     * Return the human-readable name for this attribute
     *
     * @return string
     */
    public function name();
    /**
     * Return the ordinary value of this attribute. Always returns a
     * single integer, usually 3-18, but sometimes as high as 25.
     */
    public function value();
    /**
     * Return a human-readable description of this attribute value. This
     * will usually be the same as the attributes value, but may occasionally
     * contain an exceptional componenet (e.g. "18 100%").
     */
    public function describe();
    /**
     * Change the value of this attribute.
     */
    public function setValue($value);
}
