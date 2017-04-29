<?php

namespace App\Core;


use phpDocumentor\Reflection\Types\Integer;

class Position
{
    /*
     * @var String
     * which direction the bot is facing
     */
    protected $direction;

    /**
     * @var Integer
     * current x position of the bot
     */
    protected $x;

    /*
     * @var Integer
     *  current y position of the bot
     */
    protected $y;

    /*
     * @var Array
     * An Array of the full names of the four directions
     */
    protected $directionNames;

    function __construct()
    {
        /*
         * initializing the bot to it's default positioning
         */
        $this->direction = 'n';
        $this->x = 0;
        $this->y = 0;

        $this->directionNames = [
            'n' => 'north',
            'e' => 'east',
            's' => 'south',
            'w' => 'west'
        ];
    }

    /**
     * @param int $steps
     * @return $this
     */
    public function walk($steps = 1)
    {
        switch ($this->direction) {
            case 'n':
                $this->y += $steps;
                break;
            case 'e':
                $this->x += $steps;
                break;
            case 's':
                $this->y -= $steps;
                break;
            case 'w':
                $this->x -= $steps;
                break;
        }
        return $this;
    }

    /**
     * @param $to
     * @return $this
     */
    public function turn($to)
    {
        $functionName = $this->getTurnFunctionName($to);
        $this->$functionName();
        return $this;
    }

    /**
     * @param bool $fullName
     * @return string
     */
    public function getDirection($fullName = false)
    {
        return $fullName ? $this->directionNames[$this->direction] : $this->direction;
    }

    /**
     * Turn right when the bot is facing north
     */
    protected function northToRight()
    {
        $this->direction = 'e';
    }

    /**
     * Turn left when the bot is facing north
     */
    protected function northToLeft()
    {
        $this->direction = 'w';
    }

    /**
     * Turn right when the bot is facing east
     */
    protected function eastToRight()
    {
        $this->direction = 's';
    }

    /**
     * Turn left when the bot is facing east
     */
    protected function eastToLeft()
    {
        $this->direction = 'n';
    }

    /**
     * Turn right when the bot is facing south
     */
    protected function southToRight()
    {
        $this->direction = 'w';
    }

    /**
     * Turn left when the bot is facing south
     */
    protected function southToLeft()
    {
        $this->direction = 'e';
    }

    /**
     * Turn right when the bot is facing west
     */
    protected function westToRight()
    {
        $this->direction = 'n';
    }

    /**
     * Turn left when the bot is facing west
     */
    protected function westToLeft()
    {
        $this->direction = 's';
    }

    /**
     * returns the turning function name that should be called
     * depending on the current facing direction of the bot and
     * the desired direction of the turn(left or right)
     *
     * @param $to
     * @return string
     */
    protected function getTurnFunctionName($to)
    {
        return $this->getDirection(true) . "To" . ucfirst($to);
    }

    /**
     * When position object is casted to string, this is called
     * @return string
     */
    function __toString()
    {
        return "X: {$this->x} Y: {$this->y} Direction: {$this->getDirection(true)}";
    }
}