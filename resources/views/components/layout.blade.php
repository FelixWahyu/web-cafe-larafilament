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

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#FFF5F5] text-gray-800 antialiased">

    @include('navbar')
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
                    @if($setting?->instagram) <a href="{{ $setting->instagram }}" target="_blank"
                    class="hover:text-pink-600 font-medium">Instagram</a> @endif
                    @if($setting?->tiktok) <a href="{{ $setting->tiktok }}" target="_blank"
                    class="hover:text-pink-600 font-medium">TikTok</a> @endif
                </div>
            </div>
        </div>
    </footer>

</body>

</html>