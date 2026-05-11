# MyFinance — Design System Master

> Source of truth untuk semua keputusan visual. Setiap halaman baru harus mengikuti panduan ini.
> Page-specific overrides disimpan di `design-system/pages/<nama-page>.md`.

---

## 1. Brand & Tone

- **Nama**: MyFinance — Personal Finance
- **Tone**: Professional, clean, trustworthy. Bukan playful, bukan luxury.
- **Referensi**: finance.kisantra.com (Professional Blue palette, zinc dark hierarchy)

---

## 2. Color Palette

Didefinisikan di `resources/css/app.css` dalam blok `@theme`.

### Primary (Blue)

| Token             | Hex       | Penggunaan                                          |
|-------------------|-----------|-----------------------------------------------------|
| `primary-50`      | `#eff6ff` | Background badge active, icon container light       |
| `primary-100`     | `#dbeafe` | —                                                   |
| `primary-200`     | `#bfdbfe` | —                                                   |
| `primary-300`     | `#93c5fd` | Hover tint dark bg, light accent                    |
| `primary-400`     | `#60a5fa` | Icon warna dark mode (`text-primary-400`)           |
| `primary-500`     | `#3b82f6` | Progress bar dark                                   |
| **`primary-600`** | `#2563eb` | Button bg, sidebar active item, link, badge         |
| `primary-700`     | `#1d4ed8` | Button hover                                        |
| `primary-800`     | `#1e40af` | —                                                   |
| `primary-900`     | `#1e3a8a` | Active item dark bg (`bg-primary-900/20`)           |
| `primary-950`     | `#172554` | —                                                   |

### Dark Mode Zinc Hierarchy

| Token        | Hex       | Peran                                      |
|--------------|-----------|--------------------------------------------|
| `dark-50`    | `#fafafa` | Bright text on dark                        |
| `dark-100`   | `#f4f4f5` | —                                          |
| `dark-200`   | `#e4e4e7` | Heading / prominent text                   |
| `dark-300`   | `#d4d4d8` | Body text / content text                   |
| `dark-400`   | `#a1a1aa` | Icon, placeholder, muted text              |
| `dark-500`   | `#71717a` | Divider                                    |
| `dark-600`   | `#3f3f46` | Border, hover bg, disabled bg              |
| `dark-700`   | `#27272a` | Card, modal, dropdown panel                |
| `dark-800`   | `#1e1e1e` | Input field background, card bg            |
| `dark-900`   | `#18181b` | Sidebar, header background                 |
| `dark-950`   | `#09090b` | Body / main content background             |

### Semantic Colors (Status)

| Warna  | Light                          | Dark                           | Penggunaan               |
|--------|--------------------------------|--------------------------------|--------------------------|
| Green  | `text-green-600`, `bg-green-50`  | `text-green-400`, `bg-green-900/20` | Pemasukan, positif    |
| Red    | `text-red-500`, `bg-red-50`      | `text-red-400`, `bg-red-900/20`     | Pengeluaran, negatif  |
| Amber  | `text-amber-500`, `bg-amber-50`  | `text-amber-400`, `bg-amber-900/20` | Warning, budget       |
| Blue   | `text-blue-600`, `bg-blue-50`    | `text-blue-400`, `bg-blue-900/20`   | Info, saldo bersih    |
| Purple | `text-purple-600`, `bg-purple-50`| `text-purple-400`, `bg-purple-900/20`| Kategori khusus      |

---

## 3. Typography

### Font Families

| Variabel          | Font                  | Penggunaan                              |
|-------------------|-----------------------|-----------------------------------------|
| `--font-sans`     | Inter                 | Body, paragraf, label, tabel            |
| `--font-heading`  | Plus Jakarta Sans     | h1–h6, `.font-heading`, angka besar     |
| `--font-mono`     | JetBrains Mono        | Kode, nilai teknis                      |

Font dimuat via Google Fonts di `layouts/app.blade.php`.

### Skala Teks

| Elemen                  | Kelas                                               |
|-------------------------|-----------------------------------------------------|
| Page title (H1)         | `text-3xl font-bold font-heading`                   |
| Page subtitle label     | `text-[11px] font-semibold uppercase tracking-[0.12em]` |
| Page subtitle text      | `text-sm text-zinc-500 dark:text-dark-400`          |
| Card heading (H2)       | `text-sm font-semibold font-heading`                |
| Stat number besar       | `text-2xl font-bold font-heading`                   |
| Label / caption         | `text-xs font-medium`                               |
| Tabel header            | `text-[11px] font-semibold uppercase tracking-wider` |
| Tabel body              | `text-sm`                                           |

### Gradient Title Pattern

Setiap halaman punya warna gradient judul yang berbeda:

```blade
{{-- Dashboard (biru) --}}
<h1 class="... bg-linear-to-r from-zinc-900 via-blue-800 to-indigo-800 dark:from-white dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent">

{{-- Pengeluaran (merah) --}}
<h1 class="... bg-linear-to-r from-zinc-900 via-red-700 to-orange-700 dark:from-white dark:via-red-200 dark:to-orange-200 bg-clip-text text-transparent">
```

