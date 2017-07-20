<?php

namespace Jgrossi\Mutable;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mutator
 *
 * @package Mutable
 */
class Mutator
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function mutate(array $attributes)
    {
        foreach ($attributes as $name => &$value) {
            if (method_exists($this, $method = camel_case($name))) {
                $value = call_user_func(
                    [$this, $method], $this->model->getAttribute($name)
                );
            }
        }

        return $attributes;
    }
}
