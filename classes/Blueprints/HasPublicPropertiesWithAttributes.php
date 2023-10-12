<?php

namespace Bnomei\Blueprints;

use Kirby\Toolkit\Str;
use ReflectionClass;

trait HasPublicPropertiesWithAttributes
{
	public function __construct(array $props)
	{
		parent::__construct($props);

		// register all blueprint props to their fields
		$rc = new ReflectionClass(self::class);
		foreach ($rc->getProperties(\ReflectionProperty::IS_PUBLIC) as $rp) {
			foreach ($rp->getAttributes() as $attribute) {
				if (Str::startsWith($attribute->getName(), 'Bnomei\Blueprints\Attributes')) {
					$name = $rp->getName();
					$this->{$name} = $this->{$name}(); // set the field
					break; // registered
				}
			}
		}
	}
}
