<x-layout>
    <section class="py-12 bg-pink-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4" x-data="{ search: '', category: 'all' }">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <h1 class="text-3xl font-bold text-gray-800">Katalog Menu</h1>

                <div class="flex gap-2 w-full md:w-auto">
                    <input type="text" x-model="search" placeholder="Cari kopi favorit..." class="px-4 py-2 rounded-full border-pink-200 focus:ring-pink-500 w-full">
                    <select x-model="category" class="px-4 py-2 rounded-full border-pink-200 focus:ring-pink-500">
                        <option value="all">Semua</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                <div x-show="(category === 'all' || category === '{{ $product->category_id }}') && '{{ strtolower($product->name) }}'.includes(search.toLowerCase())"
                     class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition group">
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <img src="{{ asset('storage/' . ($product->images->first()?->image_path ?? 'default.jpg')) }}" class="h-48 w-full object-cover group-hover:scale-105 transition">
                    </a>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-pink-600 font-bold mt-2">Rp{{ number_format($product->price,0,',','.') }}</p>
                        <button class="w-full mt-4 bg-pink-500 text-white py-2 rounded-xl font-bold hover:bg-pink-600 transition">+ Keranjang</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-layout>