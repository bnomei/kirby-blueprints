<?php

return \Bnomei\Ink::user('member', 'Member')
    ->permissions([
        'access' => [
            'panel' => false,
        ],
    ])
    ->toArray();
