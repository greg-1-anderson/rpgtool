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

    public function name()
    {
        return $this->name;
    }

    public function value()
    {
        return $this->value;
    }

    public function describe()
    {
        return $this->value();
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
