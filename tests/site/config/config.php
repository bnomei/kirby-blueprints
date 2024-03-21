<?php

use Bnomei\Ink;

return [
    'debug' => true,

    'content' => [
        'locking' => false,
    ],

    //    'ready' => function () {
    //        $kirby = kirby();
    //
    //        return [
    //            'blueprints' => [
    //                'users/vip' => Ink::user('vip', 'Vip')
    //                    ->fields([
    //                        'vip' => Ink::field('info')
    //                            ->label('VIP')
    //                            ->text($kirby->user()->role()->name() === 'vip' ? 'VIP' : 'NO VIP')
    //                            ->default('VIP'),
    //                    ])
    //                    ->toArray(),
    //            ],
    //        ];
    //    },
];
