<?php
session_start();
$server = "localhost";
$user = "root";
$password = "";
$nama_db = "web_crm_travel";

$koneksi = mysqli_connect($server, $user, $password, $nama_db);

if($koneksi == TRUE) {
    // echo "Berhasil terhubung";
} else {
    echo "Gagal terhubung";
}

if (!function_exists('crm_slugify')) {
    function crm_slugify($text)
    {
        $slug = strtolower(trim((string)$text));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        return trim($slug, '-');
    }
}

if (!function_exists('crm_get_kategori_footer')) {
    function crm_get_kategori_footer($koneksi)
    {
        $kategoriList = [];

        if (!$koneksi) {
            return $kategoriList;
        }

        $queryKategori = mysqli_query($koneksi, "SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori ASC");
        if ($queryKategori) {
            while ($kategori = mysqli_fetch_assoc($queryKategori)) {
                $slug = crm_slugify($kategori['nama_kategori']);
                $kategori['slug'] = $slug !== '' ? $slug : 'kategori-' . (int)$kategori['id'];
                $kategoriList[] = $kategori;
            }
        }

        return $kategoriList;
    }
}

?>
