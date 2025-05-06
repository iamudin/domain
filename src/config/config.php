<?php
return [
    'name'=>'Domain',
    'url'=>env('APP_URL_DOMAIN',null),
    'path'=>'domain',
    'path_url'=>null,
    'icon' => 'fa-globe',
    'route' => null,
    'title' => env('APP_TITLE_DOMAIN','Domain'),
    'description' => env('APP_DESCRIPTION_DOMAIN','Layanan Pendaftaran Domain'),
    'module' =>
    array(
        [
            'name' => 'Dashboard',
            'route' => 'domain.dashboard',
            'icon' => 'fa-dashboard',
            'path' => 'dashboard',
        ],
        [
            'name' => 'Daftar Domain',
            'route' => 'daftar.index',
            'icon' => 'fa-globe',
            'path' =>  'daftar',
        ],
        [
            'name' => 'Pembayaran Domain',
            'route' => 'invoice.index',
            'icon' => 'fa-dollar',
            'path' => 'invoice',
        ],
        [
            'name' => 'Pengelola',
            'route' => 'pengelola.index',
            'icon' => 'fa-user',
            'path' => 'pengelola',
        ],

    )
];
