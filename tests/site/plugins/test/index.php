<?php

// load the fields stored as traits
autoloader(__DIR__)->classes();

// load everything else with the autoloader
Kirby::plugin('test/plugin', autoloader(__DIR__)->toArray());
