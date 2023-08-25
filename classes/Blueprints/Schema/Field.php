<?php

namespace Bnomei\Blueprints\Schema;

class Field implements \JsonSerializable
{
    /**
     * @param  string|FieldTypes  $type
     * @param  string|array<string,string>  $label
     */
    public static function make(
        mixed $type = null,
        string|array $label = null,
        string|float $width = null,
        array $properties = null,
    ): self {
        return new self(...func_get_args());
    }

    public function __construct(
        public mixed $type = null,
        public string|array|null $label = null,
        public string|float|null $width = null,
        public ?array $properties = null,
    ) {
    }

    public function toArray(): array
    {
        $data = [];

        // use reflection to get all public properties of class with their current value in an array
        $rc = new \ReflectionClass($this);
        foreach ($rc->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $data[$property->getName()] = $property->getValue($this);
        }

        // move all properties to root
        if (isset($data['properties'])) {
            $data = array_merge($data, $data['properties']);
            unset($data['properties']);
        }

        ray($data)->red();

        ksort($data);

        // empty() would catch 0 and false which is not what we want
        $data = array_filter($data, fn ($value) => $value !== null && $value !== '' && $value !== []);

        return $data ?? [];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
