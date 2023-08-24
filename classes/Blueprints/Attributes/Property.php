<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;
use Kirby\Toolkit\Str;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Property extends GenericAttribute
{
    public function __construct(
        public string $key,
        public string|bool|array $value
    ) {
    }

    public function toArray(): array
    {
        $key = strtolower(Str::camel($this->key));

        return [
            $key => $this->value,
        ];
    }
}
