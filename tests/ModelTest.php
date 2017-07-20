<?php

class ModelTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function it_has_mutate_method()
    {
        $user = new User(['first_name' => 'john']);

        $attributes = $user->toArray();

        $this->assertNotNull($attributes);
        $this->assertNotEmpty($attributes);
        $this->assertArrayHasKey('first_name', $attributes);
        $this->assertEquals('John', $attributes['first_name']);
    }    
}

class User extends \Illuminate\Database\Eloquent\Model
{
    use \Mutable\Mutable;

    protected $mutator = UserMutator::class;
    protected $guarded = [];
}

class UserMutator extends \Mutable\Mutator
{
    public function firstName($value)
    {
        return ucfirst($value);
    }
}
