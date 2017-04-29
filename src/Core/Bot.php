<?php

namespace App\Core;

use phpDocumentor\Reflection\Types\Integer;

class Bot
{

    protected $position;

    public function __construct()
    {
        $this->position = new Position();
    }

    public function move($commandString)
    {
        $commands = $this->getMoveCommands($commandString);
        foreach($commands as $command){
            $methodName = $command['method'];
            $param = $command['param'];
            $this->position->$methodName($param);
        }
        return $this->getPosition();
    }

    public function turnRight()
    {
        $this->position->turn('right');
        return $this;
    }

    public function turnLeft()
    {
        $this->position->turn('left');
        return $this;
    }

    /**
     * @param int $steps
     * @return $this
     */
    public function walk($steps = 1)
    {
        $this->position->walk($steps);
        return $this;
    }

    public function getPosition()
    {
        return $this->position->__toString();
    }

    public function getDirection()
    {
        return $this->position->getDirection();
    }

    /**
     * @param string $command
     * @return array
     * @throws \Exception
     */
    protected function getMoveCommands($command)
    {
        $methods = [];
        foreach (str_split($command) as $char) {
            switch ($char) {
                case 'R':
                case 'L':
                    $currentMethod=[];
                    $currentMethod['method'] = 'turn';
                    $currentMethod['param'] = $char == 'R' ? 'right':'left';
                    $methods[]=$currentMethod;
                    break;
                case 'W':
                    $methods[]['method'] = 'walk';
                    break;
                default:
                    $lastMethodIndex = count($methods) - 1;
                    if (!is_numeric($char) || count($methods) == 0 || $methods[$lastMethodIndex]['method'] !== 'walk') {
                        throw new \Exception('The move command is not in a valid format');
                    }
                    $methods[$lastMethodIndex]['param'] = isset($methods[$lastMethodIndex]['param']) ? $methods[$lastMethodIndex]['param'] . $char : $char;
                    break;

            }
        }
        return $methods;
    }
}