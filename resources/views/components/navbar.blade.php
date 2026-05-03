<nav x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.scrollY > 20)"
    class="glass sticky top-0 z-50 transition-all duration-300"
    :class="{ 'py-2': scrolled, 'py-4': !scrolled }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <div class="shrink-0 flex items-center gap-3">
                @if ($setting?->logo)
                    <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo {{ $cafeName }}"
                        class="h-10 w-10 rounded-full object-cover border-2 border-primary/30">
                @else
                    <div
                        class="h-10 w-10 bg-primary rounded-full flex items-center justify-center text-surface font-bold shadow-inner">
                        {{ substr($cafeName, 0, 1) }}
                    </div>
                @endif
                <a href="{{ route('home') }}" class="text-2xl font-heading font-bold text-dark tracking-tight">
                    {{ $cafeName }}
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ route('home') }}"
                    class="hover:text-primary {{ request()->routeIs('home') ? 'text-primary' : 'text-dark/70' }} font-medium transition-colors relative group">
                    Home
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('catalog') }}"
                    class="hover:text-primary {{ request()->routeIs('catalog') ? 'text-primary' : 'text-dark/70' }} font-medium transition-colors relative group">
                    Katalog
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                </a>
                <a href="{{ route('contact') }}"
                    class="hover:text-primary {{ request()->routeIs('contact') ? 'text-primary' : 'text-dark/70' }} font-medium transition-colors relative group">
                    Kontak
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full"></span>
                </a>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <button @click="isCartOpen = true" class="relative p-2 text-dark/70 hover:text-primary transition-colors"
                    aria-label="Keranjang Belanja">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z">
                        </path>
                    </svg>
                    <span x-show="$store.cart.totalCount > 0" x-cloak
                        class="absolute top-0 right-0 bg-primary text-surface text-[10px] w-4 h-4 rounded-full flex items-center justify-center font-bold"
                        x-text="$store.cart.totalCount"></span>
                </button>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 text-dark/70 hover:text-primary transition-colors" aria-label="Toggle Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenuOpen">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenuOpen"
                        x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4" class="md:hidden glass mt-2 border-t border-dark/5" x-cloak>
        <div class="px-4 pt-2 pb-6 mt-2 space-y-2">
            <a href="{{ route('home') }}"
                class="block px-4 py-3 {{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-dark/70' }} hover:bg-primary/10 hover:text-primary rounded-xl transition-colors">Home</a>
            <a href="{{ route('catalog') }}"
                class="block px-4 py-3 {{ request()->routeIs('catalog') ? 'text-primary bg-primary/10' : 'text-dark/70' }} hover:bg-primary/10 hover:text-primary rounded-xl transition-colors">Katalog</a>
            <a href="{{ route('contact') }}"
                class="block px-4 py-3 {{ request()->routeIs('contact') ? 'text-primary bg-primary/10' : 'text-dark/70' }} hover:bg-primary/10 hover:text-primary rounded-xl transition-colors">Kontak</a>
        </div>
    </div>
</nav>