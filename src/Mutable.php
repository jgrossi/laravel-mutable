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
        return (new Mutator())->mutate(
            parent::toArray()
        );
    }
}
