<?php

if (! function_exists('sophdata_whatsapp_url')) {
    function sophdata_whatsapp_url(
        string $message = 'Olá! Quero iniciar atendimento com a SophData.',
        ?string $number = null,
    ): ?string {
        $configuredUrl = trim((string) config('sophdata.contact.whatsapp_url'));
        $encodedMessage = rawurlencode($message);

        if ($configuredUrl !== '') {
            $separator = str_contains($configuredUrl, '?') ? '&' : '?';

            return $configuredUrl.$separator.'text='.$encodedMessage;
        }

        $whatsappNumber = preg_replace('/\D+/', '', $number ?? (string) (
            config('sophdata.contact.whatsapp_number') ?: config('sophdata.brand.whatsapp')
        ));

        if ($whatsappNumber === '') {
            return null;
        }

        return 'https://wa.me/'.$whatsappNumber.'?text='.$encodedMessage;
    }
}
