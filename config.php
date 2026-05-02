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

if (!function_exists('crm_get_profil')) {
    function crm_get_profil($koneksi)
    {
        $profil = [
            'nama_perusahaan' => 'SnD Tour Travel',
            'email' => 'info@sndtour.com',
            'telepon' => '+62 812-3456-7890',
            'whatsapp' => '6281234567890',
            'alamat' => "Jl. Raya Darmo No. 123,\nSurabaya, Jawa Timur 60241",
            'tentang_kami' => 'Travel agent terpercaya di Surabaya sejak 2017. Menyediakan paket wisata domestik & Asia, outbond, dan catering dengan layanan profesional dan harga terjangkau.',
            'facebook' => 'https://facebook.com/sndtour',
            'instagram' => 'https://instagram.com/sndtour',
            'twitter' => '',
            'youtube' => 'https://youtube.com/@sndtour',
            'linkedin' => '',
        ];

        if (!$koneksi) {
            return $profil;
        }

        $queryProfil = mysqli_query($koneksi, "SELECT * FROM profil WHERE id = 1 LIMIT 1");
        if ($queryProfil && $dataProfil = mysqli_fetch_assoc($queryProfil)) {
            foreach ($profil as $key => $fallback) {
                if (array_key_exists($key, $dataProfil) && trim((string)$dataProfil[$key]) !== '') {
                    $profil[$key] = $dataProfil[$key];
                }
            }
        }

        return $profil;
    }
}

if (!function_exists('crm_format_whatsapp_number')) {
    function crm_format_whatsapp_number($number)
    {
        $number = preg_replace('/\D+/', '', (string)$number);

        if (strpos($number, '0') === 0) {
            return '62' . substr($number, 1);
        }

        return $number;
    }
}

if (!function_exists('crm_get_footer_context')) {
    function crm_get_footer_context($koneksi)
    {
        $profil = crm_get_profil($koneksi);
        $namaPerusahaan = trim((string)$profil['nama_perusahaan']);
        $telepon = trim((string)$profil['telepon']);
        $whatsapp = crm_format_whatsapp_number($profil['whatsapp'] ?: $telepon);

        $socialLinks = [];
        foreach (['instagram', 'facebook', 'youtube', 'twitter', 'linkedin'] as $platform) {
            $url = trim((string)$profil[$platform]);
            if ($url !== '') {
                $socialLinks[$platform] = $url;
            }
        }

        return [
            'nama_perusahaan' => $namaPerusahaan,
            'email' => trim((string)$profil['email']),
            'telepon' => $telepon,
            'alamat' => trim((string)$profil['alamat']),
            'tentang_kami' => trim((string)$profil['tentang_kami']),
            'whatsapp' => $whatsapp,
            'whatsapp_cta_url' => $whatsapp !== ''
                ? 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Halo ' . $namaPerusahaan . ', saya tertarik untuk konsultasi paket wisata')
                : 'kontak.php',
            'whatsapp_fab_url' => $whatsapp !== ''
                ? 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode('Halo ' . $namaPerusahaan . ', saya ingin bertanya tentang paket wisata')
                : 'kontak.php',
            'social_links' => $socialLinks,
        ];
    }
}

if (!function_exists('crm_get_social_icon_svg')) {
    function crm_get_social_icon_svg($platform)
    {
        $icons = [
            'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
            'facebook' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
            'youtube' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.43z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>',
            'twitter' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.657l-5.214-6.817-5.966 6.817H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z"/></svg>',
            'linkedin' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.85-3.037-1.853 0-2.136 1.447-2.136 2.941v5.665H9.352V9h3.414v1.561h.049c.476-.9 1.637-1.85 3.368-1.85 3.602 0 4.267 2.371 4.267 5.455v6.286ZM5.337 7.433a2.062 2.062 0 1 1 0-4.124 2.062 2.062 0 0 1 0 4.124ZM7.114 20.452H3.558V9h3.556v11.452Z"/></svg>',
        ];

        return $icons[$platform] ?? '';
    }
}

?>
