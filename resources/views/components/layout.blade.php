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

<body class="bg-secondary text-dark antialiased font-sans" x-data="{ isCartOpen: false }">

    @include('components.navbar')

    <main id="main-content">
        {{ $slot }}
    </main>

    {{-- Slide-over Keranjang --}}
    <div x-show="isCartOpen" class="fixed inset-0 z-[100] overflow-hidden" x-cloak>
        <div class="absolute inset-0 bg-dark/60 backdrop-blur-sm transition-opacity" @click="isCartOpen = false"
            x-show="isCartOpen" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div class="w-screen max-w-md transform transition ease-in-out duration-500 sm:duration-700"
                x-show="isCartOpen" x-transition:enter="translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="flex h-full flex-col bg-surface shadow-2xl">
                    <div class="flex-1 overflow-y-auto px-6 py-8">
                        <div class="flex items-start justify-between border-b border-dark/5 pb-6">
                            <h2 class="text-2xl font-heading font-bold text-dark">Keranjang Belanja</h2>
                            <div class="ml-3 flex h-7 items-center">
                                <button type="button" @click="isCartOpen = false"
                                    class="text-dark/40 hover:text-primary transition-colors">
                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-8">
                            <template x-if="$store.cart.items.length === 0">
                                <div class="flex flex-col items-center justify-center py-20 text-center">
                                    <div class="bg-primary/10 p-6 rounded-full mb-6">
                                        <i class="fas fa-shopping-basket text-4xl text-primary"></i>
                                    </div>
                                    <p class="text-dark/40 font-medium italic">Keranjang Anda masih kosong</p>
                                    <button @click="isCartOpen = false"
                                        class="mt-6 text-primary font-bold hover:underline">Mulai Belanja &rarr;</button>
                                </div>
                            </template>

                            <ul role="list" class="divide-y divide-dark/5">
                                <template x-for="item in $store.cart.items" :key="item.id">
                                    <li class="flex py-6 transition-all">
                                        <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-2xl border border-dark/5 shadow-sm">
                                            <img :src="item.image" :alt="item.name"
                                                class="h-full w-full object-cover object-center"
                                                onerror="this.src='https://placehold.co/400x400?text=Produk'">
                                        </div>

                                        <div class="ml-4 flex flex-1 flex-col">
                                            <div>
                                                <div class="flex justify-between text-base font-bold text-dark">
                                                    <h3 x-text="item.name" class="line-clamp-1"></h3>
                                                    <p class="ml-4 text-primary whitespace-nowrap">
                                                        Rp <span x-text="new Intl.NumberFormat('id-ID').format(item.price * item.qty)"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                <div class="flex items-center gap-3 bg-secondary px-3 py-1.5 rounded-xl border border-dark/5">
                                                    <button @click="$store.cart.updateQty(item.id, item.qty - 1)"
                                                        class="text-dark/40 hover:text-primary transition-colors">
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                    <span x-text="item.qty" class="font-bold text-dark min-w-[20px] text-center"></span>
                                                    <button @click="$store.cart.updateQty(item.id, item.qty + 1)"
                                                        class="text-dark/40 hover:text-primary transition-colors">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </div>

                                                <div class="flex">
                                                    <button type="button" @click="$store.cart.removeItem(item.id)"
                                                        class="font-medium text-red-500 hover:text-red-600 flex items-center gap-1 transition-colors">
                                                        <i class="fas fa-trash-alt text-xs"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <div class="border-t border-dark/5 px-6 py-8 bg-secondary/30" x-show="$store.cart.items.length > 0">
                        <div class="flex justify-between text-lg font-bold text-dark mb-2">
                            <p>Subtotal</p>
                            <p>Rp <span x-text="new Intl.NumberFormat('id-ID').format($store.cart.totalPrice)"></span></p>
                        </div>
                        <p class="mt-0.5 text-sm text-dark/40 mb-8 italic text-right">*Belum termasuk ongkir jika ada.</p>
                        <div class="mt-6">
                            <button @click="$store.cart.checkout('{{ $setting?->whatsapp ?? '628xxx' }}')"
                                class="flex w-full items-center justify-center gap-3 rounded-2xl bg-primary px-6 py-4 text-lg font-bold text-surface shadow-lg shadow-primary/30 hover:bg-dark hover:shadow-dark/30 transition-all duration-300 transform active:scale-95">
                                <i class="fab fa-whatsapp text-2xl"></i>
                                Pesan Sekarang via WA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toast Notifications --}}
    <div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[200] flex flex-col gap-3 w-full max-w-sm px-4">
        <template x-for="note in $store.cart.notifications" :key="note.id">
            <div x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                class="bg-dark text-surface px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-primary/20">
                <div class="bg-primary/20 p-2 rounded-full">
                    <i class="fas fa-check text-primary"></i>
                </div>
                <p class="font-medium flex-1" x-text="note.message"></p>
                <button @click="$store.cart.notifications = $store.cart.notifications.filter(n => n.id !== note.id)"
                    class="text-surface/40 hover:text-surface">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </template>
    </div>

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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: JSON.parse(localStorage.getItem('cafe_cart') || '[]'),
                notifications: [],
                
                save() {
                    localStorage.setItem('cafe_cart', JSON.stringify(this.items));
                },

                notify(message) {
                    let id = Date.now();
                    this.notifications.push({ id, message });
                    setTimeout(() => {
                        this.notifications = this.notifications.filter(n => n.id !== id);
                    }, 3000);
                },
                
                addToCart(product) {
                    let existingItem = this.items.find(i => i.id === product.id);
                    if (existingItem) {
                        existingItem.qty++;
                    } else {
                        this.items.push({ ...product, qty: 1 });
                    }
                    this.save();
                    this.notify(`${product.name} berhasil ditambahkan ke keranjang!`);
                },
                
                updateQty(id, qty) {
                    if (qty <= 0) {
                        this.removeItem(id);
                        return;
                    }
                    let item = this.items.find(i => i.id === id);
                    if (item) {
                        item.qty = qty;
                        this.save();
                    }
                },
                
                removeItem(id) {
                    this.items = this.items.filter(i => i.id !== id);
                    this.save();
                },
                
                get totalCount() {
                    return this.items.length;
                },
                
                get totalPrice() {
                    return this.items.reduce((total, item) => total + (item.price * item.qty), 0);
                },

                checkout(adminPhone) {
                    if (this.items.length === 0) return;
                    
                    // Format phone: remove non-digits, replace leading 0 with 62
                    let cleanPhone = adminPhone.replace(/\D/g, '');
                    if (cleanPhone.startsWith('0')) {
                        cleanPhone = '62' + cleanPhone.substring(1);
                    }

                    let message = "Halo Lav-Cafe, saya ingin memesan:\n\n";
                    this.items.forEach(item => {
                        message += `• ${item.qty}x ${item.name} - Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.qty)}\n`;
                    });
                    message += `\n*Total Tagihan: Rp ${new Intl.NumberFormat('id-ID').format(this.totalPrice)}*`;
                    message += `\n\nMohon informasi selanjutnya untuk proses pembayaran dan pengiriman. Terima kasih!`;
                    
                    let encodedMsg = encodeURIComponent(message);
                    window.open(`https://wa.me/${cleanPhone}?text=${encodedMsg}`, '_blank');
                }
            });
        });
    </script>
</body>

</html>