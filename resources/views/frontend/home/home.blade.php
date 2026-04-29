<x-layout>
    <section class="relative h-[80vh] md:h-screen flex items-center justify-center overflow-hidden">

        @if ($setting?->hero_video)
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                <source src="{{ asset('storage/' . $setting->hero_video) }}" type="video/mp4">
            </video>
        @else
            <div class="absolute inset-0 w-full h-full bg-linnear-to-br from-pink-300 to-purple-400 z-0"></div>
        @endif

        <div class="absolute inset-0 bg-black/40 z-10"></div>

        <div class="relative z-20 text-center text-white p-6 md:p-10 rounded-2xl">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">{{ $setting?->business_name ?? 'Lav Cafe' }}
            </h1>
            <p class="text-lg md:text-2xl mb-8 drop-shadow-md font-light">Nikmati momen istimewa dengan aroma kopi
                terbaik.</p>
            <a href="{{ route('catalog') }}"
                class="inline-block bg-pink-500 hover:bg-pink-600 px-8 py-3 rounded-full font-bold transition shadow-lg hover:shadow-pink-500/50 hover:-translate-y-1">
                Pesan Sekarang
            </a>
        </div>
    </section>

    @if ($banners->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-10">Promo Spesial Mingguan</h2>
                <div class="flex overflow-x-auto gap-6 snap-x no-scrollbar">
                    @foreach ($banners as $banner)
                        <div class="min-w-75 md:min-w-150 snap-center">
                            <img src="{{ asset('storage/' . $banner->image_path) }}"
                                class="rounded-3xl shadow-lg w-full h-80 object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-16 bg-pink-50">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12">Layanan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 bg-white rounded-2xl shadow-sm">
                    <div class="text-pink-500 text-4xl mb-4">☕</div>
                    <h3 class="font-bold text-xl mb-2">Dine In</h3>
                    <p class="text-gray-500">Suasana nyaman dengan musik pilihan untuk bekerja atau bersantai.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white relative" x-data="{ showModal: false }">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-4">
                <h2 class="text-3xl font-bold text-gray-800">Kata Mereka</h2>
                <button @click="showModal = true"
                    class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-full font-bold transition shadow-md">
                    + Beri Ulasan
                </button>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="swiper reviewSwiper pb-12">
                <div class="swiper-wrapper">
                    @forelse(\App\Models\GeneralReview::where('is_approved', true)->latest()->get() as $rev)
                        <div class="swiper-slide h-auto">
                            <div
                                class="p-8 bg-pink-50 rounded-3xl h-full flex flex-col border border-pink-100 shadow-sm transition hover:shadow-md">

                                <div class="flex items-center gap-4 mb-5">
                                    <div
                                        class="w-12 h-12 shrink-0 rounded-full bg-pink-200 text-pink-600 flex items-center justify-center font-extrabold text-xl shadow-inner uppercase">
                                        {{ substr($rev->name, 0, 1) }}
                                    </div>

                                    <h3 class="font-bold text-pink-600 text-lg">{{ $rev->name }}</h3>
                                </div>

                                <p class="italic text-gray-700 leading-relaxed">"{{ $rev->review }}"</p>

                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center py-10 text-gray-500">Belum ada ulasan yang disetujui. Jadilah
                            yang pertama!</div>
                    @endforelse
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <div x-show="showModal"
            class="fixed inset-0 z-100 flex items-center justify-center bg-black/50 backdrop-blur-sm"
            x-transition.opacity style="display: none;">
            <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-lg mx-4 relative"
                @click.away="showModal = false">
                <button @click="showModal = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl">&times;</button>

                <h3 class="text-2xl font-bold mb-6 text-gray-800">Bagikan Pengalamanmu</h3>

                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Anda</label>
                        <input type="text" name="name" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none"
                            placeholder="Masukkan nama...">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Ulasan</label>
                        <textarea name="review" rows="4" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none"
                            placeholder="Tuliskan komentar Anda di sini..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-pink-500 text-white font-bold py-3 rounded-xl hover:bg-pink-600 transition shadow-lg">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var swiper = new Swiper(".reviewSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        // Jika ukuran layar >= 768px (Tablet/Desktop), tampilkan 3 card
                        768: {
                            slidesPerView: 2,
                            spaceBetween: 30,
                        },
                        1024: {
                            slidesPerView: 3,
                            spaceBetween: 30,
                        },
                    },
                });
            });
        </script>
    </section>
</x-layout>
