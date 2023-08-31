<?php

namespace Bnomei\Blueprints;

trait HasFluentSetter
{
    public function __call($name, $arguments): self
    {
        // fluent setter
        if (count($arguments) === 1 && property_exists($this, $name)) {
            $this->{$name} = $arguments[0];

            return $this;
        }

        return parent::__call($name, $arguments);
    }
}
