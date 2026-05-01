@php
    // Mengambil data setting dengan cache agar efisien
    $setting = Cache::remember('cafe_setting', 3600, fn() => \App\Models\Setting::first());
    $cafeName = $setting?->business_name ?? 'Lav Cafe';
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Optimization -->
    <title>{{ $cafeName }} | {{ $title ?? 'Tempat Nongkrong Terbaik di Purwokerto' }}</title>
    <meta name="description"
        content="{{ $description ?? 'Lav Cafe adalah tempat nongkrong nyaman dengan sajian kopi dan menu terbaik di Purwokerto. Nikmati suasana modern dan santai bersama kami.' }}">
    <meta name="keywords" content="cafe purwokerto, kopi purwokerto, tempat nongkrong, lav cafe, kuliner purwokerto">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . ($setting?->logo ?? 'default-logo.png')) }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $cafeName }} | {{ $title ?? 'Tempat Nongkrong Terbaik' }}">
    <meta property="og:description"
        content="{{ $description ?? 'Nikmati momen istimewa dengan aroma kopi terbaik di Lav Cafe Purwokerto.' }}">
    <meta property="og:image" content="{{ asset('storage/' . ($setting?->logo ?? 'default-logo.png')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $cafeName }}">
    <meta property="twitter:description" content="Tempat nongkrong nyaman dengan sajian menu terbaik di Purwokerto.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js"></script>

    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-secondary text-dark antialiased font-sans">

    @include('components.navbar')

    <main id="main-content">
        {{ $slot }}
    </main>

    <footer class="bg-dark text-secondary pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <h3 class="font-heading font-bold text-3xl mb-6 text-primary">
                    {{ $cafeName }}
                </h3>
                <p class="text-lg opacity-80 max-w-md leading-relaxed">
                    Tempat nongkrong nyaman dengan sajian menu terbaik di Purwokerto. Kami berkomitmen memberikan
                    pengalaman kuliner yang tak terlupakan.
                </p>
            </div>
            <div>
                <h3 class="font-heading font-bold text-xl mb-6">Navigasi</h3>
                <ul class="space-y-4 opacity-80">
                    <li><a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a></li>
                    <li><a href="{{ route('catalog') }}" class="hover:text-primary transition">Katalog Produk</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Hubungi Kami</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-heading font-bold text-xl mb-6">Kontak & Media</h3>
                <div class="space-y-4 opacity-80 mb-6">
                    <p>Email: {{ $setting?->email ?? 'info@lavcafe.com' }}</p>
                    <p>WhatsApp: +{{ $setting?->whatsapp ?? '628xxx' }}</p>
                </div>
                <div class="flex space-x-6 text-2xl">
                    @if ($setting?->instagram)
                        <a href="{{ $setting->instagram }}" target="_blank"
                            class="text-secondary hover:text-primary transition" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if ($setting?->tiktok)
                        <a href="{{ $setting->tiktok }}" target="_blank"
                            class="text-secondary hover:text-primary transition" aria-label="TikTok">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 mt-20 pt-8 border-t border-secondary/10 text-center opacity-60 text-sm">
            <p>&copy; {{ date('Y') }} {{ $cafeName }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Swiper.js JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>