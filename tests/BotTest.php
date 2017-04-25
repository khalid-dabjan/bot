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
        $this->bot = new \app\Core\Bot();
    }

    /** @test */
    public function it_moves_in_the_indicated_direction()
    {
        $this->assertTrue($this->bot->test());
    }
}