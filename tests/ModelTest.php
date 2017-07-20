<?php

class ModelTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function it_has_mutate_method()
    {
        $user = new User;

        $result = $user->mutate();

        $this->assertNotNull($result);
        $this->assertNotEmpty($result);
    }    
}
