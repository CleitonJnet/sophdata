<?php

test('business portal presents the new enterprise catalog without personal service cards', function () {
    $content = $this->get(route('portal.business'))
        ->assertOk()
        ->assertSee('Portal Para Empresas')
        ->assertSee('Tecnologia organizada para empresas que precisam crescer com segurança.')
        ->assertSee('Soluções empresariais organizadas por necessidade')
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Solicitar diagnóstico empresarial')
        ->assertDontSee('Falar no WhatsApp')
        ->getContent();

    preg_match('/<main id="main-content"[^>]*>(.*)<\/main>/s', $content, $matches);

    expect($matches[1])
        ->not->toContain('Suporte Digital Pessoal')
        ->not->toContain('Meu computador está lento')
        ->and(substr_count($matches[1], 'card-lift group'))->toBeGreaterThanOrEqual(8);
});

test('personal portal remains focused on personal problems without business catalog blocks', function () {
    $content = $this->get(route('portal.personal'))
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertSee('Soluções de tecnologia para o seu dia a dia')
        ->assertSee('O que você precisa resolver hoje?')
        ->assertSee('Meu computador está lento')
        ->assertSee('Meu Wi-Fi está ruim')
        ->assertSee('Quero proteger meus arquivos')
        ->assertSee('Escolha como deseja resolver')
        ->assertSee('Para quem é?')
        ->assertSee('Quer resolver um problema de tecnologia sem complicação?')
        ->assertDontSee('Falar no WhatsApp')
        ->getContent();

    preg_match('/<main id="main-content"[^>]*>(.*)<\/main>/s', $content, $matches);

    expect($matches[1])
        ->not->toContain('Infraestrutura Corporativa Gerenciada')
        ->not->toContain('Servidores e Ambientes Corporativos')
        ->and(substr_count($matches[1], 'card-lift group'))->toBeGreaterThanOrEqual(10);
});

test('personal category pages keep benefits packages comparison and faq structure', function () {
    $content = $this->get(route('portal.personal.category', 'wifi-e-casa-conectada'))
        ->assertOk()
        ->assertSee('Wi-Fi e Casa Conectada')
        ->assertSee('aria-label="Breadcrumb"', false)
        ->assertSee('O que essa solução resolve?')
        ->assertSee('Escolha o pacote ideal')
        ->assertSee('Essencial')
        ->assertSee('Profissional')
        ->assertSee('Completo')
        ->assertSee('Compare os pacotes')
        ->assertSee('<table', false)
        ->assertSee('<caption', false)
        ->assertSee('Perguntas sobre esta solução')
        ->assertDontSee('Falar no WhatsApp')
        ->getContent();

    expect(preg_match_all('/<h1\b/i', $content))->toBe(1)
        ->and(substr_count($content, 'Escolher este pacote'))->toBe(3);
});

test('legacy business category urls redirect while invalid slugs stay isolated', function () {
    $this->get(route('portal.business.category', 'seguranca-e-backup'))
        ->assertStatus(301)
        ->assertRedirect('/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial');

    $this->get(route('portal.business.category', 'suporte-de-ti'))
        ->assertStatus(301)
        ->assertRedirect('/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal');

    $this->get('/para-empresas/categoria-inexistente')->assertNotFound();
    $this->get('/para-voce/categoria-inexistente')->assertNotFound();
});

test('all configured legacy service categories remain isolated by portal', function () {
    foreach (config('sophdata_services.personal') as $category) {
        $this->get(route('portal.personal.category', $category['slug']))
            ->assertOk()
            ->assertSee($category['title']);

        $this->get(route('portal.business.category', $category['slug']))
            ->assertNotFound();
    }

    foreach (config('sophdata_services.business') as $category) {
        $this->get(route('portal.business.category', $category['slug']))
            ->assertStatus(301);

        $this->get(route('portal.personal.category', $category['slug']))
            ->assertNotFound();
    }
});

test('profile chooser and header expose accessible navigation', function () {
    $this->get(route('portal.choose'))
        ->assertOk()
        ->assertSee('Como você deseja navegar?')
        ->assertSee('Acessar portal empresarial')
        ->assertSee('Acessar portal pessoal')
        ->assertSee('/para-empresas', false)
        ->assertSee('/para-voce', false);

    $business = $this->get(route('portal.business'))->assertOk();
    $personal = $this->get(route('portal.personal'))->assertOk();

    $business
        ->assertSee('aria-label="Navegação principal"', false)
        ->assertSee('aria-label="Alternar entre os portais"', false)
        ->assertSee('aria-label="Serviços principais do portal ativo"', false)
        ->assertSee('data-menu-button', false)
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Infraestrutura Gerenciada')
        ->assertSee('Servidores e Ambientes');

    $personal
        ->assertSee('Serviço de Computador Lento')
        ->assertSee('Wi-Fi e Casa Conectada')
        ->assertDontSee('Miniatura de Suporte de TI');
});

test('layout exposes logo skip link semantic regions favicon and sharing metadata', function () {
    $content = $this->get(route('portal.business'))->assertOk()->getContent();

    expect($content)
        ->toContain('src="'.asset('img/SophData-logo.svg').'"')
        ->toContain('src="'.asset('img/SophData-text.svg').'"')
        ->toContain('alt="SophData"')
        ->toContain('href="#main-content"')
        ->toContain('Ir para o conteúdo principal')
        ->toContain('<header')
        ->toContain('<main id="main-content"')
        ->toContain('<footer')
        ->toContain('name="csrf-token"')
        ->toContain('property="og:type" content="website"')
        ->toContain('property="og:url" content="'.url('/para-empresas').'"')
        ->toContain('property="og:title" content="SophData para Empresas"')
        ->toContain('property="og:image" content="'.asset('img/sophdata/portals/business-hero.webp').'"')
        ->toContain('name="twitter:card" content="summary_large_image"')
        ->toContain('rel="icon" type="image/svg+xml" href="'.asset('favicon.svg').'"')
        ->toContain('rel="mask-icon" href="'.asset('favicon.svg').'"')
        ->toContain('name="theme-color" content="#ffffff"');
});

