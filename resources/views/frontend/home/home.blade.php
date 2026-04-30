<x-layout>
    <x-slot:title>Home</x-slot:title>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        @if ($setting?->hero_video)
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover z-0">
                <source src="{{ asset('storage/' . $setting->hero_video) }}" type="video/mp4">
            </video>
        @else
            <div class="absolute inset-0 w-full h-full bg-linear-to-br from-primary to-accent z-0"></div>
        @endif

        <div class="absolute inset-0 bg-dark/40 backdrop-blur-[2px] z-10"></div>

        <div class="relative z-20 text-left container text-surface px-6 w-full left-6 right-6">
            <span
                class="inline-block px-4 py-1.5 rounded-full bg-primary/20 text-primary font-bold text-sm mb-6 border border-primary/30 tracking-widest uppercase">
                Welcome to {{ $setting->business_name }}
            </span>
            <h1 class="text-5xl md:text-7xl font-heading font-bold mb-8 leading-tight drop-shadow-2xl text-left">
                Nikmati Momen Istimewa dengan <span class="text-primary">Aroma Kopi</span> Terbaik
            </h1>
            <p class="text-xl md:text-2xl mb-12 opacity-90 font-light max-w-2xl text-left leading-relaxed">
                Tempat nongkrong paling nyaman di Purwokerto dengan suasana modern dan sajian kopi pilihan.
            </p>
            <div class="flex flex-col sm:flex-row items-start md:items-center gap-6">
                <a href="{{ route('catalog') }}"
                    class="group relative inline-flex items-center justify-center bg-primary text-surface px-10 py-4 rounded-full font-bold transition-all shadow-xl hover:shadow-primary/40 hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10">Pesan Sekarang</span>
                    <div
                        class="absolute inset-0 bg-white/20 translate-x-full group-hover:translate-x-0 transition-transform duration-300">
                    </div>
                </a>
                <a href="#services"
                    class="text-surface hover:text-primary font-bold transition-colors bg-gray-50/30 backdrop-blur-md rounded-full px-10 py-4 flex items-center gap-2 hover:bg-gray-50/70">
                    Lihat Layanan
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    @if ($banners->count() > 0)
        <section class="py-24 bg-white overflow-hidden">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-end justify-between mb-16">
                    <div>
                        <h2 class="text-4xl font-heading font-bold text-dark mb-4">Promo Spesial</h2>
                        <p class="text-dark/60">Jangan lewatkan penawaran menarik kami minggu ini.</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="flex overflow-x-auto gap-8 pb-8 snap-x no-scrollbar scroll-smooth">
                        @foreach ($banners as $banner)
                            <div class="min-w-75 md:min-w-150 snap-center group">
                                <div class="relative overflow-hidden rounded-lg shadow-2xl aspect-video">
                                    <img src="{{ asset('storage/' . $banner->image_path) }}"
                                        alt="Promo {{ $loop->iteration }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-linear-to-t from-dark/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-10">
                                        <div class="text-surface">
                                            <h3 class="text-2xl font-bold mb-2">Penawaran Eksklusif</h3>
                                            <p class="opacity-80">Klik untuk melihat detail menu promo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Services Section -->
    <section id="services" class="py-24 bg-secondary relative">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-heading font-bold text-dark mb-6">Mengapa Memilih Kami?</h2>
                <div class="w-20 h-1.5 bg-primary mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    class="group p-10 bg-surface rounded-lg shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-dark/5 text-center">
                    <div
                        class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary text-4xl mb-8 mx-auto group-hover:bg-primary group-hover:text-surface transition-colors duration-500">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <h3 class="font-heading font-bold text-2xl mb-4 text-dark">Kualitas Premium</h3>
                    <p class="text-dark/60 leading-relaxed">Biji kopi pilihan yang dipanggang dengan
                        sempurna untuk rasa yang autentik.</p>
                </div>

                <div
                    class="group p-10 bg-surface rounded-lg shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-dark/5 text-center">
                    <div
                        class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary text-4xl mb-8 mx-auto group-hover:bg-primary group-hover:text-surface transition-colors duration-500">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3 class="font-heading font-bold text-2xl mb-4 text-dark">Suasana Nyaman</h3>
                    <p class="text-dark/60 leading-relaxed">Dilengkapi dengan WiFi kencang dan area yang
                        estetik, cocok untuk bekerja.</p>
                </div>

                <div
                    class="group p-10 bg-surface rounded-lg shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-dark/5 text-center">
                    <div
                        class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary text-4xl mb-8 mx-auto group-hover:bg-primary group-hover:text-surface transition-colors duration-500">
                        <i class="fas fa-smile"></i>
                    </div>
                    <h3 class="font-heading font-bold text-2xl mb-4 text-dark">Pelayanan Ramah</h3>
                    <p class="text-dark/60 leading-relaxed">Barista kami siap menyambut Anda dengan
                        senyuman dan pelayanan terbaik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-24 bg-white relative overflow-hidden" x-data="{ showModal: false }">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
                <div>
                    <h2 class="text-4xl font-heading font-bold text-dark mb-2">Kata Mereka</h2>
                    <p class="text-dark/60">Pengalaman nyata dari pelanggan setia kami.</p>
                </div>
                <button @click="showModal = true"
                    class="bg-dark text-surface px-6 py-3 cursor-pointer rounded-lg font-bold transition-all shadow-lg hover:shadow-dark/30 hover:bg-primary hover:text-surface">
                    + Beri Ulasan
                </button>
            </div>

            @if (session('success'))
                <div
                    class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl relative mb-10 flex items-center gap-4 animate-bounce">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="swiper reviewSwiper pb-16">
                <div class="swiper-wrapper">
                    @forelse(\App\Models\GeneralReview::where('is_approved', true)->latest()->get() as $rev)
                        <div class="swiper-slide h-auto">
                            <div
                                class="p-8 mb-6 bg-secondary/50 rounded-lg h-full flex flex-col border border-dark/5 shadow-sm transition-all hover:shadow-xl hover:bg-surface group min-h-62.5">
                                <div class="flex items-center gap-5 mb-8">
                                    <div
                                        class="w-16 h-16 shrink-0 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-2xl shadow-inner uppercase transition-colors group-hover:bg-primary group-hover:text-surface">
                                        {{ substr($rev->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="font-heading font-bold text-dark text-xl">{{ $rev->name }}</h3>
                                        <div class="flex text-primary text-sm mt-1">
                                            @for ($i = 0; $i < 5; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="italic text-dark/80 leading-relaxed text-lg break-all overflow-hidden">
                                    "{{ $rev->review }}"</p>
                            </div>
                        </div>
                    @empty
                        <div
                            class="w-full text-center py-20 bg-cream/30 rounded-4xl border-2 border-dashed border-gold/30">
                            <i class="fas fa-comment-slash text-4xl text-gold/50 mb-4 block"></i>
                            <p class="text-warm-gray font-medium">Belum ada ulasan yang disetujui. Jadilah yang pertama!
                            </p>
                        </div>
                    @endforelse
                </div>
                <div class="swiper-pagination mt-10 -mb-1"></div>
            </div>
        </div>

        <!-- Review Modal -->
        <div x-show="showModal"
            class="fixed inset-0 z-100 flex items-center justify-center bg-dark/80 backdrop-blur-md px-4"
            x-transition.opacity style="display: none;" x-cloak>
            <div class="bg-surface rounded-4xl shadow-2xl p-10 w-full max-w-xl relative overflow-hidden"
                @click.away="showModal = false">
                <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                <button @click="showModal = false"
                    class="absolute top-6 right-6 text-dark/40 hover:text-dark text-3xl transition-transform hover:rotate-90">&times;</button>

                <h3 class="text-3xl font-heading font-bold mb-2 text-dark">Bagikan Pengalamanmu</h3>
                <p class="text-dark/60 mb-10">Ulasan Anda sangat berharga bagi kami.</p>

                <form action="{{ route('review.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-dark text-sm font-bold mb-3 uppercase tracking-wider">Nama
                            Anda</label>
                        <input type="text" name="name" required
                            class="w-full px-6 py-4 rounded-2xl bg-secondary/50 border border-dark/10 focus:border-primary focus:bg-surface outline-none transition-all"
                            placeholder="Masukkan nama lengkap...">
                    </div>

                    <div>
                        <label class="block text-dark text-sm font-bold mb-3 uppercase tracking-wider">Ulasan</label>
                        <textarea name="review" rows="5" required
                            class="w-full px-6 py-4 rounded-2xl bg-secondary/50 border border-dark/10 focus:border-primary focus:bg-surface outline-none transition-all"
                            placeholder="Tuliskan komentar Anda di sini..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-dark text-surface font-bold py-5 rounded-lg cursor-pointer hover:bg-primary hover:text-surface transition-all shadow-lg shadow-primary/20 hover:shadow-dark/20 uppercase tracking-widest">
                        Kirim Ulasan
                    </button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper(".reviewSwiper", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2
                        },
                        1024: {
                            slidesPerView: 3
                        },
                    },
                });
            });
        </script>
    </section>
</x-layout>
