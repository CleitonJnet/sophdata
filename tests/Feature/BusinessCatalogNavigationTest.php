<?php

test('business home renders cards for the three main catalog blocks', function () {
    $content = $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('Soluções empresariais organizadas por necessidade')
        ->assertSee('Escolha a frente que melhor representa o momento da sua empresa.')
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Servidores e Ambientes Corporativos')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/desenvolvimento-de-software')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos')
        ->toContain('img/sophdata/services/business/sites-e-sistemas-hero.webp')
        ->toContain('img/sophdata/services/business/suporte-de-ti-hero.webp')
        ->toContain('img/sophdata/services/business/seguranca-e-backup-hero.webp');
});

test('software catalog index renders internal category cards', function () {
    $this->get('/para-empresas/desenvolvimento-de-software')
        ->assertOk()
        ->assertSee('O que podemos desenvolver para sua empresa')
        ->assertSee('Diagnóstico e Discovery')
        ->assertSee('Sites e Portais')
        ->assertSee('Sistemas Sob Medida')
        ->assertSee('Automações e Integrações')
        ->assertSee('Sustentação e Evolução')
        ->assertSee('/para-empresas/desenvolvimento-de-software/sites-e-portais', false);
});

test('infrastructure catalog index renders internal category cards', function () {
    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->assertOk()
        ->assertSee('A base de TI da sua empresa em ordem')
        ->assertSee('Hardware Corporativo')
        ->assertSee('Redes Corporativas')
        ->assertSee('Wi-Fi Corporativo')
        ->assertSee('Administração Mensal')
        ->assertSee('Pacotes Integrados')
        ->assertSee('/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo', false);
});

test('infrastructure catalog index presents the managed infrastructure offer', function () {
    $content = $this->get('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->assertOk()
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Computadores, redes, Wi-Fi, suporte e administração mensal.')
        ->assertSee('Sua empresa perde tempo com infraestrutura desorganizada?')
        ->assertSee('Infraestrutura pensada para a rotina da empresa')
        ->assertSee('Lógica comercial')
        ->assertSee('Como a infraestrutura se encaixa na operação')
        ->assertSee('O hardware é a estação de trabalho.')
        ->assertSee('A administração mensal mantém tudo em ordem.')
        ->assertSee('Pacotes integrados por porte de empresa')
        ->assertSee('Infraestrutura Starter')
        ->assertSee('Infraestrutura Corporativa')
        ->assertSee('Caminhos para começar com infraestrutura')
        ->assertSee('Rede Básica Organizada')
        ->assertSee('Administração mensal para manter o ambiente acompanhado')
        ->assertSee('Essencial')
        ->assertSee('Corporativo')
        ->assertSee('Escopo claro antes da implantação')
        ->assertSee('Solicitar diagnóstico de infraestrutura')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada/wifi-corporativo')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados')
        ->toContain('/para-empresas/contato')
        ->toContain('img/sophdata/services/business/suporte-de-ti-hero.webp');
});

test('servers catalog index renders internal category cards', function () {
    $this->get('/para-empresas/servidores-e-ambientes-corporativos')
        ->assertOk()
        ->assertSee('Ambientes corporativos com mais controle e continuidade')
        ->assertSee('Servidor de Arquivos')
        ->assertSee('Active Directory')
        ->assertSee('Backup Empresarial')
        ->assertSee('VPN e Trabalho Remoto')
        ->assertSee('Virtualização')
        ->assertSee('/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', false);
});

test('servers catalog index presents the corporate environments offer', function () {
    $content = $this->get('/para-empresas/servidores-e-ambientes-corporativos')
        ->assertOk()
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Arquivos, permissões, backup, VPN, virtualização e continuidade.')
        ->assertSee('Sua empresa tem arquivos, acessos e backup sob controle?')
        ->assertSee('Ambientes corporativos pensados para continuidade')
        ->assertSee('Como os servidores sustentam a operação')
        ->assertSee('Caminhos recomendados para organizar seu ambiente')
        ->assertSee('Arquivos Protegidos')
        ->assertSee('Ambiente Corporativo Organizado')
        ->assertSee('Trabalho Remoto com Controle')
        ->assertSee('Ambiente Gerenciado')
        ->assertSee('Implantação e acompanhamento contínuo')
        ->assertSee('Ambiente corporativo exige escopo claro')
        ->assertSee('Avaliar meu ambiente')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/servidor-de-arquivos')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/active-directory')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/vpn-e-trabalho-remoto')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos/virtualizacao')
        ->toContain('img/sophdata/services/business/seguranca-e-backup-hero.webp');
});

test('personal portal remains available without business catalog card changes', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Escolha por onde sua empresa precisa começar');
});
