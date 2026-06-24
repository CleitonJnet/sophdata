<?php

test('business main pages expose configured seo metadata', function (
    string $path,
    string $title,
    string $description,
    string $ogImage,
) {
    $content = $this->get($path)
        ->assertOk()
        ->getContent();

    expect($content)
        ->toContain("<title>{$title}</title>")
        ->toContain('name="description" content="'.$description.'"')
        ->toContain('rel="canonical" href="'.url($path).'"')
        ->toContain('property="og:title"')
        ->toContain('property="og:description"')
        ->toContain('property="og:url" content="'.url($path).'"')
        ->toContain('property="og:image" content="'.asset($ogImage).'"')
        ->toContain('name="twitter:card" content="summary_large_image"');
})->with([
    ['/para-empresas', 'SophData para Empresas | Software, Infraestrutura e Servidores', 'A SophData ajuda empresas a organizar tecnologia com desenvolvimento de software, infraestrutura gerenciada, servidores, backup e suporte mensal.', 'img/sophdata/portals/business-hero.webp'],
    ['/para-empresas/desenvolvimento-de-software', 'Desenvolvimento de Software para Empresas | SophData', 'Sites, sistemas, automacoes, integracoes e sustentacao para empresas que precisam organizar processos, substituir planilhas e reduzir retrabalho.', 'img/sophdata/services/business/sites-e-sistemas-hero.webp'],
    ['/para-empresas/infraestrutura-corporativa-gerenciada', 'Infraestrutura Corporativa Gerenciada | SophData', 'Organizacao de computadores, redes, Wi-Fi, suporte, documentacao e administracao mensal para empresas que precisam de mais estabilidade.', 'img/sophdata/services/business/suporte-de-ti-hero.webp'],
    ['/para-empresas/servidores-e-ambientes-corporativos', 'Servidores e Ambientes Corporativos | SophData', 'Servidor de arquivos, Active Directory, backup empresarial, VPN e virtualizacao para empresas que precisam proteger dados e organizar acessos.', 'img/sophdata/services/business/seguranca-e-backup-hero.webp'],
    ['/para-empresas/planos', 'Planos Empresariais de TI | SophData', 'Planos empresariais para diagnostico, desenvolvimento de software, infraestrutura gerenciada, servidores, backup e suporte mensal.', 'img/sophdata/cta/contact-banner.webp'],
    ['/para-empresas/como-trabalhamos', 'Como Trabalhamos | Metodo Empresarial SophData', 'Conheca o metodo da SophData para diagnostico, planejamento, escopo, implantacao, documentacao e acompanhamento de solucoes empresariais.', 'img/sophdata/cta/contact-banner.webp'],
    ['/para-empresas/contato', 'Contato Empresarial | Solicite Diagnostico SophData', 'Fale com a SophData para solicitar diagnostico empresarial em software, infraestrutura, servidores, backup ou suporte mensal.', 'img/sophdata/cta/contact-banner.webp'],
]);

test('business internal category pages expose specific seo metadata', function (
    string $path,
    string $title,
) {
    $content = $this->get($path)
        ->assertOk()
        ->getContent();

    expect($content)
        ->toContain("<title>{$title}</title>")
        ->toContain('name="description"')
        ->toContain('rel="canonical" href="'.url($path).'"')
        ->toContain('property="og:image"');
})->with([
    ['/para-empresas/desenvolvimento-de-software/sistemas-sob-medida', 'Sistemas Sob Medida | Desenvolvimento de Software SophData'],
    ['/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal', 'Administracao Mensal | Infraestrutura Corporativa Gerenciada SophData'],
    ['/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', 'Backup Empresarial | Servidores e Ambientes Corporativos SophData'],
]);

test('sitemap contains all required business urls without removing personal urls', function () {
    $sitemap = file_get_contents(public_path('sitemap.xml'));
    $businessUrls = [
        '/para-empresas',
        '/para-empresas/desenvolvimento-de-software',
        '/para-empresas/desenvolvimento-de-software/diagnostico-e-discovery',
        '/para-empresas/desenvolvimento-de-software/sites-e-portais',
        '/para-empresas/desenvolvimento-de-software/lojas-e-catalogos-digitais',
        '/para-empresas/desenvolvimento-de-software/sistemas-sob-medida',
        '/para-empresas/desenvolvimento-de-software/sistemas-por-segmento',
        '/para-empresas/desenvolvimento-de-software/portais-area-logada-pwa',
        '/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes',
        '/para-empresas/desenvolvimento-de-software/deploy-hospedagem',
        '/para-empresas/desenvolvimento-de-software/sustentacao-e-evolucao',
        '/para-empresas/infraestrutura-corporativa-gerenciada',
        '/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo',
        '/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas',
        '/para-empresas/infraestrutura-corporativa-gerenciada/wifi-corporativo',
        '/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal',
        '/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados',
        '/para-empresas/servidores-e-ambientes-corporativos',
        '/para-empresas/servidores-e-ambientes-corporativos/servidor-de-arquivos',
        '/para-empresas/servidores-e-ambientes-corporativos/active-directory',
        '/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial',
        '/para-empresas/servidores-e-ambientes-corporativos/vpn-e-trabalho-remoto',
        '/para-empresas/servidores-e-ambientes-corporativos/virtualizacao',
        '/para-empresas/planos',
        '/para-empresas/como-trabalhamos',
        '/para-empresas/contato',
    ];

    foreach ($businessUrls as $url) {
        expect($sitemap)->toContain('https://sophdata.com.br'.$url);
    }

    expect($sitemap)
        ->toContain('https://sophdata.com.br/para-voce')
        ->toContain('https://sophdata.com.br/para-voce/computador-lento');
});

test('personal portal remains available after business seo changes', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você');
});
