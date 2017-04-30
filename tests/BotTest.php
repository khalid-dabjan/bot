<?php
use PHPUnit\Framework\TestCase;

class BotTest extends TestCase
{

    protected $bot;

    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $this->bot = new \App\Core\Bot();
    }

    /** @test */
    public function it_walks_1_step()
    {
        $this->bot->walk(1);
        $this->assertEquals("X: 0 Y: 1 Direction: north", $this->bot->getPosition());
    }

    /** @test */
    public function it_turns_to_the_right()
    {
        $this->bot->turnRight();
        $this->assertEquals('e', $this->bot->getDirection());
    }

    /** @test */
    public function it_turns_to_the_left()
    {
        $this->bot->turnLeft();
        $this->assertEquals('w', $this->bot->getDirection());
    }

    /** @test */
    public function it_does_a_360_turn_clockwise()
    {
        $this->bot
            ->turnRight()
            ->turnRight()
            ->turnRight()
            ->turnRight();
        $this->assertEquals('n', $this->bot->getDirection());
    }

    /** @test */
    public function it_does_a_360_turn_anti_clockwise()
    {
        $this->bot
            ->turnLeft()
            ->turnLeft()
            ->turnLeft()
            ->turnLeft();
        $this->assertEquals('n', $this->bot->getDirection());
    }

    /** @test */
    public function it_can_face_south()
    {
        $this->bot
            ->turnLeft()
            ->turnLeft();
        $this->assertEquals('s', $this->bot->getDirection());
    }

    /** @test */
    public function it_can_face_west()
    {
        $this->bot
            ->turnRight()
            ->turnRight()
            ->turnRight();
        $this->assertEquals('w', $this->bot->getDirection());
    }

    /** @test */
    public function it_moves()
    {
        $command = 'RW15RW1';
        $this->bot->move($command);
        $this->assertEquals("X: 15 Y: -1 Direction: south", $this->bot->getPosition());
    }

    /** @test */
    public function it_detects_illformatted_moving_commands()
    {
        $command = 'R15LW1';
        $this->expectException(Exception::class);
        $this->bot->move($command);
    }
}