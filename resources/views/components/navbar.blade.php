<nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <div class="flex-shrink-0 flex items-center gap-3">
                @if($setting?->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo"
                        class="h-10 w-10 rounded-full object-cover">
                @else
                    <div
                        class="h-10 w-10 bg-pink-200 rounded-full flex items-center justify-center text-pink-600 font-bold">
                        LC</div>
                @endif
                <a href="{{ route('home') }}" class="text-2xl font-bold text-pink-600">{{ $cafeName }}</a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-pink-600 font-medium transition">Home</a>
                <a href="{{ route('catalog') }}"
                    class="text-gray-600 hover:text-pink-600 font-medium transition">Katalog Produk</a>
                <a href="{{ route('contact') }}"
                    class="text-gray-600 hover:text-pink-600 font-medium transition">Kontak</a>
            </div>

            <div class="flex items-center">
                <a href="#" class="relative p-2 text-gray-600 hover:text-pink-600 transition">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span
                        class="absolute top-0 right-0 bg-pink-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">0</span>
                </a>
            </div>

        </div>
    </div>
</nav>