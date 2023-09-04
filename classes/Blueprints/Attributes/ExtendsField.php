<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::TARGET_PROPERTY)]
class ExtendsField extends GenericAttribute
{
	/**
	 * Extends from a given blueprint. like 'fields/my-custom-text'
	 */
	public function __construct(
		public string $extends
	) {
	}
}
