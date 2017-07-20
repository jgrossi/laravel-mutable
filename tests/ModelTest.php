<?php

use Carbon\Carbon;

class ModelTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function it_can_change_model_attributes()
    {
        $user = new User(['first_name' => 'john']);

        $attributes = $user->toArray();

        $this->assertNotNull($attributes);
        $this->assertNotEmpty($attributes);
        $this->assertArrayHasKey('first_name', $attributes);
        $this->assertEquals('John', $attributes['first_name']);
    }

    /**
     * @test
     */
    public function it_sends_attributes_correctly()
    {
        $user = new User(['logged_at' => Carbon::create(2017, 07, 01)]);

        $attributes = $user->toArray();

        $this->assertNotEmpty($attributes);
        $this->assertArrayHasKey('logged_at', $attributes);
        $this->assertEquals('2017', $attributes['logged_at']);
    }
}

class User extends \Illuminate\Database\Eloquent\Model
{
    use \Jgrossi\Mutable\Mutable;

    protected $mutator = UserMutator::class;
    protected $guarded = [];
}

class UserMutator extends \Jgrossi\Mutable\Mutator
{
    public function firstName($value)
    {
        return ucfirst($value);
    }

    public function loggedAt(Carbon $date)
    {
        return $date->format('Y');
    }
}
