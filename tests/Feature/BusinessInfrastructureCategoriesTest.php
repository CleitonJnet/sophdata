<?php

test('infrastructure internal category pages render configured content', function (string $slug, string $title, string $expectedContent) {
    $this->get("/para-empresas/infraestrutura-corporativa-gerenciada/{$slug}")
        ->assertOk()
        ->assertSee("Voltar para Infraestrutura Corporativa Gerenciada")
        ->assertSee($title)
        ->assertSee('Problemas que essa solução ajuda a resolver')
        ->assertSee($expectedContent)
        ->assertSee('Outras soluções de Infraestrutura Corporativa Gerenciada')
        ->assertSee('/para-empresas/contato', false);
})->with([
    ['hardware-corporativo', 'Hardware Corporativo', 'Diagnóstico técnico'],
    ['redes-corporativas', 'Redes Corporativas', 'Diagnóstico de rede'],
    ['wifi-corporativo', 'Wi-Fi Corporativo', 'Avaliação do ambiente'],
    ['administracao-mensal', 'Administração Mensal', 'Ativo adicional'],
    ['pacotes-integrados', 'Pacotes Integrados', 'Infraestrutura Starter'],
]);

test('infrastructure hardware page renders implementation profiles and combinations', function () {
    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo')
        ->assertOk()
        ->assertSee('Pacotes de implantação')
        ->assertSee('Acompanhamento mensal')
        ->assertSee('O que pode incluir na implantação')
        ->assertSee('Perfis de empresa que costumam se encaixar')
        ->assertSee('Caminhos de contratação')
        ->assertSee('Estações em Ordem');
});

test('infrastructure monthly administration page renders plans and indicated profiles', function () {
    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal')
        ->assertOk()
        ->assertSee('Essencial')
        ->assertSee('Profissional')
        ->assertSee('Gerenciado')
        ->assertSee('Corporativo')
        ->assertSee('Ponto Wi-Fi adicional')
        ->assertSee('Igreja pequena');
});

test('infrastructure category returns not found for unknown slug', function () {
    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada/categoria-inexistente')
        ->assertNotFound();
});

test('personal portal remains available after infrastructure category pages', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você');
});
