<?php

use Core\Flasher;

/**
 * Mengembalikan url dari path yang diberikan
 */
function url(string $path): string
{
    return BASE_URL . $path;
}

/**
 * Redirect halaman ke path yang diberikan
 * Jika diberikan parameter kedua (flasher), akan memberikan pesan flash saat redirect.
 */
function redirect(string $path, array $flasher = []): void
{
    if (!empty($flasher)) Flasher::setFlash($flasher[0], $flasher[1]);
    header('Location: ' . url($path));
    exit;
}

// Jalankan perintah var_dump lalu hentikan seluruh proses yang berjalan
function dd(...$var): void
{
    var_dump($var);
    die;
}

// Balik ke halaman sebelumnya
function back(array $flasher = [])
{
    if (!empty($flasher)) Flasher::setFlash($flasher[0], $flasher[1]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Ambil path request saat ini
function getPath()
{
    return str_replace('/pembayaran-spp/public', '', $_SERVER['REQUEST_URI']);
}

// Cek apakah path saat ini sesuai dengan path diberikan
function checkPath(string $path): bool
{
    return str_contains(getPath(), $path) ? true : false;
}
