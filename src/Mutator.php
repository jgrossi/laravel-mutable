<?php

namespace Mutable;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mutator
 *
 * @package Mutable
 */
class Mutator
{
    /**
     * @param array $attributes
     * @return array
     */
    public function mutate(array $attributes)
    {
        foreach ($attributes as $name => &$value) {
            if (method_exists($this, $method = camel_case($name))) {
                $value = call_user_func([$this, $method], $value);
            }
        }

        return $attributes;
    }
}
