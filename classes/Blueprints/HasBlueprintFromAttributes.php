<?php

namespace Bnomei\Blueprints;

trait HasBlueprintFromAttributes
{
    // https://github.com/bnomei/autoloader-for-kirby will pick that up automatically.
    // manually you would need to add this in your plugin index php like this
    //	'blueprints' => [
    //		'page/mypage' => MyPageModelClass::blueprintFromAttributes(),
    //	],
    public static function blueprintFromAttributes(): ?array
    {
        $blueprint = (new Blueprint(self::class));

        if ($blueprint->isLoadAfter()) {
            Blueprint::addBlueprintToLoadAfter($blueprint);

            return null;
        }

        return $blueprint->toArray();
    }
}
