<!DOCTYPE html>

<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Editorial Agronomy | Agricultural Decision Support System</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&amp;family=Manrope:wght@600;700;800&amp;display=swap" rel="stylesheet"/>
    <!-- Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
            tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                "colors": {
                        "secondary-fixed": "#ffdbcf",
                        "inverse-on-surface": "#f1f1ed",
                        "on-secondary-fixed": "#2e150b",
                        "surface-dim": "#dadad6",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed-variant": "#603f33",
                        "inverse-surface": "#2f312e",
                        "primary-container": "#3a7b3a",
                        "surface": "#faf9f5",
                        "on-surface": "#1a1c1a",
                        "tertiary-fixed-dim": "#84d5c5",
                        "surface-tint": "#2a6b2c",
                        "surface-container-low": "#f4f4f0",
                        "on-background": "#1a1c1a",
                        "on-tertiary-fixed": "#00201b",
                        "outline-variant": "#bfcaba",
                        "surface-container-highest": "#e2e3df",
                        "secondary-container": "#fdcdbc",
                        "error-container": "#ffdad6",
                        "tertiary-container": "#227a6c",
                        "on-error": "#ffffff",
                        "surface-bright": "#faf9f5",
                        "on-tertiary-fixed-variant": "#005046",
                        "on-secondary-container": "#795548",
                        "primary": "#206223",
                        "on-tertiary": "#ffffff",
                        "inverse-primary": "#91d78a",
                        "surface-variant": "#e2e3df",
                        "on-primary-fixed-variant": "#0c5216",
                        "tertiary": "#006054",
                        "tertiary-fixed": "#a0f2e1",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "background": "#faf9f5",
                        "secondary-fixed-dim": "#ebbcac",
                        "surface-container": "#eeeeea",
                        "surface-container-high": "#e8e8e4",
                        "outline": "#707a6c",
                        "primary-fixed-dim": "#91d78a",
                        "on-primary-container": "#cbffc2",
                        "on-primary": "#ffffff",
                        "on-surface-variant": "#40493d",
                        "on-tertiary-container": "#b6ffef",
                        "on-primary-fixed": "#002203",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#7a5649",
                        "primary-fixed": "#acf4a4"
                },
                "borderRadius": {
                        "DEFAULT": "0.5rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
                        "full": "9999px"
                },
                "fontFamily": {
                        "headline": ["Manrope"],
                        "body": ["Inter"],
                        "label": ["Inter"]
                }
                },
            }
            }
    </script>
    <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .editorial-asymmetry {
                margin-left: clamp(1rem, 5vw, 4rem);
            }
            .seed-button {
                transition: transform 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }
            .seed-button:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(32, 98, 35, 0.12);
            }
            /* ========== ANIMASI & EFEK BARU (KHUSUS ABOUT TANAMAN) ========== */
            .card-tanaman {
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .card-tanaman:hover {
                transform: translateY(-12px);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            }
            .card-tanaman:hover .tanaman-img {
                transform: scale(1.1);
            }
            .tanaman-img {
                transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .glass-badge {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
            }
            .spec-icon {
                transition: transform 0.2s ease;
            }
            .card-tanaman:hover .spec-icon {
                transform: scale(1.2);
            }
            .progress-bar {
                transition: width 1s ease-in-out;
            }
            .card-tanaman:hover .progress-bar-tomat {
                width: 85%;
            }
            .card-tanaman:hover .progress-bar-cabai {
                width: 75%;
            }
            .card-tanaman:hover .progress-bar-kangkung {
                width: 95%;
            }
            @keyframes floatSlow {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            .animate-float-slow {
                animation: floatSlow 5s ease-in-out infinite;
            }
    </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
    <header class="fixed top-0 w-full z-50 bg-[#faf9f5]/80 dark:bg-[#1a1c1a]/80 backdrop-blur-md shadow-sm dark:shadow-none">
        <nav class="flex justify-between items-center px-8 py-4 max-w-screen-2xl mx-auto font-['Manrope'] tracking-tight">
            <div class="flex items-center gap-8">
                <span class="text-2xl font-bold text-[#206223] dark:text-[#3a7b3a]"> Rekomendasi Tanam </span>
            </div>
        </nav>
    </header>
    <main class="pt-24">
    <!-- Hero Section (TIDAK DIUBAH) -->
        <section class="relative min-h-[716px] flex items-center px-8 max-w-screen-2xl mx-auto overflow-hidden">
            <div class="grid lg:grid-cols-2 gap-12 items-center w-full">
                <div class="z-10 editorial-asymmetry space-y-6">
                    <span class="inline-block bg-primary-fixed-dim text-on-primary-fixed-variant px-4 py-1 rounded-full text-xs font-bold tracking-wider uppercase">SAHABAT PETANI MODERN</span>
                    <h1 class="font-headline text-5xl md:text-7xl font-extrabold tracking-tight text-on-surface leading-[1.1]">
                                            Tanam Cerdas, <span class="text-primary italic"> Panen Sukses </span>
                    </h1>
                            <p class="text-lg text-on-surface-variant max-w-lg leading-relaxed">
                                Temukan rekomendasi tanaman terbaik dan prediksi panen akurat dengan didukung oleh data cuaca dan analisis canggih. Buat keputusan tanam yang tepat untuk hasil maksimal...
                            </p>
                    <div class="flex gap-4">
                        <a class="bg-primary text-on-primary px-8 py-4 rounded-lg font-bold seed-button flex items-center gap-2" href="#tools">
                            Jelajahi Fitur
                            <span class="material-symbols-outlined text-sm" data-icon="arrow_downward">arrow_downward</span>
                        </a>
                    </div>
                </div>
                <div class="relative h-[500px] lg:h-[600px] rounded-3xl overflow-hidden shadow-2xl">
                    <div class="absolute inset-0 w-full h-full" id="hero-slider">
                        
                        <!-- Slide 1 -->
                        <div class="slide absolute inset-0 opacity-100 transition-opacity duration-1000">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMc2yCsihz5Vi9vdskRFattsDaDu1jzShJnnC8_8bSIR07es49BDqHYsqRlmmjs2Ywhj9UQQgNKeI62Sm8tAsUZDMpAtufp3t3DBJUrITokXH49FAhW7WPXjFHi5vqugesM0sCo-mpQdHxuy4S5CgO9ZmXDPgrhrxM8xM-Em0IVZ3-4PgNZjgp4xSsxX4eT0eS4pTHSP7bhJgwf_3v_LA1DLzF4RIUhM1tnUEaVAktRNNPbcPPlsKqL4rhE0D9hgvY4LqmiLjBI0kd" 
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/30"></div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                            <img src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?q=80&w=2000&auto=format&fit=crop" 
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/30"></div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ">
                           <img src="{{ asset('images/kangkung.png') }}" alt="Kangkung" class="w-full h-full object-cover">                           
                            <div class="absolute inset-0 bg-black/30"></div>
                        </div>

                        <!-- DOT -->
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                            <button class="dot w-2 h-2 bg-white/80 rounded-full" onclick="goToSlide(0)"></button>
                            <button class="dot w-2 h-2 bg-white/40 rounded-full" onclick="goToSlide(1)"></button>
                            <button class="dot w-2 h-2 bg-white/40 rounded-full" onclick="goToSlide(2)"></button>
                        </div>
                    </div>    
                    <div class="absolute bottom-8 left-8 right-8 p-6 bg-surface/90 backdrop-blur-md rounded-2xl border border-outline-variant/10">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary-container/20 rounded-full flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined" data-icon="eco">eco</span>
                                </div>
                                    <div>
                                        <p class="text-xs font-bold uppercase text-primary tracking-widest"> SISTEM PREDIKSI </p>
                                        <p class="text-on-surface font-headline font-bold">Tanaman Tumbuh Subur</p>
                                    </div>
                            </div>
                        </div>
                </div>
            </div>
            <!-- Decorative Element -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/5 rounded-full blur-3xl -z-10"></div>
        </section>
    <!-- Tool Grid Section (TIDAK DIUBAH) -->
    <section class="py-24 px-8 bg-surface-container-low" id="tools">
        <div class="max-w-screen-2xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8">

                <!-- Crop Recommendation Card -->
                <div class="bg-surface-container-lowest p-10 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-8">
                        <div class="h-14 w-14 bg-primary-container text-on-primary-container rounded-2xl flex items-center justify-center shadow-lg shadow-primary/10">
                        <span class="material-symbols-outlined text-3xl" data-icon="potted_plant">potted_plant</span>
                        </div>
                        <span class="text-xs font-label uppercase tracking-widest text-outline"> Sistem Rekomendasi</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Rekomendasi Tanaman</h3>
                    <p class="text-on-surface-variant mb-10">Dapatkan rekomendasi tanaman yang paling cocok untuk kondisi Cuaca waktu tanam sampai panen Anda.</p>
                    
                    <form class="space-y-6">
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold uppercase text-outline tracking-wider">Pilih Bulan Tanam</label>
                                <select id="bulanTanam" class="w-full bg-surface-container-low border-none rounded-xl p-4 focus:ring-2 focus:ring-primary transition-all font-medium appearance-none">
                                    <option >Pilih Bulan Tanam</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>

                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-xs font-bold uppercase text-outline tracking-wider">Pilih Bulan Panen</label>
                                <select id="bulanPanen" class="w-full bg-surface-container-low border-none rounded-xl p-4 focus:ring-2 focus:ring-primary transition-all font-medium appearance-none">
                                        <option>Pilih Bulan Panen</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                            <button type="button" onclick="getRecommendation()" class="w-full bg-primary text-on-primary py-4 rounded-xl font-bold">
                                <span>Rekomendasikan Tanaman</span>
                                
                            </button>
                            <div id="cropResult" class="hidden mt-8 p-6 rounded-2xl bg-surface-container border border-outline-variant/20">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="font-bold text-lg">Rekomendasi Tanaman</h4>
                                    <span id="cropBadge" class="text-xs px-3 py-1 rounded-full bg-primary text-white">Rekomendasi</span>
                                </div>

                                <p id="cropText" class="text-on-surface font-medium text-lg mb-2"></p>
                                <p id="cropInsight" class="text-sm text-on-surface-variant"></p>
                            </div>
                    </form>
                </div>
                <!-- Harvest Prediction Card (TIDAK DIUBAH) -->
                <div class="bg-surface-container-lowest p-10 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start justify-between mb-8">
                        <div class="h-14 w-14 bg-secondary-container text-on-secondary-container rounded-2xl flex items-center justify-center shadow-lg shadow-secondary/10">
                            <span class="material-symbols-outlined text-3xl" data-icon="event_upcoming">event_upcoming</span>
                        </div>
                        <span class="text-xs font-label uppercase tracking-widest text-outline">Prediksi Panen</span>
                    </div>
                    <h3 class="font-headline text-2xl font-bold mb-4">Prediksi Panen</h3>
                    <p class="text-on-surface-variant mb-10">Hitung garis waktu panen yang akurat dan rekomendasi tanaman dengan cuaca terbaik.</p>
                    <form class="space-y-6">
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block text-xs font-bold uppercase text-outline tracking-wider">Pilih tanaman</label>
                                <select id="tanaman" class="w-full bg-surface-container-low border-none rounded-xl p-4 focus:ring-2 focus:ring-primary transition-all font-medium appearance-none">
                                <option value=""> Pilih Tanaman </option>
                                <option value="kangkung"> Kangkung </option>
                                <option value="tomat"> Tomat</option>
                                <option value="cabai"> Cabai </option>
                                </select>
                            </div>
                                <div class="space-y-2">
                                    <label class="block text-xs font-bold uppercase text-outline tracking-wider">Tanggal Tanam</label>
                                    <input class="w-full bg-surface-container-low border-none rounded-xl p-4 focus:ring-2 focus:ring-primary transition-all font-medium" type="date"/>
                                </div>
                        </div>
                        <button type="button" onclick="predictHarvest()" class="w-full bg-secondary text-on-secondary py-4 rounded-xl font-bold seed-button flex items-center justify-center gap-2 group" type="button">
                            <span>Prediksi Panen</span>
                            <span class="material-symbols-outlined transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
                        </button>
                        
                    </form>
                    <div id="harvestResult" class="hidden mt-8 p-6 rounded-2xl bg-surface-container border border-outline-variant/20">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-bold text-lg">Prediksi Panen</h4>
                            <span id="harvestBadge" class="text-xs px-3 py-1 rounded-full bg-primary text-white">Optimal</span>
                        </div>

                        <p id="harvestText" class="text-on-surface font-medium text-lg mb-2"></p>
                        <p id="harvestInsight" class="text-sm text-on-surface-variant"></p>
                    </div>
                </div>
            </div>
            </div>
            </section>

            <!-- ============================================ -->
            <!-- ABOUT TANAMAN SECTION (YANG DIUBAH TOTAL)    -->
            <!-- ============================================ -->
            <section class="relative py-24 px-8 bg-gradient-to-b from-green-50/50 via-white to-surface-container-low overflow-hidden" id="about">
                
                <!-- Decorative Background Elements -->
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
                    <div class="absolute top-20 right-10 w-72 h-72 bg-primary/5 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-20 left-10 w-96 h-96 bg-tertiary/5 rounded-full blur-3xl"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-primary/3 rounded-full blur-3xl"></div>
                </div>

                <!-- Section Header -->
                <div class="max-w-screen-xl mx-auto text-center mb-16">
                    <span class="inline-block bg-primary-fixed-dim text-on-primary-fixed-variant px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase mb-4">
                        Kenali Tanaman
                    </span>
                    <h2 class="font-headline text-4xl md:text-5xl font-extrabold text-on-surface mb-4">
                        Sistem Rekomendasi <span class="text-primary italic">Tanaman</span>
                    </h2>
                    <p class="text-on-surface-variant max-w-2xl mx-auto text-base leading-relaxed">
                        Sistem cerdas berbasis data cuaca untuk menentukan tanaman terbaik dengan hasil panen optimal. 
                        Pilih tanaman yang sesuai dengan kondisi lingkungan dan kebutuhan pasar Anda.
                    </p>
                </div>

                <!-- Plant Cards Grid - TIGA KOLOM -->
                <div class="grid md:grid-cols-3 gap-8 lg:gap-10 max-w-screen-xl mx-auto">

                    <!-- ============================================ -->
                    <!-- CARD 1: TOMAT                               -->
                    <!-- ============================================ -->
                    <div class="card-tanaman group bg-white rounded-3xl shadow-md overflow-hidden border border-outline-variant/10 flex flex-col">
                        <!-- Image Container -->
                        <div class="relative h-52 overflow-hidden bg-gradient-to-br from-red-50 to-orange-50">
                            <img src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?q=80&w=600&auto=format&fit=crop"
                                 alt="Tomat"
                                 class="w-full h-full object-cover tanaman-img">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            <!-- Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="glass-badge text-red-700 px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1">
                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                    Nilai Ekonomis Tinggi
                                </span>
                            </div>
                            <!-- Nama Tanaman di Atas Gambar -->
                            <div class="absolute bottom-4 left-4">
                                <h3 class="font-headline text-2xl font-extrabold text-white drop-shadow-lg">Tomat</h3>
                                <p class="text-white/80 text-xs font-medium">Solanum lycopersicum</p>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-on-surface-variant text-sm mb-5 leading-relaxed">
                                Cocok pada suhu sedang dengan kelembaban stabil. Memiliki nilai ekonomis tinggi dan permintaan pasar yang konsisten sepanjang tahun.
                            </p>

                            <!-- Spesifikasi Detail -->
                            <div class="space-y-3 mb-5 bg-surface-container-low rounded-2xl p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-red-500 text-lg spec-icon">thermostat</span>
                                        <span class="text-xs text-on-surface-variant">Suhu Ideal</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">15°C - 28°C</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-red-400 to-red-500 h-1.5 rounded-full progress-bar progress-bar-tomat" style="width: 70%;"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-blue-500 text-lg spec-icon">water_drop</span>
                                        <span class="text-xs text-on-surface-variant">Kelembaban</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">60% - 80%</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-blue-400 to-blue-500 h-1.5 rounded-full progress-bar" style="width: 65%;"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-green-500 text-lg spec-icon">schedule</span>
                                        <span class="text-xs text-on-surface-variant">Umur Panen</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">75 Hari</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-green-400 to-green-500 h-1.5 rounded-full progress-bar" style="width: 75%;"></div>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mt-auto">
                                <span class="text-xs bg-red-50 text-red-700 px-3 py-1.5 rounded-full font-medium">🌡️ Suhu Sedang</span>
                                <span class="text-xs bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full font-medium">💧 Kelembaban Stabil</span>
                                <span class="text-xs bg-green-50 text-green-700 px-3 py-1.5 rounded-full font-medium">📈 Profit Tinggi</span>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================ -->
                    <!-- CARD 2: CABAI                               -->
                    <!-- ============================================ -->
                    <div class="card-tanaman group bg-white rounded-3xl shadow-md overflow-hidden border border-outline-variant/10 flex flex-col">
                        <!-- Image Container -->
                        <div class="relative h-52 overflow-hidden bg-gradient-to-br from-red-100 to-yellow-50">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMc2yCsihz5Vi9vdskRFattsDaDu1jzShJnnC8_8bSIR07es49BDqHYsqRlmmjs2Ywhj9UQQgNKeI62Sm8tAsUZDMpAtufp3t3DBJUrITokXH49FAhW7WPXjFHi5vqugesM0sCo-mpQdHxuy4S5CgO9ZmXDPgrhrxM8xM-Em0IVZ3-4PgNZjgp4xSsxX4eT0eS4pTHSP7bhJgwf_3v_LA1DLzF4RIUhM1tnUEaVAktRNNPbcPPlsKqL4rhE0D9hgvY4LqmiLjBI0kd"
                                 alt="Cabai"
                                 class="w-full h-full object-cover tanaman-img">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            <!-- Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="glass-badge text-orange-700 px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                                    Sensitif Hujan
                                </span>
                            </div>
                            <!-- Nama Tanaman -->
                            <div class="absolute bottom-4 left-4">
                                <h3 class="font-headline text-2xl font-extrabold text-white drop-shadow-lg">Cabai</h3>
                                <p class="text-white/80 text-xs font-medium">Capsicum annuum</p>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-on-surface-variant text-sm mb-5 leading-relaxed">
                                Membutuhkan suhu hangat dan sinar matahari cukup. Sensitif terhadap hujan tinggi, sangat cocok ditanam pada musim kemarau.
                            </p>

                            <!-- Spesifikasi Detail -->
                            <div class="space-y-3 mb-5 bg-surface-container-low rounded-2xl p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-orange-500 text-lg spec-icon">thermostat</span>
                                        <span class="text-xs text-on-surface-variant">Suhu Ideal</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">15°C - 28°C</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-orange-400 to-orange-500 h-1.5 rounded-full progress-bar progress-bar-cabai" style="width: 65%;"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-yellow-500 text-lg spec-icon">water_drop</span>
                                        <span class="text-xs text-on-surface-variant">Kelembaban</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">60% - 80%</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-1.5 rounded-full progress-bar" style="width: 60%;"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-red-500 text-lg spec-icon">schedule</span>
                                        <span class="text-xs text-on-surface-variant">Umur Panen</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">75 Hari</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-red-400 to-red-500 h-1.5 rounded-full progress-bar" style="width: 75%;"></div>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mt-auto">
                                <span class="text-xs bg-orange-50 text-orange-700 px-3 py-1.5 rounded-full font-medium">☀️ Suhu Hangat</span>
                                <span class="text-xs bg-yellow-50 text-yellow-700 px-3 py-1.5 rounded-full font-medium">🔆 Sinar Matahari Penuh</span>
                                <span class="text-xs bg-red-50 text-red-700 px-3 py-1.5 rounded-full font-medium">🌧️ Anti Hujan Tinggi</span>
                            </div>
                        </div>
                    </div>

                    <!-- ============================================ -->
                    <!-- CARD 3: KANGKUNG                           -->
                    <!-- ============================================ -->
                    <div class="card-tanaman group bg-white rounded-3xl shadow-md overflow-hidden border border-outline-variant/10 flex flex-col">
                        <!-- Image Container -->
                        <div class="relative h-52 overflow-hidden bg-gradient-to-br from-green-50 to-emerald-50">
                            <img src="{{ asset('images/kangkung.png') }}"
                                 alt="Kangkung"
                                 class="w-full h-full object-cover tanaman-img">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            <!-- Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="glass-badge text-green-700 px-3 py-1.5 rounded-full text-xs font-bold flex items-center gap-1">
                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                    Panen Singkat
                                </span>
                            </div>
                            <!-- Nama Tanaman -->
                            <div class="absolute bottom-4 left-4">
                                <h3 class="font-headline text-2xl font-extrabold text-white drop-shadow-lg">Kangkung</h3>
                                <p class="text-white/80 text-xs font-medium">Ipomoea aquatica</p>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6 flex flex-col flex-1">
                            <p class="text-on-surface-variant text-sm mb-5 leading-relaxed">
                                Tumbuh cepat di lingkungan lembab. Cocok untuk panen singkat, dapat dipanen berkali-kali dalam satu kali tanam.
                            </p>

                            <!-- Spesifikasi Detail -->
                            <div class="space-y-3 mb-5 bg-surface-container-low rounded-2xl p-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-green-500 text-lg spec-icon">thermostat</span>
                                        <span class="text-xs text-on-surface-variant">Suhu Ideal</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">15°C - 30°C</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-green-400 to-green-500 h-1.5 rounded-full progress-bar progress-bar-kangkung" style="width: 80%;"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-emerald-500 text-lg spec-icon">water_drop</span>
                                        <span class="text-xs text-on-surface-variant">Kelembaban</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">60% - 90%</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-1.5 rounded-full progress-bar" style="width: 85%;"></div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-teal-500 text-lg spec-icon">schedule</span>
                                        <span class="text-xs text-on-surface-variant">Umur Panen</span>
                                    </div>
                                    <span class="text-xs font-bold text-on-surface">30 Hari</span>
                                </div>
                                <div class="w-full bg-surface-container-high rounded-full h-1.5">
                                    <div class="bg-gradient-to-r from-teal-400 to-teal-500 h-1.5 rounded-full progress-bar" style="width: 95%;"></div>
                                </div>
                            </div>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mt-auto">
                                <span class="text-xs bg-green-50 text-green-700 px-3 py-1.5 rounded-full font-medium">💧 Lembab</span>
                                <span class="text-xs bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full font-medium">⚡ Tumbuh Cepat</span>
                                <span class="text-xs bg-teal-50 text-teal-700 px-3 py-1.5 rounded-full font-medium">🔄 Panen Berkali</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Additional Info Banner -->
                <div class="max-w-screen-xl mx-auto mt-16">
                    <div class="bg-primary/5 border border-primary/10 rounded-3xl p-8 md:p-10 flex flex-col md:flex-row items-center gap-6">
                        <div class="w-16 h-16 bg-primary-container/30 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-3xl text-primary">lightbulb</span>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="font-headline font-bold text-lg text-on-surface mb-1">Tips Memilih Tanaman</h4>
                            <p class="text-sm text-on-surface-variant">
                                Gunakan fitur <strong>Rekomendasi Tanaman</strong> untuk mengetahui tanaman terbaik berdasarkan bulan tanam dan panen. 
                                Fitur <strong>Prediksi Panen</strong> akan membantu Anda menghitung estimasi waktu panen dan mengevaluasi kesesuaian cuaca.
                            </p>
                        </div>
                        <a href="#tools" class="bg-primary text-on-primary px-6 py-3 rounded-xl font-bold seed-button flex items-center gap-2 flex-shrink-0">
                            <span>Coba Sekarang</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </a>
                    </div>
                </div>

            </section>

    <!-- Footer (TIDAK DIUBAH) -->
    <footer class="bg-[#faf9f5] dark:bg-[#1a1c1a] w-full py-12 px-8 font-['Inter'] text-sm">
        
        <div class="max-w-screen-2xl mx-auto mt-12 pt-8 border-t border-outline-variant/10 text-center text-[#7a5649]">
                    © 2026 SISTEM PENDUKUNG KEPUTUSAN REKOMENDASI WAKTU TANAM UNTUK TANAMAN CABAI, TOMAT, DAN KANGKUNG MENGGUNAKAN METODE LOGIKA FUZZY. 
        </div>
    </footer>


    <!-- JavaScript (TIDAK DIUBAH) -->
    <script>

        async function getRecommendation() {

            const tanam = document.getElementById("bulanTanam").value;
            const panen = document.getElementById("bulanPanen").value;

            if (!tanam || !panen) {
                alert("Lengkapi input!");
                return;
            }

            try {
                const response = await fetch('/recommend', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        tanam: parseInt(tanam),
                        panen: parseInt(panen)
                    })
                });

                // 🔥 TAMBAHAN PENTING
                if (!response.ok) {
                    const text = await response.text();
                    console.error("Response error:", text);
                    throw new Error("Server error");
                }

                const data = await response.json();

                console.log("DATA:", data); // DEBUG

                if (data.error) {
                    alert(data.error);
                    return;
                }

                document.getElementById("cropResult").classList.remove("hidden");
                document.getElementById("cropText").innerText =
                    "Tanaman: " + data.rekomendasi.join(", ").toUpperCase();

                document.getElementById("cropInsight").innerText =
                    `Suhu: ${data.cuaca.suhu}°C
                Kelembaban: ${data.cuaca.kelembaban}%
                Curah hujan: ${data.cuaca.hujan} mm

                Umur Panen: ${data.umur_panen ?? '-'} hari
                Estimasi Panen: ${data.tanggal_panen ?? '-'}`;

            } catch (error) {
                console.error("ERROR:", error);
                alert("Server error / koneksi gagal. Cek console!");
            }
        }



        async function predictHarvest() {

            const crop = document.getElementById("tanaman").value;
            const date = document.querySelector("input[type='date']").value;

            if (!crop || !date) {
                alert("Lengkapi input!");
                return;
            }

            const response = await fetch('/predict-harvest', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    tanaman: crop,
                    tanggal: date
                })
            });

            const data = await response.json();

            // 🔥 HANDLE ERROR
            if (data.error) {
                alert(data.error);
                return;
            }

            const resultBox = document.getElementById("harvestResult");
            const insightBox = document.getElementById("harvestInsight");

            // RESET isi biar tidak numpuk
            insightBox.innerText = "";

            document.getElementById("harvestText").innerText =
                `Panen: ${data.tanggal_panen}`;

            insightBox.innerText =
                `Umur: ${data.umur} hari dari masa tanam
                Status: ${data.status}
        ${data.rekomendasi}`;

            // 🔥 TAMBAHAN (yang sebelumnya tidak kepakai)
            if (data.alternatif_tanaman?.length) {
                insightBox.innerText +=
                    `\n\nAlternatif tanaman:\n${data.alternatif_tanaman.join(", ")}`;
            }

            if (data.bulan_terbaik?.length) {
                insightBox.innerText +=
                    `\n\nBulan tanam terbaik:\n${data.bulan_terbaik.join(", ")}`;
            }

            resultBox.classList.remove("hidden");
        }

        //slider
        document.addEventListener("DOMContentLoaded", function () {

            let currentSlide = 0;
            const slides = document.querySelectorAll('#hero-slider .slide');
            const dots = document.querySelectorAll('#hero-slider .dot');

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });

                dots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white/80', i === index);
                    dot.classList.toggle('bg-white/40', i !== index);
                });

                currentSlide = index;
            }

            function nextSlide() {
                let next = (currentSlide + 1) % slides.length;
                showSlide(next);
            }

            window.goToSlide = function(index) {
                clearInterval(interval);
                showSlide(index);
                interval = setInterval(nextSlide, 4000);
            }

            let interval = setInterval(nextSlide, 4000);
            showSlide(0);

        });

       
    </script>
</body>
</html>