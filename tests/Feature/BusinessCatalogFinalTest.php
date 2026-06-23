<?php

function businessFinalPages(): array
{
    return [
        ['/para-empresas', 'Organize software, infraestrutura e servidores da sua empresa', 'Solicitar diagnóstico empresarial'],
        ['/para-empresas/desenvolvimento-de-software', 'Desenvolvimento de Software', 'Solicitar diagnóstico digital'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada', 'Infraestrutura Corporativa Gerenciada', 'Solicitar diagnóstico de infraestrutura'],
        ['/para-empresas/servidores-e-ambientes-corporativos', 'Servidores e Ambientes Corporativos', 'Avaliar meu ambiente'],
        ['/para-empresas/planos', 'Planos Empresariais', 'Iniciar atendimento empresarial'],
        ['/para-empresas/como-trabalhamos', 'Como Trabalhamos', 'Iniciar atendimento empresarial'],
        ['/para-empresas/contato', 'Contato Empresarial', 'Chamar no WhatsApp'],
        ['/para-empresas/desenvolvimento-de-software/diagnostico-e-discovery', 'Diagnóstico e Discovery', 'Solicitar diagnóstico digital'],
        ['/para-empresas/desenvolvimento-de-software/sites-e-portais', 'Sites e Portais', 'Criar meu site profissional'],
        ['/para-empresas/desenvolvimento-de-software/lojas-e-catalogos-digitais', 'Lojas e Catálogos Digitais', 'Criar meu catálogo digital'],
        ['/para-empresas/desenvolvimento-de-software/sistemas-sob-medida', 'Sistemas Sob Medida', 'Mapear meu sistema'],
        ['/para-empresas/desenvolvimento-de-software/sistemas-por-segmento', 'Sistemas por Segmento', 'Ver solução para meu segmento'],
        ['/para-empresas/desenvolvimento-de-software/portais-area-logada-pwa', 'Portais, Área Logada e PWA', 'Criar área logada'],
        ['/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes', 'Automações e Integrações', 'Automatizar meu processo'],
        ['/para-empresas/desenvolvimento-de-software/deploy-hospedagem', 'Deploy e Hospedagem', 'Publicar meu sistema'],
        ['/para-empresas/desenvolvimento-de-software/sustentacao-e-evolucao', 'Sustentação e Evolução', 'Manter meu sistema'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo', 'Hardware Corporativo', 'Organizar meus computadores'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas', 'Redes Corporativas', 'Avaliar minha rede'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/wifi-corporativo', 'Wi-Fi Corporativo', 'Melhorar meu Wi-Fi'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal', 'Administração Mensal', 'Contratar administração mensal'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados', 'Pacotes Integrados', 'Escolher pacote empresarial'],
        ['/para-empresas/servidores-e-ambientes-corporativos/servidor-de-arquivos', 'Servidor de Arquivos', 'Centralizar meus arquivos'],
        ['/para-empresas/servidores-e-ambientes-corporativos/active-directory', 'Active Directory', 'Organizar usuários e permissões'],
        ['/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', 'Backup Empresarial', 'Proteger meus dados'],
        ['/para-empresas/servidores-e-ambientes-corporativos/vpn-e-trabalho-remoto', 'VPN e Trabalho Remoto', 'Liberar acesso remoto seguro'],
        ['/para-empresas/servidores-e-ambientes-corporativos/virtualizacao', 'Virtualização', 'Avaliar virtualização'],
    ];
}

test('all final business pages respond with title image links and seo metadata', function (string $path, string $heading) {
    $content = $this->get($path)
        ->assertOk()
        ->assertSee($heading)
        ->assertSee('<img', false)
        ->assertSee('href=', false)
        ->getContent();

    expect($content)
        ->toContain('<title>')
        ->toContain('name="description"')
        ->toContain('rel="canonical" href="'.url($path).'"')
        ->toContain('property="og:title"')
        ->toContain('property="og:description"')
        ->toContain('property="og:image"')
        ->toContain('name="twitter:card" content="summary_large_image"')
        ->and(preg_match_all('/<h1\b/i', $content))->toBe(1);
})->with(businessFinalPages());

test('final business redirects invalid slugs personal regression and sitemap are valid', function () {
    $redirects = [
        '/para-empresas/sites-e-sistemas' => '/para-empresas/desenvolvimento-de-software',
        '/para-empresas/automacao-e-dados' => '/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes',
        '/para-empresas/suporte-de-ti' => '/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal',
        '/para-empresas/redes-e-wifi' => '/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas',
        '/para-empresas/seguranca-e-backup' => '/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial',
        '/para-empresas/computadores-corporativos' => '/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo',
    ];

    foreach ($redirects as $from => $to) {
        $this->get($from)->assertStatus(301)->assertRedirect($to);
    }

    $this->get('/para-empresas/desenvolvimento-de-software/categoria-inexistente')->assertNotFound();
    $this->get('/para-empresas/infraestrutura-corporativa-gerenciada/categoria-inexistente')->assertNotFound();
    $this->get('/para-empresas/servidores-e-ambientes-corporativos/categoria-inexistente')->assertNotFound();

    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você');

    $this->get('/para-voce/computador-lento')
        ->assertOk()
        ->assertSee('Computador lento ou travando');

    $sitemap = file_get_contents(public_path('sitemap.xml'));

    foreach (businessFinalPages() as [$path]) {
        expect($sitemap)->toContain(config('app.url').$path);
    }

    expect(simplexml_load_string($sitemap))->not->toBeFalse();
});
