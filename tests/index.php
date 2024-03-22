<?php

const KIRBY_HELPER_DUMP = false;
const KIRBY_HELPER_E = false;

require __DIR__.'/../vendor/autoload.php';

$micotime = microtime(true);
$render = (new Kirby())->render();
$micotime = microtime(true) - $micotime;
header('X-Render-Time: '.number_format($micotime, 3, '.', '').'s');
echo $render;
