<?php

namespace Bnomei\Blueprints\Attributes;

use Attribute;
use Bnomei\Blueprints\Schema\Button;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Buttons extends GenericAttribute
{
    /**
     * Enables/disables the format buttons. Can either be true/false or a list of allowed buttons. Available buttons: headlines, italic, bold, link, email, file, code, ul, ol (as well as | for a divider)
     *
     * @param  bool|array<Button>  $buttons
     */
    public function __construct(
        public bool|array $buttons = true
    ) {
    }
}
