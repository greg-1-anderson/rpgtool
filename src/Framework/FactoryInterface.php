<?php

namespace RPG\Framework;

interface FactoryInterface
{
    /**
     * Return a list of all objects this factory can generate
     * @return string[]
     */
    public function all();

    /**
     * Create an object of the named type from this factory.
     *
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * Test to see if the specified name can be created with this factory.
     *
     * @param string $name
     * @return boolean
     */
    public function has($name);
}
