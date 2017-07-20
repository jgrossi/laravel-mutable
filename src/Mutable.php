<?php

namespace Jgrossi\Mutable;

/**
 * Trait Mutable
 *
 * @package Mutable
 */
trait Mutable
{
    /**
     * @return array
     */
    public function toArray()
    {
        if (isset($this->mutator)) {
            $class = $this->mutator;

            return (new $class($this))->mutate(
                array_merge($this->attributes, $this->relations)
            );
        }

        return parent::toArray();
    }
}
