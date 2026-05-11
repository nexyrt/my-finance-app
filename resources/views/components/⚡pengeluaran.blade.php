<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Layout('layouts.app')] #[Title('Pengeluaran')] class extends Component {

    /** @var array<int, array{tanggal: string, kategori: string, deskripsi: string, jumlah: int|string, metode: string}> */
    public array $items = [];

    public bool $showForm = false;
    public bool $saved = false;

    public string $filterBulan = '';
    public string $filterKategori = '';

    public function mount(): void
    {
        $this->filterBulan = now()->format('Y-m');
        $this->addItem();
    }

    public function addItem(): void
    {
        $this->items[] = [
            'tanggal'   => now()->format('Y-m-d'),
            'kategori'  => '',
            'deskripsi' => '',
            'jumlah'    => '',
            'metode'    => '',
        ];
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);

        if (empty($this->items)) {
            $this->addItem();
        }
    }

    public function simpan(): void
    {
        $this->validate([
            'items'                => ['required', 'array', 'min:1'],
            'items.*.tanggal'      => ['required', 'date'],
            'items.*.kategori'     => ['required', 'string'],
            'items.*.deskripsi'    => ['required', 'string', 'max:255'],
            'items.*.jumlah'       => ['required', 'numeric', 'min:1'],
            'items.*.metode'       => ['required', 'string'],
        ], [
            'items.*.tanggal.required'   => 'Tanggal wajib diisi.',
            'items.*.kategori.required'  => 'Kategori wajib dipilih.',
            'items.*.deskripsi.required' => 'Deskripsi wajib diisi.',
            'items.*.jumlah.required'    => 'Jumlah wajib diisi.',
            'items.*.jumlah.min'         => 'Jumlah harus lebih dari 0.',
            'items.*.metode.required'    => 'Metode pembayaran wajib dipilih.',
        ]);

        // TODO: simpan ke database
        $this->saved = true;
        $this->items = [];
        $this->addItem();
        $this->showForm = false;

        $this->dispatch('tsui:toast', variant: 'success', description: count($this->items) . ' pengeluaran berhasil disimpan.');
    }

    public function batalkan(): void
    {
        $this->items = [];
        $this->addItem();
        $this->showForm = false;
        $this->resetValidation();
    }

    public function getTotalProperty(): int
    {
        return (int) collect($this->items)->sum(fn ($i) => (int) ($i['jumlah'] ?? 0));
    }

    /** @return array<string> */
    public function getKategoriOptionsProperty(): array
    {
        return [
            'Kebutuhan Pokok',
            'Transportasi',
            'Makanan & Minuman',
            'Hiburan',
            'Kesehatan',
            'Pendidikan',
            'Tagihan & Utilitas',
            'Belanja Online',
            'Pakaian',
            'Lainnya',
        ];
    }

    /** @return array<string> */
    public function getMetodeOptionsProperty(): array
    {
        return [
            'Tunai',
            'Transfer Bank',
            'Kartu Debit',
            'Kartu Kredit',
            'QRIS',
            'E-Wallet (GoPay)',
            'E-Wallet (OVO)',
            'E-Wallet (Dana)',
            'E-Wallet (ShopeePay)',
        ];
    }

    /** @return array<int, array{name: string, amount: int, pct: int, color: string, textcolor: string}> */
    public function getRingkasanKategoriProperty(): array
    {
        return [
            ['name' => 'Kebutuhan Pokok', 'amount' => 6_500_000, 'pct' => 65, 'color' => 'bg-blue-500',   'textcolor' => 'text-blue-600 dark:text-blue-400'],
            ['name' => 'Transportasi',    'amount' => 1_260_000, 'pct' => 42, 'color' => 'bg-green-500',  'textcolor' => 'text-green-600 dark:text-green-400'],
            ['name' => 'Hiburan',         'amount' => 2_640_000, 'pct' => 88, 'color' => 'bg-red-500',    'textcolor' => 'text-red-600 dark:text-red-400'],
            ['name' => 'Kesehatan',       'amount' =>   400_000, 'pct' => 20, 'color' => 'bg-purple-500', 'textcolor' => 'text-purple-600 dark:text-purple-400'],
        ];
    }

}; ?>

