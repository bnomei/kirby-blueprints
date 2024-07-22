<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;
use Kirby\Toolkit\Str;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class Property extends GenericAttribute
{
    /**
     * Attach a property to the field with given key and value
     */
    public function __construct(
        public string $key,
        public string|bool|array $value
    ) {}

    public function toArray(): array
    {
        $key = strtolower(Str::camel($this->key));

        return [
            $key => $this->value,
        ];
    }
}
