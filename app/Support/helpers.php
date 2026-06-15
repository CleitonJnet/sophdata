<?php

if (! function_exists('sophdata_whatsapp_url')) {
    function sophdata_whatsapp_url(
        string $message = 'Olá, gostaria de conhecer as soluções da SophData.',
        ?string $number = null,
    ): string {
        $whatsappNumber = preg_replace('/\D+/', '', $number ?? (string) config('sophdata.brand.whatsapp'));

        return 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode($message);
    }
}
