<?php

return [

    'menus' => [
        [
            'name' => 'Home',
            'url' => env('APP_URL') . 'admin',
            'icon' => 'fas fa-tachometer-alt'
        ],
        [
            'name' => 'Usuários',
            'url' => env('APP_URL') . 'admin/users',
            'icon' => 'fas fa-users'
        ],
        [
            'name' => 'Admins',
            'url' => env('APP_URL') . 'admin/admins',
            'icon' => 'fas fa-robot'
        ],
        [
            'name' => 'Cursos',
            'url' => env('APP_URL') . 'admin/courses',
            'icon' => 'fas fa-video'
        ],
        [
            'name' => 'Dúvidas',
            'url' => env('APP_URL') . 'admin/supports',
            'icon' => 'fas fa-headset'
        ],
    ],

];
