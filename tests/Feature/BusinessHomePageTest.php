<?php

test('business home works as the main entrance for the enterprise catalog', function () {
    $content = $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('Tecnologia organizada para empresas que precisam crescer com')
        ->assertSee('Sua empresa sente algum desses problemas?')
        ->assertSee('Soluções empresariais organizadas por necessidade')
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Responsável técnico')
        ->assertSee('Contratação conforme a necessidade da empresa')
        ->assertSee('Como trabalhamos')
        ->assertSee('Caminhos recomendados para começar')
        ->assertSee('Solicitar diagnóstico empresarial')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/desenvolvimento-de-software')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos')
        ->toContain('/para-empresas/desenvolvimento-de-software/sites-e-portais')
        ->toContain('/para-empresas/desenvolvimento-de-software/sistemas-sob-medida')
        ->toContain('/para-empresas/contato')
        ->toContain('img/sophdata/portals/business-hero.webp')
        ->toContain('img/sophdata/cta/contact-banner.webp');
});

test('personal portal remains unchanged by the business home refactor', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Soluções empresariais organizadas por necessidade')
        ->assertDontSee('Contratação conforme a necessidade da empresa')
        ->assertDontSee('Caminhos recomendados para começar');
});
