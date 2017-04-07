<?php

namespace RPG\Framework;

trait BehaviorTrait
{
    protected $behaviors = [];

    /**
     * @inheritdoc
     */
    public function getBehaviors(string $interfaceName)
    {
        $result = [];

        foreach ($this->behaviors as $behavior) {
            if ($behavior instanceof BehaviorInterface) {
                $result = array_merge($result, $behavior->getBehaviors($interfaceName));
            }
            elseif ($behavior instanceof $interfaceName) {
                $result[] = $behavior;
            }
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function addBehavior($behavior)
    {
        $this->behaviors[] = $behavior;
        return $this;
    }
}
