<?php

namespace Jgrossi\Mutable;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

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

        return $this->callParentMethod($attributes);
    }

    /**
     * @param array $attributes
     * @return array
     */
    protected function callParentMethod(array $attributes)
    {
        $this->model->setRawAttributes($attributes);

        $reflector = new ReflectionClass($this->model);
        $parent = $reflector->getParentClass();
        $method = $parent->getMethod('toArray');

        return $method->invoke($this->model);
    }
}
