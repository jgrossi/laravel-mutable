<?php

namespace Mutable;

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

            return (new $class())->mutate(
                parent::toArray()
            );
        }

        return parent::toArray();
    }
}
