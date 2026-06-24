<?php

test('software catalog main page presents the business development offer', function () {
    $content = $this->get('/para-empresas/desenvolvimento-de-software')
        ->assertOk()
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Sites, sistemas, automacoes')
        ->assertSee('Sua empresa ainda depende de processos manuais?')
        ->assertSee('Desenvolvimento pensado para a operacao da empresa')
        ->assertSee('Diagnostico e Discovery')
        ->assertSee('Sites e Portais')
        ->assertSee('Sistemas Sob Medida')
        ->assertSee('Automacoes e Integracoes')
        ->assertSee('Sustentacao e Evolucao')
        ->assertSee('Como conduzimos um projeto de desenvolvimento')
        ->assertSee('Caminhos comerciais para comecar')
        ->assertSee('Presenca Digital Starter')
        ->assertSee('Sistema Administrativo Starter')
        ->assertSee('Clareza antes de desenvolver')
        ->assertSee('Solicitar diagnostico digital')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/desenvolvimento-de-software/sites-e-portais')
        ->toContain('/para-empresas/desenvolvimento-de-software/sistemas-sob-medida')
        ->toContain('/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes')
        ->toContain('/para-empresas/desenvolvimento-de-software/sustentacao-e-evolucao')
        ->toContain('/para-empresas/contato')
        ->toContain('img/sophdata/services/business/sites-e-sistemas-hero.webp');
});

test('software internal category pages render configured content', function (string $slug, string $expectedContent) {
    $this->get("/para-empresas/desenvolvimento-de-software/{$slug}")
        ->assertOk()
        ->assertSee('Voltar para Desenvolvimento de Software')
        ->assertSee('Problemas que essa solucao ajuda a resolver')
        ->assertSee($expectedContent)
        ->assertSee('Categorias relacionadas')
        ->assertSee('/para-empresas/contato', false);
})->with([
    ['diagnostico-e-discovery', 'Diagnostico Digital Express'],
    ['sites-e-portais', 'Landing Starter'],
    ['lojas-e-catalogos-digitais', 'Catalogo Digital Starter'],
    ['sistemas-sob-medida', 'Sistema Cadastro Essencial'],
    ['sistemas-por-segmento', 'Sistema de membros e eventos'],
    ['portais-area-logada-pwa', 'Area Logada Starter'],
    ['automacoes-e-integracoes', 'Formulario inteligente'],
    ['deploy-hospedagem', 'Ambiente Essencial'],
    ['sustentacao-e-evolucao', 'Horas 10'],
]);

test('software internal category returns not found for unknown slug', function () {
    $this->get('/para-empresas/desenvolvimento-de-software/categoria-inexistente')
        ->assertNotFound();
});

test('personal portal remains available after the software page refactor', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Caminhos comerciais para comecar')
        ->assertDontSee('Como conduzimos um projeto de desenvolvimento');
});
