<?php

namespace RPG\Attributes;

class AttributeLimits implements AttributeLimitsInterface
{
    protected $limits;

    const MIN = 0;
    const MAX = 1;

    public function __construct($limits)
    {
        $this->limits = $limits;
    }

    /**
     * @inheritdoc
     */
    public function isValid($id, Attribute $attribute)
    {
        if (!array_key_exists($id, $this->limits)) {
            return true;
        }

        return static::withinRange($attribute->value(), $this->limits[$id]);
    }

    /**
     * @inheritdoc
     */
    public function meetsMinimum($id, Attribute $attribute)
    {
        if (!array_key_exists($id, $this->limits)) {
            return true;
        }

        return static::highEnough($attribute->value(), $this->limits[$id]);
    }

    /**
     * @inheritdoc
     */
    public function constrainToLimit($id, Attribute $attribute)
    {
        if (!array_key_exists($id, $this->limits)) {
            return $attribute;
        }

        return $attribute->another(static::pinToRange($attribute->value(), $this->limits[$id]));
    }

    protected static function withinRange($value, $limits)
    {
        return static::highEnough($value, $limits) && ($value <= $limits[self::MAX]);
    }

    protected static function highEnough($value, $limits)
    {
        return ($value >= $limits[self::MIN]);
    }

    protected static function pinToRange($value, $limits)
    {
        return min($limits[self::MAX], max($value, $limits[self::MIN]));
    }
}
