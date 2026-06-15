@props(['light' => false])

<a href="{{ route('home') }}" aria-label="{{ config('sophdata.brand.name') }} - início"
    class="flex justify-start items-center gap-2">
    <img src="{{ asset('img/SophData-logo.svg') }}" alt="{{ config('sophdata.brand.name') }} logo" class="h-9" />
    <img src="{{ asset('img/SophData-text.svg') }}" alt="{{ config('sophdata.brand.name') }} logo" class="h-9 pt-1.5" />
</a>
