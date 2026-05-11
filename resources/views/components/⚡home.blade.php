<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('layouts.app')] #[Title('Dashboard')] class extends Component {

    public function getSaldoBersihProperty(): int
    {
        return 24_500_000 - 18_200_000;
    }

}; ?>

<div class="space-y-6">

    {{-- ══════════════════════════════════════════
        HEADER
    ══════════════════════════════════════════ --}}
    <div class="flex flex-row items-start justify-between gap-4 fade-up fade-up-1">
        <div>
            <p class="text-[11px] font-semibold text-zinc-400 dark:text-dark-400 uppercase tracking-[0.12em] mb-0.5">
                {{ now()->translatedFormat('F Y') }}
            </p>
            <h1 class="text-3xl font-bold font-heading leading-tight bg-linear-to-r from-zinc-900 via-blue-800 to-indigo-800 dark:from-white dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent">
                Dashboard
            </h1>
            <p class="text-sm text-zinc-500 dark:text-dark-400 mt-1">
                Ringkasan keuangan pribadi Anda bulan ini
            </p>
        </div>
        <button
            type="button"
            class="inline-flex items-center gap-2 h-8 px-3.5 rounded-lg border border-zinc-200 dark:border-white/10 bg-white dark:bg-dark-800 text-xs font-medium text-zinc-600 dark:text-dark-400 hover:text-primary-600 dark:hover:text-primary-400 hover:border-primary-300 dark:hover:border-primary-700 transition-all duration-150 cursor-pointer shrink-0 mt-1"
        >
            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            Pilih Periode
        </button>
    </div>

    {{-- ══════════════════════════════════════════
        STATS CARDS — horizontal layout (reference style)
    ══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 fade-up fade-up-2">

        {{-- Pemasukan --}}
        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-green-50 dark:bg-green-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Pemasukan</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">24.500.000</p>
                    <p class="text-xs text-green-600 dark:text-green-400 mt-1 font-medium">+12,5% dari bulan lalu</p>
                </div>
            </div>
        </div>

        {{-- Pengeluaran --}}
        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-red-50 dark:bg-red-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-red-500 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Pengeluaran</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">18.200.000</p>
                    <p class="text-xs text-red-500 dark:text-red-400 mt-1 font-medium">+4,2% dari bulan lalu</p>
                </div>
            </div>
        </div>

        {{-- Saldo Bersih --}}
        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Saldo Bersih</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">{{ number_format($this->saldoBersih, 0, ',', '.') }}</p>
                    <p class="text-xs text-zinc-400 dark:text-dark-400 mt-1">{{ now()->translatedFormat('F Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Budget Terpakai --}}
        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-amber-50 dark:bg-amber-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-amber-500 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Budget Terpakai</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">74<span class="text-base font-medium text-zinc-400 dark:text-dark-400">%</span></p>
                    <p class="text-xs text-zinc-400 dark:text-dark-400 mt-1">Rp 4.800.000 tersisa</p>
                </div>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════════
        MAIN CONTENT GRID — 3 column
    ══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 fade-up fade-up-3">

        {{-- Input Transaksi --}}
        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
            <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                <div>
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Input Transaksi</h2>
                    <p class="text-xs text-zinc-500 dark:text-dark-400 mt-0.5">Catat transaksi baru</p>
                </div>
            </div>
            <div class="px-5 py-4 space-y-4">
                <div>
                    <label class="block text-xs font-medium text-zinc-700 dark:text-dark-300 mb-1.5">Jumlah Transaksi</label>
                    <input
                        type="text"
                        placeholder="Rp 0"
                        class="w-full rounded-lg border border-zinc-200 dark:border-dark-600 bg-white dark:bg-dark-800 px-3 py-2 text-sm text-zinc-900 dark:text-dark-300 placeholder-zinc-400 dark:placeholder-dark-400 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                    />
                    <p class="mt-1 text-xs text-zinc-400 dark:text-dark-400">Format otomatis sesuai locale Indonesia</p>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-700 dark:text-dark-300 mb-1.5">Jenis</label>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg border border-green-200 dark:border-green-900/40 bg-green-50 dark:bg-green-900/10 text-green-700 dark:text-green-400 text-xs font-medium cursor-pointer hover:bg-green-100 dark:hover:bg-green-900/20 transition-colors">
                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                            Pemasukan
                        </button>
                        <button type="button" class="flex items-center justify-center gap-2 px-3 py-2 rounded-lg border border-zinc-200 dark:border-dark-600 bg-zinc-50 dark:bg-dark-700 text-zinc-600 dark:text-dark-400 text-xs font-medium cursor-pointer hover:bg-zinc-100 dark:hover:bg-dark-600 transition-colors">
                            <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" /></svg>
                            Pengeluaran
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-medium text-zinc-700 dark:text-dark-300 mb-1.5">Rentang Tanggal</label>
                    <input
                        type="text"
                        placeholder="Pilih rentang tanggal..."
                        class="w-full rounded-lg border border-zinc-200 dark:border-dark-600 bg-white dark:bg-dark-800 px-3 py-2 text-sm text-zinc-900 dark:text-dark-300 placeholder-zinc-400 dark:placeholder-dark-400 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-colors"
                    />
                </div>

                <div class="flex gap-2 pt-1">
                    <button type="button" class="flex-1 flex items-center justify-center gap-2 h-9 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium transition-colors cursor-pointer">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                        Simpan
                    </button>
                    <button type="button" class="h-9 px-4 rounded-lg border border-zinc-200 dark:border-dark-600 bg-white dark:bg-dark-700 text-zinc-600 dark:text-dark-300 text-sm font-medium hover:bg-zinc-50 dark:hover:bg-dark-600 transition-colors cursor-pointer">
                        Reset
                    </button>
                </div>

                <div class="flex items-center gap-2 p-3 rounded-lg bg-zinc-50 dark:bg-dark-700 border border-zinc-100 dark:border-white/8">
                    <svg class="w-4 h-4 text-zinc-400 dark:text-dark-400 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" /></svg>
                    <span class="text-xs text-zinc-500 dark:text-dark-400">Nilai: <span class="font-semibold text-zinc-700 dark:text-dark-300">Rp 0</span></span>
                </div>
            </div>
        </div>

        {{-- Transaksi Terbaru --}}
        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
            <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                <div>
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Transaksi Terbaru</h2>
                    <p class="text-xs text-zinc-500 dark:text-dark-400 mt-0.5">5 transaksi terakhir</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 border border-primary-100 dark:border-primary-900/40">
                    5 transaksi
                </span>
            </div>
            <div class="divide-y divide-zinc-50 dark:divide-white/5">
                @foreach ([
                    ['icon' => 'briefcase',        'name' => 'Gaji Bulanan',    'date' => '10 Mei', 'amount' => '+Rp 12.000.000', 'color' => 'green'],
                    ['icon' => 'shopping-bag',      'name' => 'Belanja Bulanan', 'date' => '9 Mei',  'amount' => '-Rp 2.350.000',  'color' => 'red'],
                    ['icon' => 'bolt',              'name' => 'Tagihan Listrik', 'date' => '8 Mei',  'amount' => '-Rp 450.000',    'color' => 'red'],
                    ['icon' => 'computer-desktop',  'name' => 'Freelance',       'date' => '7 Mei',  'amount' => '+Rp 3.500.000',  'color' => 'green'],
                    ['icon' => 'truck',             'name' => 'Transportasi',    'date' => '6 Mei',  'amount' => '-Rp 180.000',    'color' => 'red'],
                ] as $tx)
                <div class="flex items-center gap-3 px-5 py-3 hover:bg-zinc-50 dark:hover:bg-dark-700/50 transition-colors">
                    <div class="h-9 w-9 rounded-xl flex items-center justify-center shrink-0 {{ $tx['color'] === 'green' ? 'bg-green-50 dark:bg-green-900/20' : 'bg-red-50 dark:bg-red-900/20' }}">
                        @if($tx['icon'] === 'briefcase')
                            <svg class="w-4 h-4 {{ $tx['color'] === 'green' ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" /></svg>
                        @elseif($tx['icon'] === 'shopping-bag')
                            <svg class="w-4 h-4 {{ $tx['color'] === 'green' ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>
                        @elseif($tx['icon'] === 'bolt')
                            <svg class="w-4 h-4 {{ $tx['color'] === 'green' ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" /></svg>
                        @elseif($tx['icon'] === 'computer-desktop')
                            <svg class="w-4 h-4 {{ $tx['color'] === 'green' ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0H3" /></svg>
                        @else
                            <svg class="w-4 h-4 {{ $tx['color'] === 'green' ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-zinc-900 dark:text-dark-100 truncate">{{ $tx['name'] }}</p>
                        <p class="text-xs text-zinc-400 dark:text-dark-400">{{ $tx['date'] }}</p>
                    </div>
                    <span class="text-sm font-semibold shrink-0 {{ $tx['color'] === 'green' ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                        {{ $tx['amount'] }}
                    </span>
                </div>
                @endforeach
            </div>
            <div class="px-5 py-3 border-t border-zinc-50 dark:border-white/5">
                <button type="button" class="w-full text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors cursor-pointer">
                    Lihat Semua Transaksi →
                </button>
            </div>
        </div>

        {{-- Right column: Saldo + Target --}}
        <div class="space-y-4">

            {{-- Saldo Rekening --}}
            <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Saldo Rekening</h2>
                </div>
                <div class="px-5 py-3 space-y-3">
                    @foreach ([
                        ['name' => 'BCA Utama',    'amount' => 'Rp 8.240.000', 'color' => 'bg-blue-500'],
                        ['name' => 'Mandiri',       'amount' => 'Rp 3.180.000', 'color' => 'bg-yellow-500'],
                        ['name' => 'Dana E-Wallet', 'amount' => 'Rp 420.000',   'color' => 'bg-orange-400'],
                    ] as $acc)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <span class="h-2 w-2 rounded-full {{ $acc['color'] }} shrink-0"></span>
                            <span class="text-sm text-zinc-700 dark:text-dark-300">{{ $acc['name'] }}</span>
                        </div>
                        <span class="text-sm font-medium text-zinc-900 dark:text-dark-100">{{ $acc['amount'] }}</span>
                    </div>
                    @endforeach
                    <div class="pt-2 border-t border-zinc-100 dark:border-white/8 flex items-center justify-between">
                        <span class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-dark-400">Total</span>
                        <span class="text-base font-bold text-primary-600 dark:text-primary-400 font-heading">Rp 11.840.000</span>
                    </div>
                </div>
            </div>

            {{-- Target Tabungan --}}
            <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Target Tabungan</h2>
                </div>
                <div class="px-5 py-4 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-zinc-500 dark:text-dark-400">Dana Darurat</span>
                        <span class="text-xs font-bold text-primary-600 dark:text-primary-400">62%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-zinc-100 dark:bg-dark-600 overflow-hidden">
                        <div class="h-full rounded-full bg-primary-600 dark:bg-primary-500 transition-all duration-500" style="width: 62%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs text-zinc-400 dark:text-dark-400">
                        <span>Rp 18.600.000 terkumpul</span>
                        <span>dari Rp 30.000.000</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- ══════════════════════════════════════════
        BUDGET USAGE SECTION
    ══════════════════════════════════════════ --}}
    <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl fade-up fade-up-4">
        <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-white/8">
            <div>
                <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Penggunaan Anggaran</h2>
                <p class="text-xs text-zinc-500 dark:text-dark-400 mt-0.5">{{ now()->translatedFormat('F Y') }} · 4 kategori</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-900/40">
                74% terpakai
            </span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x divide-zinc-50 dark:divide-white/5">
            @foreach ([
                ['label' => 'Kebutuhan Pokok', 'used' => 6_500_000, 'total' => 10_000_000, 'pct' => 65, 'color' => 'bg-blue-500',   'textcolor' => 'text-blue-600 dark:text-blue-400'],
                ['label' => 'Transportasi',    'used' => 1_260_000, 'total' =>  3_000_000, 'pct' => 42, 'color' => 'bg-green-500',  'textcolor' => 'text-green-600 dark:text-green-400'],
                ['label' => 'Hiburan',         'used' => 2_640_000, 'total' =>  3_000_000, 'pct' => 88, 'color' => 'bg-red-500',    'textcolor' => 'text-red-600 dark:text-red-400'],
                ['label' => 'Kesehatan',       'used' =>   400_000, 'total' =>  2_000_000, 'pct' => 20, 'color' => 'bg-purple-500', 'textcolor' => 'text-purple-600 dark:text-purple-400'],
            ] as $b)
            <div class="px-5 py-4 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium text-zinc-700 dark:text-dark-300">{{ $b['label'] }}</span>
                    <span class="text-xs font-bold {{ $b['textcolor'] }}">{{ $b['pct'] }}%</span>
                </div>
                <div class="w-full h-1.5 rounded-full bg-zinc-100 dark:bg-dark-600 overflow-hidden">
                    <div class="h-full rounded-full {{ $b['color'] }} transition-all duration-500" style="width: {{ $b['pct'] }}%"></div>
                </div>
                <div class="flex items-center justify-between text-xs text-zinc-400 dark:text-dark-400">
                    <span>Rp {{ number_format($b['used'], 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($b['total'], 0, ',', '.') }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
