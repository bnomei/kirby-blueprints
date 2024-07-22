<?php

namespace Bnomei\Blueprints;

use ReflectionClass;
use ReflectionProperty;

trait HasProperties
{
    public function toArray(): array
    {
        $data = [];

        // use reflection to get all public properties of class with their current value in an array
        $rc = new ReflectionClass($this);
        foreach ($rc->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        // move all properties to root
        if (isset($data['properties']) && is_array($data['properties'])) {
            $data = array_merge($data, $data['properties']);
            unset($data['properties']);
        }

        // resolve enums etc...
        $json_encode = json_encode($data);
        if ($json_encode === false) {
            throw new \Exception('Could not encode to JSON.');
        }
        $data = json_decode($json_encode, true);
        if (! is_array($data)) {
            $data = [];
        }
        ksort($data);

        // empty() would catch 0 and false which is not what we want
        $data = Blueprint::arrayRemoveByValuesRecursive($data, [null, '', []]);

        return $data;
    }

    public function property(string $key, mixed $value): self
    {
        $this->properties[$key] = $value;

        return $this;
    }

    /**
     * @internal
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
