<?php

namespace App\Core;


class Position
{
    /*
     * @var $facing String
     * which direction the bot is facing
     */
    protected $direction;
    /**
     * @var $x Integer
     * current x position of the bot
     */
    protected $x;
    /*
     * @var $y Integer
     *  current y position of the bot
     */
    protected $y;

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

    public function turn($to)
    {
        $functionName = $this->getTurnFunctionName($to);
        $this->$functionName();
    }

    public function getDirection($fullName = false)
    {
        return $fullName ? $this->directionNames[$this->direction] : $this->direction;
    }

    protected function northToRight()
    {
        $this->direction = 'e';
    }

    protected function northToLeft()
    {
        $this->direction = 'w';
    }

    protected function eastToRight()
    {
        $this->direction = 's';
    }

    protected function eastToLeft()
    {
        $this->direction = 'n';
    }

    protected function southToRight()
    {
        $this->direction = 'w';
    }

    protected function southToLeft()
    {
        $this->direction = 'e';
    }

    protected function westToRight()
    {
        $this->direction = 'n';
    }

    protected function westToLeft()
    {
        $this->direction = 's';
    }

    protected function getTurnFunctionName($to)
    {
        return $this->getDirection(true) . "To" . ucfirst($to);
    }

    function __toString()
    {
        return "X: {$this->x} Y: {$this->y} Direction: {$this->getDirection(true)}";
    }
}