<?php

// Jika belum ada session yang berjalan, buat session baru
if (!session_id()) session_start();

// Buat file log berisi error/dll (untuk debugging)
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/log/log.txt');

// Ambil semua directory yang ada dalam directory app
$dirs = [
    __DIR__ . '\\core',
    __DIR__ . '\\controller',
    __DIR__ . '\\model',
    __DIR__ . '\\helper',
    __DIR__ . '\\config',
];

// Require/import semua file dalam directory app
foreach ($dirs as $dir) {
    foreach (glob("$dir\\*.php") as $file) {
        require_once $file;
    }
}
