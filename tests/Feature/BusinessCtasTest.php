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
    ['/para-empresas', 'Solicitar diagnostico empresarial', 'Ola! Quero solicitar um diagnostico empresarial com a SophData.'],
    ['/para-empresas/desenvolvimento-de-software', 'Solicitar diagnostico digital', 'Ola! Quero solicitar um diagnostico digital para minha empresa com a SophData.'],
    ['/para-empresas/infraestrutura-corporativa-gerenciada', 'Solicitar diagnostico de infraestrutura', 'Ola! Quero avaliar a infraestrutura de TI da minha empresa com a SophData.'],
    ['/para-empresas/servidores-e-ambientes-corporativos', 'Avaliar meu ambiente', 'Ola! Quero avaliar servidores, backup ou ambiente corporativo para minha empresa com a SophData.'],
    ['/para-empresas/planos', 'Solicitar diagnostico empresarial', 'Ola! Quero entender qual plano da SophData faz mais sentido para minha empresa.'],
    ['/para-empresas/como-trabalhamos', 'Solicitar diagnostico empresarial', 'Ola! Quero solicitar um diagnostico empresarial com a SophData.'],
    ['/para-empresas/contato', 'Chamar no WhatsApp', 'Ola! Quero solicitar um diagnostico empresarial com a SophData.'],
]);

test('business ctas keep secondary internal conversion paths available', function () {
    $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('Conhecer solucoes')
        ->assertSee('#solucoes', false);

    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->assertOk()
        ->assertSee('Ver pacotes de infraestrutura')
        ->assertSee('/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados', false);

    $this->get('/para-empresas/planos')
        ->assertOk()
        ->assertSee('Como trabalhamos')
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
    ['/para-empresas/desenvolvimento-de-software/sistemas-sob-medida', 'Mapear meu sistema', 'Ola! Quero avaliar um sistema sob medida para minha empresa.'],
    ['/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal', 'Contratar administracao mensal', 'Ola! Quero falar sobre administracao mensal de TI para minha empresa.'],
    ['/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', 'Proteger meus dados', 'Ola! Quero proteger os dados da minha empresa com uma solucao de backup.'],
]);

test('personal portal remains available after business cta refactor', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você');
});
