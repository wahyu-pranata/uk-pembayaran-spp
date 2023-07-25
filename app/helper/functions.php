<?php

function url(string $path): string {
    return BASE_URL . $path;
}
function redirect(string $path, array $flasher = []): void {
    if(!empty($flasher)) Flasher::setFlash($flasher[0], $flasher[1]);
    header('Location: ' . url($path));
    exit;
}
function dd(...$var): void {
    var_dump($var);
    die;
}
function back(array $flasher = []) {
    if (!empty($flasher)) Flasher::setFlash($flasher[0], $flasher[1]);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
function getPath() {
    return str_replace('/pembayaran-spp/public', '', $_SERVER['REQUEST_URI']);
}
/**
 * Check path is correct
 */
function checkPath(string $path): bool {
    return str_contains(getPath(), $path) ? true : false;
}
