@props([
    'message' => null,
])

@php
    $message = $message ?? match (true) {
        request()->is('para-empresas*') => config('sophdata.whatsapp_messages.business'),
        request()->is('para-voce*') => config('sophdata.whatsapp_messages.personal'),
        default => config('sophdata.whatsapp_messages.neutral'),
    };
    $whatsappUrl = sophdata_whatsapp_url($message);
@endphp

@if ($whatsappUrl)
<a
    href="{{ $whatsappUrl }}"
    target="_blank"
    rel="noopener noreferrer"
    class="whatsapp-floating fixed right-4 z-30 grid size-13 place-items-center rounded-full border-2 border-white bg-action-500 text-white shadow-lg shadow-action-500/25 transition hover:-translate-y-1 hover:bg-action-600 focus:outline-none focus:ring-4 focus:ring-action-400/30 sm:right-6 sm:size-14"
    aria-label="Iniciar atendimento com a {{ config('sophdata.brand.name') }}"
>
    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
        <path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4A8 8 0 1 1 20 11.5Z"/>
        <path d="M9 8.5c.4 2.5 2 4.1 4.5 4.8l1-1c.2-.2.5-.2.7-.1l2 .9"/>
    </svg>
</a>
@endif
