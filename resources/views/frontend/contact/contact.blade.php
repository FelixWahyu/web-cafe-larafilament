<x-layout>
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h1 class="text-4xl font-bold mb-6 text-pink-600">Hubungi Kami</h1>
                <p class="text-gray-600 mb-8">Punya pertanyaan atau ingin reservasi tempat? Kami siap membantu.</p>

                <div class="space-y-4">
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">📍</span>
                        <p>Purwokerto, Jawa Tengah, Indonesia</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">📞</span>
                        <p>+{{ $setting?->whatsapp }}</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-2xl">📧</span>
                        <p>{{ $setting?->email }}</p>
                    </div>
                </div>

                <div class="mt-10 flex gap-4 text-3xl">
                    <a href="{{ $setting?->instagram }}" class="hover:scale-110 transition">📸</a>
                    <a href="{{ $setting?->tiktok }}" class="hover:scale-110 transition">🎵</a>
                </div>
            </div>

            <div class="rounded-3xl overflow-hidden shadow-lg h-96">
                <iframe src="https://www.google.com/maps/embed?..." width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
</x-layout>