<div class="space-y-6">

    {{-- ══════════════════════════════════════════
        PAGE HEADER
    ══════════════════════════════════════════ --}}
    <div class="flex flex-row items-start justify-between gap-4 fade-up fade-up-1">
        <div>
            <p class="text-[11px] font-semibold text-zinc-400 dark:text-dark-400 uppercase tracking-[0.12em] mb-0.5">
                {{ now()->translatedFormat('F Y') }}
            </p>
            <h1 class="text-3xl font-bold font-heading leading-tight bg-linear-to-r from-zinc-900 via-red-700 to-orange-700 dark:from-white dark:via-red-200 dark:to-orange-200 bg-clip-text text-transparent">
                Pengeluaran
            </h1>
            <p class="text-sm text-zinc-500 dark:text-dark-400 mt-1">
                Catat dan kelola seluruh pengeluaran Anda
            </p>
        </div>
        <button
            type="button"
            wire:click="$set('showForm', true)"
            class="inline-flex items-center gap-2 h-9 px-4 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition-colors cursor-pointer shrink-0 mt-1"
        >
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Pengeluaran
        </button>
    </div>

    {{-- ══════════════════════════════════════════
        STAT CARDS
    ══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 fade-up fade-up-2">

        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-red-50 dark:bg-red-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-red-500 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Total Bulan Ini</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">18.200.000</p>
                    <p class="text-xs text-red-500 dark:text-red-400 mt-1 font-medium">+4,2% dari bulan lalu</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-amber-50 dark:bg-amber-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-amber-500 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Transaksi</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">24<span class="text-base font-medium text-zinc-400 dark:text-dark-400"> entri</span></p>
                    <p class="text-xs text-zinc-400 dark:text-dark-400 mt-1">Bulan ini</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-purple-50 dark:bg-purple-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Kategori Terbesar</p>
                    <p class="text-lg font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5 leading-tight">Keb. Pokok</p>
                    <p class="text-xs text-zinc-400 dark:text-dark-400 mt-1">Rp 6.500.000</p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-blue-50 dark:bg-blue-900/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125H18M2.25 10.5H3.375c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125H2.25" />
                    </svg>
                </div>
                <div class="min-w-0">
                    <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Rata-rata/Hari</p>
                    <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">587.000</p>
                    <p class="text-xs text-zinc-400 dark:text-dark-400 mt-1">Dari 31 hari aktif</p>
                </div>
            </div>
        </div>

    </div>

    {{-- ══════════════════════════════════════════
        REPEATER FORM (slide-down panel)
    ══════════════════════════════════════════ --}}
    @if($showForm)
    <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl fade-up fade-up-1">

        {{-- Form Header --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-white/8">
            <div>
                <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Input Pengeluaran</h2>
                <p class="text-xs text-zinc-500 dark:text-dark-400 mt-0.5">
                    {{ count($items) }} {{ count($items) === 1 ? 'entri' : 'entri' }} ditambahkan
                    @if($this->total > 0)
                        · Total: <span class="font-semibold text-red-600 dark:text-red-400">Rp {{ number_format($this->total, 0, ',', '.') }}</span>
                    @endif
                </p>
            </div>
            <button
                type="button"
                wire:click="batalkan"
                class="flex h-7 w-7 items-center justify-center rounded-lg text-zinc-400 dark:text-dark-400 hover:bg-zinc-100 dark:hover:bg-dark-600 hover:text-zinc-700 dark:hover:text-dark-200 transition-colors cursor-pointer"
            >
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Repeater Rows --}}
        <div class="divide-y divide-zinc-50 dark:divide-white/5">
            @foreach($items as $index => $item)
            <div class="px-5 py-4" wire:key="item-{{ $index }}">

                {{-- Row header --}}
                <div class="flex items-center justify-between mb-3">
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 dark:text-dark-400">
                        <span class="flex h-5 w-5 items-center justify-center rounded-full bg-zinc-100 dark:bg-dark-600 text-[10px] font-bold text-zinc-600 dark:text-dark-300">
                            {{ $index + 1 }}
                        </span>
                        Entri Pengeluaran
                    </span>
                    @if(count($items) > 1)
                    <button
                        type="button"
                        wire:click="removeItem({{ $index }})"
                        class="inline-flex items-center gap-1 text-xs text-red-500 dark:text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-colors cursor-pointer"
                    >
                        <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                    @endif
                </div>

                {{-- Form Fields Grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

                    {{-- Tanggal --}}
                    <div class="lg:col-span-1">
                        <x-date
                            wire:model="items.{{ $index }}.tanggal"
                            label="Tanggal"
                            format="YYYY-MM-DD"
                            helpers
                        />
                    </div>

                    {{-- Kategori --}}
                    <div class="lg:col-span-1">
                        <x-select.styled
                            wire:model="items.{{ $index }}.kategori"
                            label="Kategori"
                            placeholder="Pilih kategori"
                            :options="$this->kategoriOptions"
                            searchable
                        />
                    </div>

                    {{-- Deskripsi --}}
                    <div class="lg:col-span-1">
                        <x-input
                            wire:model="items.{{ $index }}.deskripsi"
                            label="Deskripsi"
                            placeholder="Keterangan pengeluaran"
                        />
                    </div>

                    {{-- Jumlah --}}
                    <div class="lg:col-span-1">
                        <x-currency
                            wire:model="items.{{ $index }}.jumlah"
                            label="Jumlah"
                            locale="id-ID"
                            :decimals="0"
                            :precision="0"
                            symbol
                            mutate
                        />
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div class="lg:col-span-1">
                        <x-select.styled
                            wire:model="items.{{ $index }}.metode"
                            label="Metode Bayar"
                            placeholder="Pilih metode"
                            :options="$this->metodeOptions"
                        />
                    </div>

                </div>

                {{-- Validation errors for this row --}}
                @if($errors->has("items.{$index}.*"))
                <div class="mt-2 flex flex-wrap gap-1">
                    @foreach(['tanggal', 'kategori', 'deskripsi', 'jumlah', 'metode'] as $field)
                        @error("items.{$index}.{$field}")
                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-red-50 dark:bg-red-900/20 text-xs text-red-600 dark:text-red-400 border border-red-200 dark:border-red-900/40">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
                            {{ $message }}
                        </span>
                        @enderror
                    @endforeach
                </div>
                @endif

            </div>
            @endforeach
        </div>

        {{-- Form Footer --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-5 py-4 border-t border-zinc-100 dark:border-white/8 bg-zinc-50/50 dark:bg-dark-800/30 rounded-b-xl">

            {{-- Add Row Button --}}
            <button
                type="button"
                wire:click="addItem"
                class="inline-flex items-center gap-2 h-8 px-3.5 rounded-lg border border-dashed border-zinc-300 dark:border-dark-500 bg-transparent text-xs font-medium text-zinc-600 dark:text-dark-400 hover:border-primary-400 dark:hover:border-primary-600 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-150 cursor-pointer"
            >
                <svg class="w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Baris
            </button>

            {{-- Total + Actions --}}
            <div class="flex items-center gap-3 w-full sm:w-auto">
                @if($this->total > 0)
                <div class="flex items-center gap-1.5 text-sm mr-2">
                    <span class="text-zinc-500 dark:text-dark-400">Total:</span>
                    <span class="font-bold text-red-600 dark:text-red-400 font-heading">Rp {{ number_format($this->total, 0, ',', '.') }}</span>
                </div>
                @endif
                <button
                    type="button"
                    wire:click="batalkan"
                    class="h-9 px-4 rounded-lg border border-zinc-200 dark:border-dark-600 bg-white dark:bg-dark-700 text-zinc-600 dark:text-dark-300 text-sm font-medium hover:bg-zinc-50 dark:hover:bg-dark-600 transition-colors cursor-pointer"
                >
                    Batal
                </button>
                <button
                    type="button"
                    wire:click="simpan"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-60 cursor-not-allowed"
                    class="inline-flex items-center gap-2 h-9 px-5 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition-colors cursor-pointer"
                >
                    <span wire:loading.remove wire:target="simpan">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </span>
                    <span wire:loading wire:target="simpan">
                        <svg class="w-4 h-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    Simpan Semua
                </button>
            </div>

        </div>
    </div>
    @endif

    {{-- ══════════════════════════════════════════
        MAIN CONTENT: Filter + Tabel + Ringkasan
    ══════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 fade-up fade-up-3">

        {{-- Tabel Pengeluaran (2/3 width) --}}
        <div class="lg:col-span-2 bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">

            {{-- Table Header + Filter --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                <div>
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Riwayat Pengeluaran</h2>
                    <p class="text-xs text-zinc-500 dark:text-dark-400 mt-0.5">{{ now()->translatedFormat('F Y') }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <x-select.native
                        wire:model.live="filterKategori"
                        :options="collect([''] + $this->kategoriOptions)->mapWithKeys(fn($v, $k) => $k === 0 ? ['' => 'Semua Kategori'] : [$v => $v])->toArray()"
                        class="text-xs h-8 !py-0"
                    />
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-zinc-50 dark:border-white/5">
                            <th class="px-5 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-dark-400">Tanggal</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-dark-400">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-dark-400">Kategori</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-dark-400">Metode</th>
                            <th class="px-5 py-3 text-right text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-dark-400">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-50 dark:divide-white/5">
                        @foreach([
                            ['tanggal' => '10 Mei', 'deskripsi' => 'Belanja Bulanan', 'kategori' => 'Kebutuhan Pokok', 'metode' => 'Transfer Bank', 'jumlah' => 2_350_000],
                            ['tanggal' => '9 Mei',  'deskripsi' => 'Tagihan Listrik', 'kategori' => 'Tagihan & Utilitas', 'metode' => 'Transfer Bank', 'jumlah' => 450_000],
                            ['tanggal' => '8 Mei',  'deskripsi' => 'Makan Siang',     'kategori' => 'Makanan & Minuman', 'metode' => 'QRIS',          'jumlah' => 85_000],
                            ['tanggal' => '7 Mei',  'deskripsi' => 'Grab/GoJek',      'kategori' => 'Transportasi',      'metode' => 'E-Wallet (GoPay)', 'jumlah' => 45_000],
                            ['tanggal' => '6 Mei',  'deskripsi' => 'Netflix',         'kategori' => 'Hiburan',           'metode' => 'Kartu Kredit',  'jumlah' => 186_000],
                            ['tanggal' => '5 Mei',  'deskripsi' => 'Apotek',          'kategori' => 'Kesehatan',         'metode' => 'Tunai',         'jumlah' => 125_000],
                            ['tanggal' => '4 Mei',  'deskripsi' => 'Spotify',         'kategori' => 'Hiburan',           'metode' => 'Kartu Debit',   'jumlah' => 54_990],
                            ['tanggal' => '3 Mei',  'deskripsi' => 'Bensin',          'kategori' => 'Transportasi',      'metode' => 'Tunai',         'jumlah' => 150_000],
                        ] as $row)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-dark-700/40 transition-colors">
                            <td class="px-5 py-3 text-xs text-zinc-500 dark:text-dark-400 whitespace-nowrap">{{ $row['tanggal'] }}</td>
                            <td class="px-4 py-3">
                                <span class="text-sm font-medium text-zinc-800 dark:text-dark-100">{{ $row['deskripsi'] }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-zinc-100 dark:bg-dark-600 text-zinc-600 dark:text-dark-300">
                                    {{ $row['kategori'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-zinc-500 dark:text-dark-400">{{ $row['metode'] }}</td>
                            <td class="px-5 py-3 text-right text-sm font-semibold text-red-600 dark:text-red-400 whitespace-nowrap">
                                -Rp {{ number_format($row['jumlah'], 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-zinc-200 dark:border-white/8">
                            <td colspan="4" class="px-5 py-3 text-xs font-semibold text-zinc-500 dark:text-dark-400">Total (8 transaksi)</td>
                            <td class="px-5 py-3 text-right text-sm font-bold text-red-600 dark:text-red-400">-Rp 3.445.990</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Load more --}}
            <div class="px-5 py-3 border-t border-zinc-50 dark:border-white/5">
                <button type="button" class="w-full text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors cursor-pointer">
                    Lihat Semua Pengeluaran →
                </button>
            </div>
        </div>

        {{-- Ringkasan Kategori (1/3 width) --}}
        <div class="space-y-4">

            {{-- Pie breakdown --}}
            <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Per Kategori</h2>
                    <p class="text-xs text-zinc-500 dark:text-dark-400 mt-0.5">{{ now()->translatedFormat('F Y') }}</p>
                </div>
                <div class="px-5 py-4 space-y-3">
                    @foreach($this->ringkasanKategori as $kat)
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-medium text-zinc-700 dark:text-dark-300">{{ $kat['name'] }}</span>
                            <span class="text-xs font-bold {{ $kat['textcolor'] }}">{{ $kat['pct'] }}%</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex-1 h-1.5 rounded-full bg-zinc-100 dark:bg-dark-600 overflow-hidden">
                                <div class="h-full rounded-full {{ $kat['color'] }} transition-all duration-500" style="width: {{ $kat['pct'] }}%"></div>
                            </div>
                        </div>
                        <p class="text-[11px] text-zinc-400 dark:text-dark-400">Rp {{ number_format($kat['amount'], 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Metode pembayaran --}}
            <div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
                <div class="px-5 py-4 border-b border-zinc-100 dark:border-white/8">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-dark-50 font-heading">Metode Pembayaran</h2>
                </div>
                <div class="px-5 py-3 space-y-2">
                    @foreach([
                        ['name' => 'Transfer Bank', 'pct' => 44, 'amount' => 2_800_000],
                        ['name' => 'QRIS / E-Wallet', 'pct' => 28, 'amount' => 1_750_000],
                        ['name' => 'Kartu Kredit', 'pct' => 18, 'amount' => 1_140_000],
                        ['name' => 'Tunai', 'pct' => 10, 'amount' => 650_000],
                    ] as $m)
                    <div class="flex items-center justify-between py-1">
                        <div class="flex items-center gap-2.5">
                            <div class="h-1.5 w-1.5 rounded-full bg-primary-500 dark:bg-primary-400"></div>
                            <span class="text-xs text-zinc-600 dark:text-dark-300">{{ $m['name'] }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[11px] text-zinc-400 dark:text-dark-400">{{ $m['pct'] }}%</span>
                            <span class="text-xs font-medium text-zinc-700 dark:text-dark-200 w-24 text-right">Rp {{ number_format($m['amount'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

</div>
