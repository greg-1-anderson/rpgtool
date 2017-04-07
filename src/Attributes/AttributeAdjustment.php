<?php

namespace RPG\Attributes;

class AttributeAdjustment implements AttributeAdjustmentInterface
{
    protected $attributeAlterationList;

    public function __construct($attributeAlterationList)
    {
        $this->attributeAlterationList = $attributeAlterationList;
    }

    /**
     * @inheritdoc
     */
    public function alterAttribute($id, Attribute $attribute)
    {
        if (!array_key_exists($id, $this->attributeAlterationList)) {
            return $attribute;
        }
        return $attribute->another($attribute->value() + $this->attributeAlterationList[$id]);
    }
}
