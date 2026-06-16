@props([
    'floating' => false,
    'message' => 'Olá, gostaria de conhecer as soluções da SophData.',
])

@php
    $whatsappUrl = sophdata_whatsapp_url($message);
@endphp

<a
    href="{{ $whatsappUrl }}"
    target="_blank"
    rel="noopener noreferrer"
    {{ $attributes->class([
        'inline-flex items-center gap-2 rounded-full bg-action-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-action-500/20 transition hover:bg-action-600 focus:outline-none focus:ring-4 focus:ring-action-400/30',
        'fixed right-4 bottom-4 z-50 size-14 justify-center p-0 sm:right-6 sm:bottom-6' => $floating,
    ]) }}
>
    <svg viewBox="0 0 24 24" class="size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
        <path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4A8 8 0 1 1 20 11.5Z"/>
        <path d="M9 8.5c.4 2.5 2 4.1 4.5 4.8l1-1c.2-.2.5-.2.7-.1l2 .9"/>
    </svg>
    @unless ($floating)
        {{ $slot->isEmpty() ? 'Iniciar atendimento' : $slot }}
    @else
        <span class="sr-only">Iniciar atendimento</span>
    @endunless
</a>
