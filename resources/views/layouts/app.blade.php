<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body
        class="antialiased font-sans bg-zinc-100 dark:bg-[#09090b] text-zinc-900 dark:text-zinc-100"
        x-data="{
            dark: localStorage.getItem('theme') === 'dark'
                || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
        }"
        x-init="
            $watch('dark', v => {
                document.documentElement.classList.toggle('dark', v);
                localStorage.setItem('theme', v ? 'dark' : 'light');
            });
            document.documentElement.classList.toggle('dark', dark);
        "
    >
        <x-layout>
            <x-slot:menu>
                <x-side-bar collapsible smart navigate>

                    {{-- Brand expanded --}}
                    <x-slot:brand>
                        <div class="flex items-center gap-3 px-4 py-5">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary-600">
                                <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold leading-none text-zinc-900 dark:text-dark-50 font-heading">MyFinance</p>
                                <p class="mt-0.5 text-[10px] leading-none text-zinc-500 dark:text-dark-400">Personal Finance</p>
                            </div>
                        </div>
                    </x-slot:brand>

                    {{-- Brand collapsed --}}
                    <x-slot:brand-collapsed>
                        <div class="flex items-center justify-center py-5">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary-600">
                                <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </x-slot:brand-collapsed>

                    <x-side-bar.separator text="Utama" />
                    <x-side-bar.item icon="home" text="Dashboard" route="{{ route('home') }}" />
                    <x-side-bar.item icon="banknotes" text="Transaksi">
                        <x-side-bar.item text="Semua Transaksi" route="#" />
                        <x-side-bar.item text="Pemasukan" route="#" />
                        <x-side-bar.item text="Pengeluaran" route="{{ route('pengeluaran') }}" />
                    </x-side-bar.item>
                    <x-side-bar.item icon="calculator" text="Anggaran">
                        <x-side-bar.item text="Rencana Budget" route="#" />
                        <x-side-bar.item text="Monitoring" route="#" />
                    </x-side-bar.item>
                    <x-side-bar.item icon="chart-bar" text="Laporan">
                        <x-side-bar.item text="Arus Kas" route="#" />
                        <x-side-bar.item text="Grafik Keuangan" route="#" />
                    </x-side-bar.item>

                    <x-side-bar.separator text="Fitur AI" />
                    <x-side-bar.item icon="document-chart-bar" text="Laba Rugi" route="#">
                        <x-slot:badge>AI</x-slot:badge>
                    </x-side-bar.item>

                    <x-side-bar.separator text="Akun" />
                    <x-side-bar.item icon="cog-6-tooth" text="Pengaturan" route="#" />

                    <x-slot:footer>
                        <div class="border-t border-zinc-200 dark:border-white/8 p-3">
                            <div class="flex items-center gap-3 rounded-lg px-2 py-2 hover:bg-zinc-100 dark:hover:bg-dark-600/50 transition-colors duration-150 cursor-pointer">
                                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-primary-600 text-xs font-bold text-white font-heading">
                                    {{ strtoupper(substr(auth()->user()?->name ?? 'G', 0, 1)) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate text-xs font-semibold text-zinc-900 dark:text-dark-100">
                                        {{ auth()->user()?->name ?? 'Guest User' }}
                                    </p>
                                    <p class="truncate text-[10px] text-zinc-500 dark:text-dark-400">
                                        {{ auth()->user()?->email ?? 'guest@myfinance.app' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </x-slot:footer>

                </x-side-bar>
            </x-slot:menu>

            <x-slot:header>
                <x-layout.header>
                    <x-slot:left>
                        <span class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading tracking-tight">
                            {{ $title ?? config('app.name') }}
                        </span>
                    </x-slot:left>
                    <x-slot:right>
                        <div class="flex items-center gap-1">
                            {{-- Dark mode toggle --}}
                            <button
                                type="button"
                                aria-label="Toggle dark mode"
                                @click="dark = !dark"
                                class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg text-zinc-500 dark:text-dark-400 hover:bg-zinc-100 dark:hover:bg-dark-700 hover:text-zinc-900 dark:hover:text-dark-100 transition-colors duration-150"
                            >
                                <svg x-show="!dark" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                </svg>
                                <svg x-show="dark" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                </svg>
                            </button>

                            <div class="h-4 w-px bg-zinc-200 dark:bg-dark-600 mx-1"></div>

                            {{-- Notification --}}
                            <button
                                type="button"
                                aria-label="Notifikasi"
                                class="relative flex h-8 w-8 cursor-pointer items-center justify-center rounded-lg text-zinc-500 dark:text-dark-400 hover:bg-zinc-100 dark:hover:bg-dark-700 hover:text-zinc-900 dark:hover:text-dark-100 transition-colors duration-150"
                            >
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                                </svg>
                                <span class="absolute right-1.5 top-1.5 h-1.5 w-1.5 rounded-full bg-primary-600"></span>
                            </button>
                        </div>
                    </x-slot:right>
                </x-layout.header>
            </x-slot:header>

            {{ $slot }}

        </x-layout>

        @livewireScripts
    </body>
</html>
