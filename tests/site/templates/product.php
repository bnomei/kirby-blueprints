<?php

/** @var ProductPage $page */
var_dump($page->email->value());
var_dump($page->description->value());
// var_dump($page->description->toBlueprint());
// var_dump($page->description->toInk());
var_dump($page->description->toInk()->label['de']);
var_dump($page->description->toInk()->type);