test('portal home pages use one heading level one and semantic commercial cards', function (string $routeName) {
    $content = $this->get(route($routeName))->assertOk()->getContent();

    expect(preg_match_all('/<h1\b/i', $content))->toBe(1)
        ->and(substr_count($content, '<section'))->toBeGreaterThanOrEqual(6)
        ->and(substr_count($content, '<article'))->toBeGreaterThan(8)
        ->and(substr_count($content, '<figure'))->toBeGreaterThan(8)
        ->and($content)->toContain('alt="');
})->with(['portal.business', 'portal.personal']);

test('visible calls to action avoid application focused labels', function () {
    $urls = [
        route('portal.business'),
        route('portal.personal'),
        route('business.infrastructure.category', 'administracao-mensal'),
        route('portal.personal.category', 'computador-lento'),
    ];

    foreach ($urls as $url) {
        expect($this->get($url)->assertOk()->getContent())
            ->not->toContain('Falar no WhatsApp')
            ->not->toContain('Mandar WhatsApp');
    }
});

test('institutional pages render normally and keep contact guidance', function () {
    $this->get(route('site.about'))
        ->assertOk()
        ->assertSee('Quem somos')
        ->assertSee('Forma de trabalho')
        ->assertSee('Valores')
        ->assertSee('Iniciar atendimento');

    $this->get(route('site.privacy'))
        ->assertOk()
        ->assertSee('Política de Privacidade')
        ->assertSee('Dados que podem ser tratados')
        ->assertSee('Atendimento por canais externos')
        ->assertSee('Cookies e ferramentas de análise');
});

test('footer contains institutional links solutions contact and copyright', function () {
    $this->get(route('portal.business'))
        ->assertOk()
        ->assertSee('SophData')
        ->assertSee('Para Empresas')
        ->assertSee('Para Você')
        ->assertSee('Sobre')
        ->assertSee('Contato')
        ->assertSee('Privacidade')
        ->assertSee('Diagnóstico claro')
        ->assertSee('Execução organizada')
        ->assertSee('Evolução contínua')
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee(config('sophdata.brand.whatsapp_display'))
        ->assertSee('© '.date('Y').' SophData. Todos os direitos reservados.');
});

test('public pages expose seo metadata and canonical urls', function (string $path, string $title, string $descriptionFragment) {
    $content = $this->get($path)->assertOk()->getContent();

    expect($content)
        ->toContain("<title>{$title}</title>")
        ->toContain('name="description"')
        ->toContain($descriptionFragment)
        ->toContain('rel="canonical" href="'.url($path).'"')
        ->and(preg_match_all('/<h1\b/i', $content))->toBe(1);
})->with([
    ['/para-empresas', 'SophData para Empresas | Software, Infraestrutura e Servidores', 'desenvolvimento de software, infraestrutura gerenciada'],
    ['/para-voce', 'SophData | Soluções de Tecnologia para Você', 'computador lento, Wi-Fi ruim, proteção de contas'],
    ['/escolher-perfil', 'Escolha seu Perfil | SophData', 'Escolha entre o portal Para Empresas'],
    ['/sobre', 'Sobre a SophData | Soluções em TI', 'Conheça a SophData'],
    ['/politica-de-privacidade', 'Política de Privacidade | SophData', 'site institucional da SophData'],
    ['/para-voce/wifi-e-casa-conectada', 'Wi-Fi e Casa Conectada | SophData', 'Essencial, Profissional e Completo'],
]);

test('rendered informative images have alt text and async decoding', function (string $routeName) {
    $content = $this->get(route($routeName))->assertOk()->getContent();

    preg_match_all('/<img\b[^>]*>/i', $content, $matches);

    expect($matches[0])->not->toBeEmpty();

    foreach ($matches[0] as $imageTag) {
        expect($imageTag)
            ->toContain('alt=')
            ->toContain('decoding="async"');
    }
})->with([
    'portal.business',
    'portal.personal',
    'portal.choose',
    'site.about',
]);

test('sitemap lists root portals categories and institutional pages', function () {
    $sitemap = file_get_contents(public_path('sitemap.xml'));

    foreach ([
        config('app.url').'/',
        config('app.url').'/para-empresas',
        config('app.url').'/para-voce',
        config('app.url').'/sobre',
        config('app.url').'/politica-de-privacidade',
    ] as $url) {
        expect($sitemap)->toContain("<loc>{$url}</loc>");
    }

    expect($sitemap)->not->toContain('<loc>'.config('app.url').'/contato</loc>');

    foreach (config('sophdata_services.personal') as $category) {
        expect($sitemap)->toContain(config('app.url').'/para-voce/'.$category['slug']);
    }

    expect(simplexml_load_string($sitemap))->not->toBeFalse();
});

test('robots file points to the public sitemap', function () {
    expect(file_get_contents(public_path('robots.txt')))
        ->toContain('User-agent: *')
        ->toContain('Disallow: /')
        ->not->toContain('Sitemap:');
});
