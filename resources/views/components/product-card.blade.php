@props(['product'])

<div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    class="group bg-surface rounded-3xl overflow-hidden transition-all duration-500 hover:-translate-y-2 border border-dark/5 flex flex-col h-full shadow-sm hover:shadow-xl">

    <a href="{{ route('product.detail', $product->slug) }}" class="block relative overflow-hidden aspect-square rounded-t-3xl">
        <img src="{{ asset('storage/' . ($product->images->first()?->image_path ?? 'default.jpg')) }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
        <div
            class="absolute inset-0 bg-dark/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center">
            <span class="bg-surface text-dark px-6 py-2 rounded-full font-bold text-sm shadow-xl">
                Lihat Detail
            </span>
        </div>
    </a>

    <div class="p-6 md:p-8 flex flex-col flex-1">
        <div class="mb-2">
            <h3
                class="font-heading font-bold text-dark text-xl group-hover:text-primary transition-colors leading-tight line-clamp-1">
                {{ $product->name }}
            </h3>
        </div>
        <p class="text-dark/60 text-sm mb-6 line-clamp-2 flex-1">{{ $product->description }}</p>

        <div class="flex flex-row items-center justify-between mt-auto">
            <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-widest text-dark/40 font-bold">Harga</span>
                <p class="text-primary font-bold text-lg">
                    <span class="text-xs font-medium">Rp</span>
                    {{ number_format($product->price, 0, ',', '.') }}
                </p>
            </div>
            {{-- TODO: Implement cart functionality --}}
            <button @click="$store.cart.addToCart({ 
                id: {{ $product->id }}, 
                name: @js($product->name), 
                price: {{ $product->price }}, 
                image: '{{ asset('storage/' . ($product->images->first()?->image_path ?? 'default.jpg')) }}' 
            })"
                class="text-primary cursor-pointer transition-all duration-300 transform hover:scale-110 active:scale-95"
                aria-label="Add to cart">
                <i class="fas fa-plus-circle text-5xl"></i>
            </button>
        </div>
    </div>
</div>
