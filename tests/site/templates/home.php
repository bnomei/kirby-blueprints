<?php

if (get('vardump')) {
    /** @var \models\HomePage $page */
    var_dump($page::class);
    var_dump($page->blueprint()->fields());

    // regular kirby field with no code completion
    var_dump($page->introduction()->value());

    // typed field with code completion and attribute info
    var_dump($page->introduction->value());
}
