<?php

$a = autoloader(__DIR__)->toArray();

// ray($a)->red();

// load everything else with the autoloader
Kirby::plugin('test/aaaa', $a);