---

## 4. Spacing & Layout

### Main Content Area

- Padding: `px-6 py-6` (dikustomisasi via `TallStackUi::customize()->layout()->block('main', ...)`)
- Header bar padding: `px-6` — harus sama dengan content agar flush/sejajar

### Sidebar

- Width expanded: `pl-72` (diatur TallStackUI)
- Width collapsed: `pl-22`
- Background: `bg-white dark:bg-[#18181b]`
- Border: `border-r border-zinc-200 dark:border-white/8`

### Card / Panel Standard

```blade
<div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-zinc-100 dark:border-white/8">
    {{-- Body --}}
    <div class="px-5 py-4">
    {{-- Footer --}}
    <div class="px-5 py-3 border-t border-zinc-50 dark:border-white/5">
```

### Stat Card Pattern (Horizontal)

```blade
<div class="bg-white dark:bg-[#1e1e1e] border border-zinc-200 dark:border-white/8 rounded-xl p-5 hover:shadow-md transition-shadow duration-150">
    <div class="flex items-center gap-4">
        <div class="h-12 w-12 bg-{color}-50 dark:bg-{color}-900/20 rounded-xl flex items-center justify-center shrink-0">
            {{-- icon h-6 w-6 --}}
        </div>
        <div class="min-w-0">
            <p class="text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400">Label</p>
            <p class="text-2xl font-bold text-zinc-900 dark:text-dark-50 font-heading mt-0.5">Nilai</p>
            <p class="text-xs ... mt-1">Keterangan</p>
        </div>
    </div>
</div>
```

Grid stat cards: `grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4`

---

## 5. TallStackUI Customization

Semua customization ada di `app/Providers/AppServiceProvider.php` method `configureTallStackUi()`.

### Komponen yang Dikustomisasi

| Komponen          | Block Utama              | Nilai                                                  |
|-------------------|--------------------------|--------------------------------------------------------|
| `sideBar()`       | `desktop.wrapper.second` | `bg-white dark:bg-[#18181b] border-r border-zinc-200 dark:border-white/8` |
| `sideBar('item')` | `item.state.current`     | `bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300` |
| `layout('header')`| `wrapper`                | `... px-6` (sama dengan main content)                 |
| `layout()`        | `main`                   | `mx-auto max-w-full px-6 py-6`                        |
| `stats()`         | `wrapper.first`          | `... rounded-xl border border-zinc-200 dark:border-white/8 bg-white dark:bg-[#1e1e1e]` |
| `card()`          | `wrapper.second`         | `... rounded-xl border border-zinc-200 dark:border-white/8 bg-white dark:bg-[#1e1e1e]` |

### Aturan Wajib TallStackUI v3

- Gunakan `TallStackUi::customize()` — BUKAN `personalize()` (itu v2, sudah tidak ada)
- JANGAN pakai `->flush()` sebelum block
- Selalu cek blok yang tersedia via `mcp__tallstackui__get-component-tool` sebelum menulis customization

---

## 6. Dark Mode

- Toggle: Alpine.js `x-data="{ dark: ... }"` di `<body>` tag di `layouts/app.blade.php`
- Class: `.dark` di `<html>` element
- Variant: `@custom-variant dark (&:where(.dark, .dark *));` di `app.css`
- Storage: `localStorage.setItem('theme', v ? 'dark' : 'light')`

---

## 7. Animasi

Kelas animasi didefinisikan di `app.css`:

```css
@keyframes fadeUp { from { opacity: 0; transform: translateY(6px); } to { opacity: 1; transform: translateY(0); } }
.fade-up   { animation: fadeUp 0.3s ease forwards; }
.fade-up-1 { animation-delay: 0.04s; opacity: 0; }
.fade-up-2 { animation-delay: 0.08s; opacity: 0; }
.fade-up-3 { animation-delay: 0.12s; opacity: 0; }
.fade-up-4 { animation-delay: 0.16s; opacity: 0; }
```

Gunakan secara berurutan: header → stats → content → section bawah.

---

## 8. Konvensi Livewire SFC

- File: `resources/views/components/⚡nama-page.blade.php`
- Route: `Route::livewire('/path', 'nama-page')->name('nama-page');` di `routes/web.php`
- Import: `use Livewire\Component;` — BUKAN `Livewire\Volt\Component` (Volt tidak diinstall)
- Atribut: `#[Layout('layouts.app')] #[Title('Judul')]`

---

## 9. Halaman yang Sudah Ada

| Halaman     | Route             | File                        | Status  |
|-------------|-------------------|-----------------------------|---------|
| Dashboard   | `/`               | `⚡home.blade.php`          | Selesai |
| Pengeluaran | `/pengeluaran`    | `⚡pengeluaran.blade.php`   | Selesai |
