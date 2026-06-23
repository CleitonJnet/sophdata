<?php

function finalBusinessRegressionPages(): array
{
    return [
        ['/para-empresas', 'Organize software, infraestrutura e servidores da sua empresa'],
        ['/para-empresas/desenvolvimento-de-software', 'Desenvolvimento de Software'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada', 'Infraestrutura Corporativa Gerenciada'],
        ['/para-empresas/servidores-e-ambientes-corporativos', 'Servidores e Ambientes Corporativos'],
        ['/para-empresas/planos', 'Planos Empresariais'],
        ['/para-empresas/como-trabalhamos', 'Como Trabalhamos'],
        ['/para-empresas/contato', 'Contato Empresarial'],
        ['/para-empresas/desenvolvimento-de-software/diagnostico-e-discovery', 'Diagnóstico e Discovery'],
        ['/para-empresas/desenvolvimento-de-software/sites-e-portais', 'Sites e Portais'],
        ['/para-empresas/desenvolvimento-de-software/lojas-e-catalogos-digitais', 'Lojas e Catálogos Digitais'],
        ['/para-empresas/desenvolvimento-de-software/sistemas-sob-medida', 'Sistemas Sob Medida'],
        ['/para-empresas/desenvolvimento-de-software/sistemas-por-segmento', 'Sistemas por Segmento'],
        ['/para-empresas/desenvolvimento-de-software/portais-area-logada-pwa', 'Portais, Área Logada e PWA'],
        ['/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes', 'Automações e Integrações'],
        ['/para-empresas/desenvolvimento-de-software/deploy-hospedagem', 'Deploy e Hospedagem'],
        ['/para-empresas/desenvolvimento-de-software/sustentacao-e-evolucao', 'Sustentação e Evolução'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo', 'Hardware Corporativo'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas', 'Redes Corporativas'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/wifi-corporativo', 'Wi-Fi Corporativo'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal', 'Administração Mensal'],
        ['/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados', 'Pacotes Integrados'],
        ['/para-empresas/servidores-e-ambientes-corporativos/servidor-de-arquivos', 'Servidor de Arquivos'],
        ['/para-empresas/servidores-e-ambientes-corporativos/active-directory', 'Active Directory'],
        ['/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', 'Backup Empresarial'],
        ['/para-empresas/servidores-e-ambientes-corporativos/vpn-e-trabalho-remoto', 'VPN e Trabalho Remoto'],
        ['/para-empresas/servidores-e-ambientes-corporativos/virtualizacao', 'Virtualização'],
    ];
}

test('final business catalog pages keep rendering with seo image and cta structure', function (string $path, string $heading) {
    $content = $this->get($path)
        ->assertOk()
        ->assertSee($heading)
        ->assertSee('<img', false)
        ->assertSee('/para-empresas/contato')
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
})->with(finalBusinessRegressionPages());

test('final business catalog preserves legacy redirects invalid slugs and personal portal', function () {
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

    foreach ([
        '/para-empresas/desenvolvimento-de-software/categoria-inexistente',
        '/para-empresas/infraestrutura-corporativa-gerenciada/categoria-inexistente',
        '/para-empresas/servidores-e-ambientes-corporativos/categoria-inexistente',
    ] as $path) {
        $this->get($path)->assertNotFound();
    }

    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Escolha por onde sua empresa precisa começar');
});
