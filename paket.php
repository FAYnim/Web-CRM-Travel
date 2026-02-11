<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisata Unggulan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,400&f[]=general-sans@600,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Satoshi', sans-serif;
        }
        
        .font-general {
            font-family: 'General Sans', sans-serif;
        }
        
        .scroll-container {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .scroll-container::-webkit-scrollbar {
            display: none;
        }
        
        .package-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .package-card:active {
            transform: scale(0.98);
        }
        
        .star-icon {
            transition: color 0.2s ease;
        }
        
        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
</head>

<?php include('navbar.php'); ?>

<body>

    <div class="w-full min-h-screen flex flex-col bg-white scroll-smooth">
        <main class="flex-1 overflow-y-auto pt-8 pb-8">
            <!-- Section Header -->
            <div class="px-6 mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-2 font-general">Paket Wisata Unggulan</h1>
                <p class="text-sm text-gray-600 leading-relaxed max-w-2xl mx-auto">Temukan pengalaman perjalanan terbaik dengan paket wisata pilihan kami yang dirancang khusus untuk liburan sempurna Anda</p>
                <div class="mt-4 flex items-center justify-center gap-3">
                    <span class="h-px w-14 bg-gradient-to-r from-transparent via-amber-300 to-transparent"></span>
                    <span class="h-2 w-2 rounded-full bg-amber-400 shadow-[0_0_12px_rgba(251,191,36,0.6)]"></span>
                    <span class="h-px w-14 bg-gradient-to-r from-transparent via-amber-300 to-transparent"></span>
                </div>
            </div>
            
            <!-- Grid Container -->
            <div class="px-6 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <!-- Card 1 -->
                        <div class="package-card bg-white rounded-2xl overflow-hidden shadow-sm" style="box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <div class="relative h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600&h=400&fit=crop" alt="Bali Paradise" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-teal-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Hot Deal
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Bali Paradise Escape</h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">5 Hari 4 Malam</span>
                                </div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">Bali, Indonesia</span>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <p class="text-xl font-bold text-teal-600">Rp 4.500.000</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="package-card bg-white rounded-2xl overflow-hidden shadow-sm" style="box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <div class="relative h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600&h=400&fit=crop" alt="Raja Ampat" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-teal-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Promo
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Raja Ampat Adventure</h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">7 Hari 6 Malam</span>
                                </div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">Papua Barat, Indonesia</span>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <p class="text-xl font-bold text-teal-600">Rp 12.800.000</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="package-card bg-white rounded-2xl overflow-hidden shadow-sm" style="box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <div class="relative h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop" alt="Bromo Sunrise" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Bromo Sunrise Tour</h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">3 Hari 2 Malam</span>
                                </div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">Jawa Timur, Indonesia</span>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <p class="text-xl font-bold text-teal-600">Rp 2.200.000</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 4 -->
                        <div class="package-card bg-white rounded-2xl overflow-hidden shadow-sm" style="box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <div class="relative h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=600&h=400&fit=crop" alt="Komodo Island" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Komodo Island Explorer</h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">4 Hari 3 Malam</span>
                                </div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">Nusa Tenggara Timur</span>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <p class="text-xl font-bold text-teal-600">Rp 6.700.000</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 5 -->
                        <div class="package-card bg-white rounded-2xl overflow-hidden shadow-sm" style="box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <div class="relative h-48 overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1528127269322-539801943592?w=600&h=400&fit=crop" alt="Yogyakarta Culture" class="w-full h-full object-cover">
                                <div class="absolute top-3 right-3 bg-teal-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                    Populer
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Yogyakarta Culture Trip</h3>
                                <div class="flex items-center gap-2 mb-3">
                                    <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">4 Hari 3 Malam</span>
                                </div>
                                <div class="flex items-center gap-2 mb-4">
                                    <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                    <span class="text-sm text-gray-600">Yogyakarta, Indonesia</span>
                                </div>
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <p class="text-xl font-bold text-teal-600">Rp 3.100.000</p>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                        <iconify-icon icon="lucide:star" class="star-icon text-yellow-400 text-base"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                </div>
            </div>
            
            <!-- CTA Button -->
            <div class="px-6">
                <a href="#view-all-packages" id="cta-view-all-btn" class="block w-full bg-teal-600 text-white text-center py-4 rounded-xl font-medium text-base active:bg-teal-700 transition-colors" style="min-height: 44px;">
                    Lihat Semua Paket
                </a>
            </div>
            
        </main>
    </div>
</body>

</html>
