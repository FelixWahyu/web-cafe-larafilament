<x-layout>
    <x-slot:title>{{ $product->name }}</x-slot:title>

    <!-- Breadcrumbs & Hero -->
    <section class="relative py-12 md:py-20 bg-dark overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-br from-primary/20 to-accent/20 z-0"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <nav class="flex mb-8 overflow-x-auto whitespace-nowrap pb-2" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm text-surface/60">
                    <li><a href="{{ route('home') }}" class="hover:text-primary transition">Beranda</a></li>
                    <li><i class="fas fa-chevron-right text-[10px] mx-1"></i></li>
                    <li><a href="{{ route('catalog') }}" class="hover:text-primary transition">Katalog</a></li>
                    <li><i class="fas fa-chevron-right text-[10px] mx-1"></i></li>
                    <li class="text-surface font-medium truncate">{{ $product->name }}</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-5xl font-heading font-bold text-surface mb-2">{{ $product->name }}</h1>
            <p class="text-primary font-medium tracking-wider uppercase text-sm">{{ $product->category->name }}</p>
        </div>
    </section>

    <!-- Product Details -->
    <section class="py-16 md:py-24 bg-secondary">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">

                <!-- Product Gallery -->
                <div
                    x-data="{ activeImg: '{{ asset('storage/' . ($product->images->first()?->image_path ?? 'default.jpg')) }}' }">
                    <div
                        class="aspect-square rounded-3xl overflow-hidden bg-surface shadow-xl mb-6 border border-dark/5">
                        <img :src="activeImg" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                    </div>
                    @if($product->images->count() > 1)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($product->images as $image)
                                <button @click="activeImg = '{{ asset('storage/' . $image->image_path) }}'"
                                    class="aspect-square rounded-xl overflow-hidden border-2 transition-all hover:border-primary"
                                    :class="activeImg === '{{ asset('storage/' . $image->image_path) }}' ? 'border-primary' : 'border-transparent'">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="flex flex-col">
                    <div class="mb-8">
                        <div class="flex items-center gap-4 mb-4">
                            <span
                                class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                {{ $product->category->name }}
                            </span>
                            <div class="flex items-center text-accent">
                                @php $avgRating = round($product->reviews->avg('rating') ?? 0); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $avgRating ? 'fas' : 'far' }} fa-star text-sm"></i>
                                @endfor
                                <span class="ml-2 text-dark/60 text-sm">({{ $product->reviews->count() }} Ulasan)</span>
                            </div>
                        </div>
                        <h2 class="text-4xl font-heading font-bold text-dark mb-4">Sajian Istimewa</h2>
                        <p class="text-3xl font-bold text-primary mb-6">Rp
                            {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        <div class="prose prose-stone max-w-none text-dark/80 leading-relaxed mb-8">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    @if($product->ingredients)
                        <div class="mb-10 bg-surface/50 p-6 rounded-2xl border border-dark/5">
                            <h3 class="font-heading font-bold text-lg text-dark mb-4 flex items-center gap-2">
                                <i class="fas fa-leaf text-primary"></i> Komposisi & Bahan
                            </h3>
                            <p class="text-dark/70 text-sm leading-relaxed">
                                {{ $product->ingredients }}
                            </p>
                        </div>
                    @endif

                    <div class="mt-auto flex flex-col sm:flex-row gap-4">
                        <a href="https://wa.me/{{ $setting->whatsapp ?? '' }}?text=Halo Lav Cafe, saya ingin memesan {{ $product->name }}"
                            target="_blank"
                            class="flex-1 bg-primary text-surface px-8 py-4 rounded-2xl font-bold text-center hover:bg-accent transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-xl"></i> Pesan Sekarang
                        </a>
                        <button
                            class="bg-dark text-surface px-8 py-4 cursor-pointer rounded-2xl font-bold hover:bg-dark/90 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="py-20 bg-surface">
        <div class="max-w-7xl mx-auto px-4" x-data="{ showForm: false }">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-6">
                <div>
                    <h2 class="text-3xl font-heading font-bold text-dark mb-2">Ulasan Pelanggan</h2>
                    <p class="text-dark/60">Apa kata mereka tentang {{ $product->name }}?</p>
                </div>
                <button @click="showForm = !showForm"
                    class="bg-secondary text-primary px-6 py-3 cursor-pointer rounded-xl font-bold hover:bg-primary hover:text-surface transition-all flex items-center gap-2">
                    <i class="fas fa-plus" x-show="!showForm"></i>
                    <i class="fas fa-times" x-show="showForm" x-cloak></i>
                    <span x-text="showForm ? 'Batal' : 'Tambah Ulasan'"></span>
                </button>
            </div>

            <!-- Add Review Form -->
            <div x-show="showForm" x-collapse x-cloak
                class="mb-16 bg-secondary/30 p-8 rounded-3xl border border-dark/5 shadow-inner">
                <form action="{{ route('product.review.store', $product->slug) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-dark mb-2">Nama Anda</label>
                                <input type="text" name="name" required placeholder="Masukkan nama lengkap"
                                    class="w-full px-6 py-3 rounded-xl bg-surface border border-dark/10 focus:border-primary outline-none transition-all shadow-sm">
                            </div>
                            <div x-data="{ rating: 0, hover: 0 }">
                                <label class="block text-sm font-bold text-dark mb-2">Rating Produk</label>
                                <div class="flex gap-2">
                                    <template x-for="i in 5">
                                        <button type="button" @click="rating = i" @mouseenter="hover = i"
                                            @mouseleave="hover = 0" class="text-2xl transition-colors duration-200">
                                            <i class="fa-star"
                                                :class="(hover || rating) >= i ? 'fas text-primary' : 'far text-dark/20'"></i>
                                        </button>
                                    </template>
                                </div>
                                <input type="hidden" name="rating" :value="rating" required>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark mb-2">Ulasan / Komentar</label>
                            <textarea name="review" rows="5" required
                                placeholder="Ceritakan pengalaman Anda menikmati menu ini..."
                                class="w-full px-6 py-4 rounded-xl bg-surface border border-dark/10 focus:border-primary outline-none transition-all shadow-sm"></textarea>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="bg-primary text-surface px-10 py-4 rounded-2xl font-bold hover:bg-accent transition-all shadow-lg shadow-primary/20">
                            Kirim Ulasan Sekarang
                        </button>
                    </div>
                </form>
            </div>

            <!-- Review List -->
            <div class="max-h-[400px] overflow-y-auto pr-4 custom-scrollbar">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($product->reviews as $review)
                        <div
                            class="bg-surface border border-dark/5 p-8 rounded-3xl shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl uppercase">
                                        {{ mb_substr($review->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-heading font-bold text-dark leading-tight">{{ $review->name }}</h4>
                                        <p class="text-xs text-dark/40">{{ $review->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex text-primary">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star text-xs"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-dark/70 italic leading-relaxed">"{{ $review->review }}"</p>
                        </div>
                    @empty
                        <div
                            class="col-span-full text-center py-12 bg-secondary/20 rounded-3xl border-2 border-dashed border-dark/5">
                            <i class="fas fa-comment-slash text-4xl text-dark/20 mb-4"></i>
                            <p class="text-dark/40 font-medium">Belum ada ulasan untuk produk ini. Jadi yang pertama
                                mengulas!
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section class="py-20 bg-secondary">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl font-heading font-bold text-dark mb-12 text-center">Menu <span
                        class="text-primary">Terkait</span></h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $rel)
                        <div
                            class="group bg-surface rounded-3xl overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-dark/5 shadow-sm hover:shadow-xl flex flex-col h-full">
                            <a href="{{ route('product.detail', $rel->slug) }}"
                                class="block relative overflow-hidden aspect-square rounded-t-3xl">
                                <img src="{{ asset('storage/' . ($rel->images->first()?->image_path ?? 'default.jpg')) }}"
                                    alt="{{ $rel->name }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-dark/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
                                    <span class="bg-surface text-dark px-6 py-2 rounded-full font-bold text-sm shadow-xl">Lihat
                                        Detail</span>
                                </div>
                            </a>
                            <div class="p-6 flex flex-col flex-1">
                                <div class="mb-2">
                                    <h3
                                        class="font-heading font-bold text-dark text-xl group-hover:text-primary transition-colors leading-tight line-clamp-1">
                                        {{ $rel->name }}
                                    </h3>
                                </div>
                                <p class="text-dark/60 text-sm mb-6 line-clamp-2 flex-1">{{ $rel->description }}</p>

                                <div class="flex flex-row items-center justify-between mt-auto">
                                    <div class="flex flex-col">
                                        <span class="text-[10px] uppercase tracking-widest text-dark/40 font-bold">Harga</span>
                                        <p class="text-primary font-bold text-lg">
                                            <span class="text-xs font-medium">Rp</span>
                                            {{ number_format($rel->price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <button
                                        class="text-primary cursor-pointer transition-all duration-300 transform hover:scale-110 active:scale-95">
                                        <i class="fas fa-plus-circle text-5xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layout>