<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use TallStackUi\Facades\TallStackUi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureTallStackUi();
    }

    /**
     * Apply design system to TallStackUI components via soft customization (v3 API).
     *
     * Color conventions (from app.css):
     *   Light: bg-white, border-zinc-200, text-zinc-900
     *   Dark:  dark-800=input, dark-700=card, dark-600=border, dark-400=muted
     */
    protected function configureTallStackUi(): void
    {
        // ── Sidebar shell — white light / dark-900 dark
        TallStackUi::customize()
            ->sideBar()
            ->block('desktop.wrapper.second', 'flex grow flex-col overflow-y-auto bg-white dark:bg-[#18181b] border-r border-zinc-200 dark:border-white/8')
            ->block('desktop.footer', 'p-0')
            ->block('mobile.wrapper.fourth', 'flex grow flex-col overflow-y-auto bg-white dark:bg-[#18181b]')
            ->block('mobile.footer', 'p-0');

        // ── Sidebar items — blue active, zinc muted
        TallStackUi::customize()
            ->sideBar('item')
            ->block('item.state.base', 'group flex items-center gap-x-3 rounded-lg px-3 py-2 text-sm font-medium transition-all duration-150 cursor-pointer')
            ->block('item.state.current', 'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300')
            ->block('item.state.normal', 'text-zinc-600 dark:text-dark-400 hover:bg-zinc-100 dark:hover:bg-dark-600/50 hover:text-zinc-900 dark:hover:text-dark-200')
            ->block('item.icon', 'h-4 w-4 shrink-0')
            ->block('group.button', 'group flex w-full items-center gap-x-3 rounded-lg px-3 py-2 text-left text-sm font-medium text-zinc-600 dark:text-dark-400 hover:bg-zinc-100 dark:hover:bg-dark-600/50 hover:text-zinc-900 dark:hover:text-dark-200 transition-all duration-150 cursor-pointer')
            ->block('group.icon.base', 'h-4 w-4 shrink-0');

        // ── Layout header — clean, minimal; px-6 matches main content padding
        TallStackUi::customize()
            ->layout('header')
            ->block('wrapper', 'sticky top-0 z-40 flex h-14 shrink-0 items-center border-b border-zinc-200 dark:border-white/8 bg-white dark:bg-[#18181b] px-6');

        // ── Layout main — reduce default p-10 to px-6 py-6 to match header
        TallStackUi::customize()
            ->layout()
            ->block('main', 'mx-auto max-w-full px-6 py-6');

        // ── Stats card — horizontal layout reference style
        TallStackUi::customize()
            ->stats()
            ->block('wrapper.first', 'relative flex flex-col rounded-xl border border-zinc-200 dark:border-white/8 bg-white dark:bg-[#1e1e1e] p-5 transition-shadow duration-150 hover:shadow-md')
            ->block('title', 'text-xs font-medium uppercase tracking-widest text-zinc-500 dark:text-dark-400')
            ->block('number', 'mt-1.5 text-2xl font-bold tracking-tight text-zinc-900 dark:text-dark-50')
            ->block('slots.footer', 'mt-2 text-xs text-zinc-500 dark:text-dark-400');

        // ── Card — clean, rounded-xl, white/dark-700
        TallStackUi::customize()
            ->card()
            ->block('wrapper.second', 'relative flex flex-col rounded-xl border border-zinc-200 dark:border-white/8 bg-white dark:bg-[#1e1e1e] shadow-sm hover:shadow-md transition-shadow duration-150')
            ->block('header.wrapper.base', 'flex items-center justify-between px-5 py-4')
            ->block('header.wrapper.border', 'border-b border-zinc-100 dark:border-white/8')
            ->block('header.text.size', 'text-sm font-semibold')
            ->block('header.text.color', 'text-zinc-900 dark:text-dark-50')
            ->block('body', 'px-5 py-4 text-sm text-zinc-600 dark:text-dark-300')
            ->block('footer.wrapper', 'border-t border-zinc-100 dark:border-white/8 px-5 py-3');
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
