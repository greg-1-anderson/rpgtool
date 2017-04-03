<?php

namespace RPG\Random;

class BestDice extends Dice
{
    protected $keep;

    public function __construct()
    {
        $this->keep = 0;
        parent::__construct();
    }

    public static function create()
    {
        return new self();
    }

    public function best($keep)
    {
        $this->keep = $keep;
        return $this;
    }

    protected function get()
    {
        $result = parent::get();
        if (!$this->keep) {
          return $result;
        }
        rsort($result);
        return array_slice($result, 0, $this->keep);
    }
}
