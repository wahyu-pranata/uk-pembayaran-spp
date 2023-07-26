<?php

// Class flasher digunakan untuk membuat flash message pada view
class Flasher
{
    // Set type dan message dalam flash menggunakan session
    public static function setFlash(string $type, string $msg)
    {
        $_SESSION['flash']['type'] = $type;
        $_SESSION['flash']['msg'] = $msg;
    }

    // Saat flash sudah ditampilkan, hapus session flash
    // Lihat lebih banyak di beberapa view
    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo "<div class='alert alert-{$_SESSION['flash']['type']}'>
                        <p class='m-0 small'>{$_SESSION['flash']['msg']}</p>
                    </div>";
            unset($_SESSION['flash']);
        }
    }
}
