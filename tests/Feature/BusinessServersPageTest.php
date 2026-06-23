<?php

test('servers catalog main page presents the corporate environments offer', function () {
    $content = $this->get('/para-empresas/servidores-e-ambientes-corporativos')
        ->assertOk()
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Arquivos, permissões, backup, VPN, virtualização e continuidade.')
        ->assertSee('Sua empresa tem arquivos, acessos e backup sob controle?')
        ->assertSee('Ambientes corporativos pensados para continuidade')
        ->assertSee('Como os servidores sustentam a operação')
        ->assertSee('O servidor centraliza os dados.')
        ->assertSee('O backup protege a empresa.')
        ->assertSee('A administração mensal mantém tudo acompanhado.')
        ->assertSee('Ambientes corporativos com mais controle e continuidade')
        ->assertSee('Servidor de Arquivos')
        ->assertSee('Active Directory')
        ->assertSee('Backup Empresarial')
        ->assertSee('VPN e Trabalho Remoto')
        ->assertSee('Virtualização')
        ->assertSee('Caminhos recomendados para organizar seu ambiente')
        ->assertSee('Arquivos Protegidos')
        ->assertSee('Ambiente Corporativo Organizado')
        ->assertSee('Trabalho Remoto com Controle')
        ->assertSee('Ambiente Gerenciado')
        ->assertSee('Implantação e acompanhamento contínuo')
        ->assertSee('Ambiente corporativo exige escopo claro')
        ->assertSee('Quer organizar servidores, arquivos ou backup da sua empresa?')
        ->assertSee('Avaliar meu ambiente')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/servidor-de-arquivos')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/active-directory')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/vpn-e-trabalho-remoto')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/virtualizacao')
        ->toContain('/para-empresas/contato')
        ->toContain('img/sophdata/services/business/seguranca-e-backup-hero.webp');
});

test('personal portal remains available after servers main page validation', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Servidores e Ambientes Corporativos');
});
