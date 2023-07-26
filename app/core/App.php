<?php

// Class utama aplikasi
class App
{
    // Variabel dalam class App 
    protected $controller = "Home",
        $method = "index",
        $params = [],
        $url;

    // Method __construt akan langsung dipanggil saat class diinstansiasi
    public function __construct()
    {
        // Ingat, variabel $this mengacu pada class ini.
        // Masukkan nilai dari parseUrl ke dalam variabel url
        $this->url = $this->parseUrl();

        // https://www.php.net/manual/en/function.isset
        // https://www.php.net/manual/en/function.file-exists
        if (isset($this->url[0]) && file_exists('../app/controller/' . $this->url[0] . '.php')) {

            // Ubah nilai dari variabel controller menjadi nilai pertama dari array url
            $this->controller = $this->url[0];

            // Hapus nilai pertama dari variabel url
            unset($this->url[0]);
        }

        // Ubah nilai dari controller menjadi instansiasi dari class tersebut
        $this->controller = new $this->controller;


        // https://www.php.net/manual/en/function.method-exists
        if (isset($this->url[1]) && method_exists($this->controller, $this->url[1])) {
            // Ubah nilai dari variabel method menjadi nilai selanjutnya pada variabel url
            $this->method = $this->url[1];

            // Hapus nilai selanjutnya dari variabel url
            unset($this->url[1]);
        }

        // Jika variabel url tidak kosong
        if (!empty($this->url)) {

            // Ubah nilai dari variabel params menjadi array yang terdiri dari sisa nilai dari variabel url
            $this->params = array_values($this->url);
        }

        // https://www.php.net/manual/en/function.call-user-func-array
        // Singkatnya, jalankan method yang ada pada class controller terkait dengan parameter yang diambil dari variabel $params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Membuat nilai baru berupa array berdasarkan parameter ?url pada url
     * Contoh: localhost/?url=wahyu/pranata, jika function ini dijalankan, maka nilai yang dikembalikan function ini adalah ["wahyu", "pranata"]
     * @return array
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            $this->url = $_GET['url'];
            $this->url = rtrim($this->url);
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', $this->url);
            return $this->url;
        }
        return [];
    }
}
