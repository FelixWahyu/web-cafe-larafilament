@php
    use Filament\Support\Enums\Width;

    $livewire ??= null;
    $renderHookScopes = $livewire?->getRenderHookScopes();
    $maxContentWidth ??= (filament()->getSimplePageMaxContentWidth() ?? Width::Large);

    if (is_string($maxContentWidth)) {
        $maxContentWidth = Width::tryFrom($maxContentWidth) ?? $maxContentWidth;
    }

    $setting = Cache::remember('cafe_setting', 3600, fn() => \App\Models\Setting::first());
    $cafeName = $setting?->business_name ?? 'Lav Cafe';
    $isLoginPage = ($livewire instanceof \App\Filament\Auth\Login);
@endphp

<x-filament-panels::layout.base :livewire="$livewire">
    @props([
        'after' => null,
        'heading' => null,
        'subheading' => null,
    ])

    @if ($isLoginPage)
        {{-- ===== CUSTOM CAFE LOGIN LAYOUT ===== --}}
        <style>
            /* Reset Filament default simple layout styles for login */
            .fi-simple-layout { min-height: 100vh; display: flex; padding: 0 !important; }
            .fi-simple-main-ctn { flex: 1; display: flex; align-items: center; justify-content: center; padding: 0 !important; }
            .fi-simple-main { width: 100%; max-width: none !important; padding: 0 !important; }

            /* Import Google Fonts */
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700&display=swap');

            :root {
                --cafe-primary: #e27d19;
                --cafe-secondary: #e2d9c8;
                --cafe-accent: #c67c4e;
                --cafe-dark: #30261c;
                --cafe-surface: #f5f5f5;
            }

            .cafe-login-wrapper {
                min-height: 100vh;
                display: flex;
                width: 100%;
                font-family: 'Inter', sans-serif;
            }

            /* Left Panel - Branding */
            .cafe-brand-panel {
                display: none;
                width: 50%;
                background: linear-gradient(135deg, var(--cafe-dark) 0%, #1a1510 50%, var(--cafe-dark) 100%);
                position: relative;
                overflow: hidden;
            }

            @media (min-width: 1024px) {
                .cafe-brand-panel {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            }

            .cafe-brand-panel::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(ellipse at 20% 50%, rgba(226, 125, 25, 0.15) 0%, transparent 60%),
                    radial-gradient(ellipse at 80% 20%, rgba(198, 124, 78, 0.1) 0%, transparent 50%),
                    radial-gradient(ellipse at 60% 80%, rgba(226, 125, 25, 0.08) 0%, transparent 50%);
            }

            .cafe-brand-content {
                position: relative;
                z-index: 10;
                text-align: center;
                padding: 3rem;
                max-width: 480px;
            }

            .cafe-brand-logo {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid rgba(226, 125, 25, 0.4);
                margin: 0 auto 2rem;
                box-shadow: 0 0 40px rgba(226, 125, 25, 0.2);
            }

            .cafe-brand-logo-fallback {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--cafe-primary), var(--cafe-accent));
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2.5rem;
                font-weight: 700;
                font-family: 'Outfit', sans-serif;
                margin: 0 auto 2rem;
                box-shadow: 0 0 40px rgba(226, 125, 25, 0.2);
            }

            .cafe-brand-title {
                font-family: 'Outfit', sans-serif;
                font-size: 2.5rem;
                font-weight: 700;
                color: var(--cafe-secondary);
                margin-bottom: 1rem;
                letter-spacing: -0.02em;
            }

            .cafe-brand-title span { color: var(--cafe-primary); }

            .cafe-brand-subtitle {
                color: rgba(226, 217, 200, 0.6);
                font-size: 1.1rem;
                line-height: 1.7;
                font-weight: 300;
            }

            .cafe-brand-features {
                margin-top: 3rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .cafe-brand-feature {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                color: rgba(226, 217, 200, 0.5);
                font-size: 0.9rem;
            }

            .cafe-brand-feature-icon {
                width: 32px;
                height: 32px;
                border-radius: 8px;
                background: rgba(226, 125, 25, 0.1);
                border: 1px solid rgba(226, 125, 25, 0.2);
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--cafe-primary);
                flex-shrink: 0;
            }

            /* Decorative circles */
            .cafe-deco-circle { position: absolute; border-radius: 50%; border: 1px solid rgba(226, 125, 25, 0.08); }
            .cafe-deco-1 { width: 400px; height: 400px; top: -100px; right: -100px; }
            .cafe-deco-2 { width: 300px; height: 300px; bottom: -80px; left: -80px; }
            .cafe-deco-3 { width: 200px; height: 200px; top: 50%; left: -50px; border-color: rgba(226, 125, 25, 0.05); }

            /* Right Panel - Form */
            .cafe-form-panel {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--cafe-surface);
                position: relative;
                padding: 2rem;
            }

            .cafe-form-panel::before {
                content: '';
                position: absolute;
                top: 0; left: 0;
                width: 4px;
                height: 100%;
                background: linear-gradient(to bottom, var(--cafe-primary), var(--cafe-accent), transparent);
            }

            @media (max-width: 1023px) {
                .cafe-form-panel::before { display: none; }
                .cafe-form-panel { background: linear-gradient(135deg, var(--cafe-surface) 0%, #ebe5dc 100%); }
            }

            .cafe-form-container { width: 100%; max-width: 440px; }

            /* Mobile Header */
            .cafe-mobile-header {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-bottom: 2rem;
            }

            @media (min-width: 1024px) {
                .cafe-mobile-header { display: none; }
            }

            .cafe-mobile-logo {
                width: 64px; height: 64px; border-radius: 50%;
                object-fit: cover;
                border: 2px solid rgba(226, 125, 25, 0.3);
                margin-bottom: 1rem;
            }

            .cafe-mobile-logo-fallback {
                width: 64px; height: 64px; border-radius: 50%;
                background: linear-gradient(135deg, var(--cafe-primary), var(--cafe-accent));
                display: flex; align-items: center; justify-content: center;
                color: white; font-size: 1.5rem; font-weight: 700;
                font-family: 'Outfit', sans-serif;
                margin-bottom: 1rem;
            }

            .cafe-mobile-name {
                font-family: 'Outfit', sans-serif;
                font-size: 1.5rem; font-weight: 700;
                color: var(--cafe-dark);
            }

            /* Form Card */
            .cafe-form-card {
                background: white;
                border-radius: 1.5rem;
                padding: 2.5rem;
                box-shadow: 0 1px 3px rgba(48, 38, 28, 0.04), 0 8px 32px rgba(48, 38, 28, 0.06);
                border: 1px solid rgba(48, 38, 28, 0.06);
            }

            .cafe-form-heading {
                font-family: 'Outfit', sans-serif;
                font-size: 1.75rem; font-weight: 700;
                color: var(--cafe-dark);
                margin-bottom: 0.5rem;
                letter-spacing: -0.01em;
            }

            .cafe-form-subheading {
                color: rgba(48, 38, 28, 0.5);
                font-size: 0.95rem;
                margin-bottom: 2rem;
            }

            .cafe-form-footer {
                text-align: center;
                margin-top: 2rem;
                color: rgba(48, 38, 28, 0.35);
                font-size: 0.8rem;
            }

            /* Override Filament form styling inside form card */
            .cafe-form-card .fi-fo-field-wrp label {
                color: var(--cafe-dark) !important;
                font-weight: 500 !important;
                font-size: 0.875rem !important;
            }

            .cafe-form-card .fi-btn-primary {
                background: linear-gradient(135deg, var(--cafe-primary), var(--cafe-accent)) !important;
                border: none !important;
                border-radius: 0.75rem !important;
                font-weight: 600 !important;
                height: 2.75rem !important;
                transition: all 0.3s ease !important;
                box-shadow: 0 4px 12px rgba(226, 125, 25, 0.3) !important;
            }

            .cafe-form-card .fi-btn-primary:hover {
                transform: translateY(-1px) !important;
                box-shadow: 0 6px 20px rgba(226, 125, 25, 0.4) !important;
            }

            .cafe-form-card .fi-input-wrp {
                border-radius: 0.75rem !important;
                border-color: rgba(48, 38, 28, 0.12) !important;
                transition: all 0.2s ease !important;
            }

            .cafe-form-card .fi-input-wrp:focus-within {
                border-color: var(--cafe-primary) !important;
                box-shadow: 0 0 0 3px rgba(226, 125, 25, 0.1) !important;
            }

            /* Hide Filament default simple page header (we use our own) */
            .cafe-form-card .fi-simple-page > .fi-simple-page-content > .fi-simple-header { display: none; }
        </style>

        <div class="fi-simple-layout">
            <div class="cafe-login-wrapper">
                {{-- Left Branding Panel --}}
                <div class="cafe-brand-panel">
                    <div class="cafe-deco-circle cafe-deco-1"></div>
                    <div class="cafe-deco-circle cafe-deco-2"></div>
                    <div class="cafe-deco-circle cafe-deco-3"></div>

                    <div class="cafe-brand-content">
                        @if ($setting?->logo)
                            <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo {{ $cafeName }}" class="cafe-brand-logo">
                        @else
                            <div class="cafe-brand-logo-fallback">{{ substr($cafeName, 0, 1) }}</div>
                        @endif

                        <h1 class="cafe-brand-title">{{ $cafeName }} <span>Admin</span></h1>
                        <p class="cafe-brand-subtitle">
                            Kelola produk, promosi, dan ulasan pelanggan dari satu tempat yang mudah dan cepat.
                        </p>

                        <div class="cafe-brand-features">
                            <div class="cafe-brand-feature">
                                <div class="cafe-brand-feature-icon">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <span>Kelola Produk & Kategori</span>
                            </div>
                            <div class="cafe-brand-feature">
                                <div class="cafe-brand-feature-icon">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                </div>
                                <span>Atur Promo Banner</span>
                            </div>
                            <div class="cafe-brand-feature">
                                <div class="cafe-brand-feature-icon">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </div>
                                <span>Moderasi Ulasan Pelanggan</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Form Panel --}}
                <div class="cafe-form-panel">
                    <div class="cafe-form-container">
                        {{-- Mobile-only Header --}}
                        <div class="cafe-mobile-header">
                            @if ($setting?->logo)
                                <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo {{ $cafeName }}" class="cafe-mobile-logo">
                            @else
                                <div class="cafe-mobile-logo-fallback">{{ substr($cafeName, 0, 1) }}</div>
                            @endif
                            <span class="cafe-mobile-name">{{ $cafeName }}</span>
                        </div>

                        {{-- Form Card --}}
                        <div class="cafe-form-card">
                            <h2 class="cafe-form-heading">Selamat Datang Kembali</h2>
                            <p class="cafe-form-subheading">Masuk ke panel admin {{ $cafeName }}</p>

                            <div class="fi-simple-main-ctn">
                                <main class="fi-simple-main">
                                    {{ $slot }}
                                </main>
                            </div>
                        </div>

                        <p class="cafe-form-footer">
                            &copy; {{ date('Y') }} {{ $cafeName }}. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- ===== DEFAULT FILAMENT LAYOUT FOR NON-LOGIN PAGES ===== --}}
        <div class="fi-simple-layout">
            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_START, scopes: $renderHookScopes) }}

            @if (($hasTopbar ?? true) && filament()->auth()->check())
                <div class="fi-simple-layout-header">
                    @if (filament()->hasDatabaseNotifications())
                        @livewire(filament()->getDatabaseNotificationsLivewireComponent(), [
                            'lazy' => filament()->hasLazyLoadedDatabaseNotifications(),
                            'position' => \Filament\Enums\DatabaseNotificationsPosition::Topbar,
                        ])
                    @endif

                    @if (filament()->hasUserMenu())
                        @livewire(Filament\Livewire\SimpleUserMenu::class)
                    @endif
                </div>
            @endif

            <div class="fi-simple-main-ctn">
                <main
                    @class([
                        'fi-simple-main',
                        ($maxContentWidth instanceof Width) ? "fi-width-{$maxContentWidth->value}" : $maxContentWidth,
                    ])
                >
                    {{ $slot }}
                </main>
            </div>

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::FOOTER, scopes: $renderHookScopes) }}

            {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::SIMPLE_LAYOUT_END, scopes: $renderHookScopes) }}
        </div>
    @endif
</x-filament-panels::layout.base>
