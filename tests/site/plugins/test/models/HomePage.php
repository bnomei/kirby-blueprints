<?php

use Bnomei\Blueprints\Attributes\Label;
use Bnomei\Blueprints\Attributes\Type;
use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesWithAttributes;
use Bnomei\Blueprints\Schema\FieldTypes;
use Kirby\Cms\Page;
use Kirby\Content\Field;

class HomePage extends Page
{
	use HasBlueprintFromAttributes;
	use HasPublicPropertiesWithAttributes;

	#[
		Label([
			'en' => 'Introduction',
			'de' => 'Einleitung',
		]),
		Type(FieldTypes::TEXT),
	]
	public Field $introduction;
}
