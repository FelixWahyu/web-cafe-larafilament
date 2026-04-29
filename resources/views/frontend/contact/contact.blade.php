<x-layout>
    <x-slot:title>Hubungi Kami</x-slot:title>

    <!-- Hero Section -->
    <section class="relative py-24 bg-dark overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-accent/20 z-0"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-accent/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-4 relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-heading font-bold text-surface mb-6">Hubungi <span class="text-primary">Kami</span></h1>
            <p class="text-surface/80 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                Punya pertanyaan, saran, atau ingin reservasi tempat? Tim kami siap menyambut dan membantu Anda.
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-24 bg-secondary">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                
                <!-- Info Section -->
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary font-bold text-sm mb-6 uppercase tracking-widest">
                        Informasi Kontak
                    </span>
                    <h2 class="text-4xl font-heading font-bold text-dark mb-10 leading-tight">Mari Terhubung <br>dengan Kami</h2>
                    
                    <div class="space-y-8">
                        <div class="flex items-start gap-6 group">
                            <div class="w-14 h-14 shrink-0 rounded-2xl bg-surface shadow-sm border border-dark/5 flex items-center justify-center text-primary text-2xl group-hover:bg-primary group-hover:text-surface transition-all duration-300">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-lg mb-1">Lokasi Kami</h3>
                                <p class="text-dark/60 leading-relaxed">Purwokerto, Jawa Tengah, Indonesia. <br>Dekat pusat kota, mudah ditemukan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-6 group">
                            <div class="w-14 h-14 shrink-0 rounded-2xl bg-surface shadow-sm border border-dark/5 flex items-center justify-center text-primary text-2xl group-hover:bg-primary group-hover:text-surface transition-all duration-300">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-lg mb-1">WhatsApp</h3>
                                <p class="text-dark/60 leading-relaxed">+{{ $setting?->whatsapp }}</p>
                                <a href="https://wa.me/{{ $setting?->whatsapp }}" class="text-primary font-bold text-sm hover:underline mt-2 inline-block">Kirim Pesan Sekarang</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-6 group">
                            <div class="w-14 h-14 shrink-0 rounded-2xl bg-surface shadow-sm border border-dark/5 flex items-center justify-center text-primary text-2xl group-hover:bg-primary group-hover:text-surface transition-all duration-300">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-dark text-lg mb-1">Email</h3>
                                <p class="text-dark/60 leading-relaxed">{{ $setting?->email ?? 'info@lavcafe.com' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-16 pt-8 border-t border-dark/5">
                        <h3 class="font-bold text-dark text-lg mb-6">Ikuti Sosial Media Kami</h3>
                        <div class="flex gap-4">
                            @if($setting?->instagram)
                            <a href="{{ $setting->instagram }}" target="_blank" 
                               class="w-12 h-12 rounded-xl bg-surface border border-dark/5 flex items-center justify-center text-dark/40 hover:bg-primary hover:text-surface hover:-translate-y-1 transition-all shadow-sm">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            @endif
                            @if($setting?->tiktok)
                            <a href="{{ $setting->tiktok }}" target="_blank" 
                               class="w-12 h-12 rounded-xl bg-surface border border-dark/5 flex items-center justify-center text-dark/40 hover:bg-primary hover:text-surface hover:-translate-y-1 transition-all shadow-sm">
                                <i class="fab fa-tiktok text-xl"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="relative group">
                    <div class="absolute inset-0 bg-primary/20 rounded-4xl -rotate-3 transition-transform group-hover:rotate-0 duration-500"></div>
                    <div class="relative rounded-4xl overflow-hidden shadow-2xl h-[500px] border-4 border-surface">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126602.8256191636!2d109.16788548981358!3d-7.427740150965311!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655c313bb2a8d1%3A0x401576d14fed230!2sPurwokerto%2C%20Banyumas%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>
</x-layout>