<?php

test('business pages render standardized primary ctas and contextual whatsapp links', function (
    string $path,
    string $primaryCta,
    string $messageFragment,
) {
    $content = $this->get($path)
        ->assertOk()
        ->assertSee($primaryCta)
        ->getContent();

    expect($content)
        ->toContain('https://wa.me/'.config('sophdata.brand.whatsapp'))
        ->toContain(rawurlencode($messageFragment));
})->with([
    ['/para-empresas', 'Solicitar diagnóstico empresarial', 'Olá! Quero solicitar um diagnóstico empresarial com a SophData.'],
    ['/para-empresas/desenvolvimento-de-software', 'Solicitar diagnóstico digital', 'Olá! Quero solicitar um diagnóstico digital para minha empresa com a SophData.'],
    ['/para-empresas/infraestrutura-corporativa-gerenciada', 'Solicitar diagnóstico de infraestrutura', 'Olá! Quero avaliar a infraestrutura de TI da minha empresa com a SophData.'],
    ['/para-empresas/servidores-e-ambientes-corporativos', 'Avaliar meu ambiente', 'Olá! Quero avaliar servidores, backup ou ambiente corporativo para minha empresa com a SophData.'],
    ['/para-empresas/planos', 'Solicitar diagnóstico empresarial', 'Olá! Quero entender qual plano da SophData faz mais sentido para minha empresa.'],
    ['/para-empresas/como-trabalhamos', 'Solicitar diagnóstico empresarial', 'Olá! Quero solicitar um diagnóstico empresarial com a SophData.'],
    ['/para-empresas/contato', 'Iniciar atendimento', 'Olá! Quero solicitar um diagnóstico empresarial com a SophData.'],
]);

test('business ctas keep secondary internal conversion paths available', function () {
    $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('Ver soluções para empresas')
        ->assertSee('#solucoes', false);

    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->assertOk()
        ->assertSee('Ver pacotes de infraestrutura')
        ->assertSee('/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados', false);

    $this->get('/para-empresas/planos')
        ->assertOk()
        ->assertSee('Como Trabalhamos')
        ->assertSee('/para-empresas/como-trabalhamos', false);

    $this->get('/para-empresas/como-trabalhamos')
        ->assertOk()
        ->assertSee('Ver planos empresariais')
        ->assertSee('/para-empresas/planos', false);
});

test('business category pages keep contextual ctas', function (
    string $path,
    string $primaryCta,
    string $messageFragment,
) {
    $content = $this->get($path)
        ->assertOk()
        ->assertSee($primaryCta)
        ->getContent();

    expect($content)
        ->toContain('https://wa.me/'.config('sophdata.brand.whatsapp'))
        ->toContain(rawurlencode($messageFragment));
})->with([
    ['/para-empresas/desenvolvimento-de-software/sistemas-sob-medida', 'Mapear meu sistema', 'Olá! Quero mapear um sistema sob medida para minha empresa.'],
    ['/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal', 'Contratar administração mensal', 'Olá! Quero entender os planos de administração mensal de infraestrutura da SophData.'],
    ['/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', 'Proteger meus dados', 'Olá! Quero avaliar backup empresarial para proteger os dados da minha empresa.'],
]);

test('personal portal remains available after business cta refactor', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você');
});
