<?php

namespace Bnomei\Blueprints;

trait HasFluentGetter
{
    public function __get(string $name): mixed
    {
        // fluent getter for dynamic properties
        if (property_exists($this, 'properties') && is_array($this->properties) && array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        return null;
    }
}
