<?php

namespace Bnomei\Blueprints;

trait HasFluentSetter
{
    // TODO: refactor to __set
    public function __call(string $name, array $arguments = []): self
    {
        // fluent setter for properties
        if (count($arguments) === 1 && property_exists($this, $name)) {
            $this->{$name} = $arguments[0];
        }

        // fluent setter for dynamic properties
        if (count($arguments) === 1 && property_exists($this, 'properties') && is_array($this->properties)) {
            $this->properties[$name] = $arguments[0];
        }

        return $this;
    }
}
