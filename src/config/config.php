<?php
$path = 'domain';
return [
    'name'=>'Domain',
    'path'=>$path,
    'icon' => 'fa-globe',
    'description' => 'Sistem Informasi Jadwal Roro',
    'module' =>
    array(
        [
            'name' => 'Dashboard',
            'route' => $path . '.dashboard',
            'icon' => 'fa-dashboard',
            'path' => $path . '/dashboard',
        ],
        [
            'name' => 'Daftar Domain',
            'route' => 'daftar.index',
            'icon' => 'fa-globe',
            'path' => $path . '/daftar',
        ],
        [
            'name' => 'Pembayaran Domain',
            'route' => 'invoice.index',
            'icon' => 'fa-dollar',
            'path' => $path . '/invoice',
        ],
        [
            'name' => 'Pengelola',
            'route' => 'pengelola.index',
            'icon' => 'fa-user',
            'path' => $path . '/pengelola',
        ],

    )
];
