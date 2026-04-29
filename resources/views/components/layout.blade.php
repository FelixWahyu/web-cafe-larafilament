@php
    // Mengambil data setting langsung di layout agar tersedia di semua halaman
    $setting = \App\Models\Setting::first();
    $cafeName = $setting?->business_name ?? 'Lav Cafe';
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cafeName }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#FFF5F5] text-gray-800 antialiased">

    <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <div class="flex-shrink-0 flex items-center gap-3">
                    @if($setting?->logo)
                        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <div class="h-10 w-10 bg-pink-200 rounded-full flex items-center justify-center text-pink-600 font-bold">LC</div>
                    @endif
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-pink-600">{{ $cafeName }}</a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-pink-600 font-medium transition">Home</a>
                    <a href="{{ route('catalog') }}" class="text-gray-600 hover:text-pink-600 font-medium transition">Katalog Produk</a>
                    <a href="{{ route('contact') }}" class="text-gray-600 hover:text-pink-600 font-medium transition">Kontak</a>
                </div>

                <div class="flex items-center">
                    <a href="#" class="relative p-2 text-gray-600 hover:text-pink-600 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="absolute top-0 right-0 bg-pink-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-pink-100 text-pink-900 mt-16 py-10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h3 class="font-bold text-xl mb-4">{{ $cafeName }}</h3>
                <p class="text-sm opacity-80">Tempat nongkrong nyaman dengan sajian menu terbaik di Purwokerto.</p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Kontak Kami</h3>
                <p class="text-sm opacity-80">Email: {{ $setting?->email ?? 'info@lavcafe.com' }}</p>
                <p class="text-sm opacity-80 mt-2">WA: +{{ $setting?->whatsapp ?? '628xxx' }}</p>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Sosial Media</h3>
                <div class="flex justify-center md:justify-start space-x-4">
                    @if($setting?->instagram) <a href="{{ $setting->instagram }}" target="_blank" class="hover:text-pink-600 font-medium">Instagram</a> @endif
                    @if($setting?->tiktok) <a href="{{ $setting->tiktok }}" target="_blank" class="hover:text-pink-600 font-medium">TikTok</a> @endif
                </div>
            </div>
        </div>
    </footer>

</body>
</html>