<x-layout>
    <x-slot:title>Katalog Menu</x-slot:title>

    <!-- Hero Section -->
    <section class="relative py-24 bg-dark overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-br from-primary/20 to-accent/20 z-0"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-heading font-bold text-surface mb-6">Katalog <span
                    class="text-primary">Menu</span></h1>
            <p class="text-surface/80 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                Temukan perpaduan sempurna antara aroma kopi pilihan dan hidangan lezat yang kami sajikan khusus untuk
                Anda.
            </p>
        </div>
    </section>

    <!-- Catalog Content -->
    <section class="py-20 bg-secondary min-h-screen">
        <div class="max-w-7xl mx-auto px-4" x-data="{ search: '', category: 'all' }">

            <!-- Filters -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-6">
                <div class="relative w-full md:w-96 group">
                    <input type="text" x-model="search" placeholder="Cari menu favorit..."
                        class="w-full pl-12 pr-6 py-2 rounded-lg bg-surface border border-dark/5 focus:border-primary focus:ring-0 outline-none transition-all shadow-sm group-hover:shadow-md">
                    <div
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-dark/30 group-focus-within:text-primary transition-colors">
                        <i class="fas fa-search text-xl"></i>
                    </div>
                </div>

                <div class="flex gap-4 w-full md:w-auto">
                    <div class="relative flex-1 md:w-64">
                        <select x-model="category"
                            class="w-full appearance-none pl-6 pr-12 py-2 rounded-lg bg-surface border border-dark/5 focus:border-primary outline-none transition-all shadow-sm cursor-pointer">
                            <option value="all">Semua Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-dark/30 pointer-events-none">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <div x-show="(category === 'all' || category === '{{ $product->category_id }}') && '{{ strtolower($product->name) }}'.includes(search.toLowerCase())">
                        <x-product-card :product="$product" />
                    </div>
                @empty
                    <div
                        class="col-span-full py-20 text-center bg-surface rounded-4xl border-2 border-dashed border-primary/20">
                        <i class="fas fa-utensils text-4xl text-primary/30 mb-4"></i>
                        <p class="text-dark/60 font-medium text-lg">Maaf, menu yang Anda cari belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-layout>