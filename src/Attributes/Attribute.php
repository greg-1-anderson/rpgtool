<?php

namespace RPG\Attributes;

class Attribute implements AttributeInterface
{
    protected $name;
    protected $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function another($value)
    {
        return new self($this->name, $value);
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function describe()
    {
        return $this->value();
    }

    /**
     * @inheritdoc
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
