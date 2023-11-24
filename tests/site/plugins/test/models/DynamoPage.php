<?php

use Bnomei\Blueprints\Attributes\Blueprint;
use Bnomei\Blueprints\HasBlueprintFromAttributes;
use Bnomei\Blueprints\HasPublicPropertiesMappedToKirbyFields;
use Bnomei\Blueprints\Schema\Column;
use Bnomei\Blueprints\Schema\Field;
use Bnomei\Blueprints\Schema\Page;
use Bnomei\Blueprints\Schema\Section;
use Bnomei\Blueprints\Schema\SectionTypes;

class DynamoPage extends \Kirby\Cms\Page
{
    use HasBlueprintFromAttributes;
    use HasPublicPropertiesMappedToKirbyFields;

    #[
        Label('Loaded'),
        Type(FieldTypes::TEXT),
    ]
    public Field $fromblue;

    #[
        Blueprint
    ]
    public static function nameOfThisMethodDoesNotMatterOnlyTheAttribute(): array
    {
        // IMPORTANT: be carefull when using kirby() or site() or page() or option() here
        // since the THIS method is called before the kirby instance is fully available.
        // if you need such behaviour register the blueprint in the plugins:after hook.

        $kirby = kirby();
        $site = $kirby->site();
        $user = $kirby->user();

        // $kirby->blueprints() ==> empty
        // $site->blueprints() ==> unreliable due to being filled at this stage, will occasionally break the panel

        $x = Page::make(
            'Dynamo',
            columns: [
                Column::make('1/2')->fields([
                    'v' => Field::make('text', 'Kirby Version')
                        ->property('placeholder', $kirby->version()),
                    'a' => Field::make('text', 'Site Title')
                        ->property('placeholder', $site->title()),
                    'b' => Field::make('text', 'Blueprints')
                        ->property('placeholder', implode(', ', array_column($kirby->blueprints(), 'name'))),
                ]),
                Column::make('1/2')->sections([
                    Section::make(SectionTypes::FIELDS)->fields([
                        'c' => Field::make('text', 'User')
                            ->property('placeholder', $user->email().' ('.$user->role().')'),
                        'd' => Field::make('text', 'Value from Plugin Options')
                            ->property('placeholder', option('bnomei.blueprints.test'))
                            ->property('help', 'expected: Test'),
                        'e' => Field::make('text', 'Value from global Options')
                            ->property('placeholder', option('debug') ? 'true' : 'false'),
                    ]),
                    Section::make(SectionTypes::FILES)
                        ->label('Files'),
                ]),
            ],

        )->toArray();

        ray($x)->red();

        return $x;
    }
}
