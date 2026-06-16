<?php

test('business portal sells business problems without personal categories', function () {
    $response = $this->get(route('portal.business'))
        ->assertOk()
        ->assertSee('Portal Para Empresas')
        ->assertSee('Soluções de TI para pequenos negócios e instituições')
        ->assertSee('O que sua empresa precisa resolver?')
        ->assertSee('Escolha o problema mais próximo da sua realidade e veja a solução indicada.')
        ->assertSee('Computadores parando?')
        ->assertSee('Sua empresa não tem backup?')
        ->assertSee('Precisa de site ou sistema?')
        ->assertSee('Usa planilhas demais?')
        ->assertSee('Precisa renovar os computadores?')
        ->assertSee('Soluções organizadas por área')
        ->assertSee('Suporte de TI')
        ->assertSee('Redes e Wi-Fi')
        ->assertSee('Computadores Corporativos')
        ->assertSee('Escolha o nível de atendimento ideal')
        ->assertSee('Para quais negócios?')
        ->assertSee('Igrejas')
        ->assertSee('Consultórios')
        ->assertSee('Prestadores de serviço')
        ->assertSee('Por que contratar a SophData?')
        ->assertSee('Correção de problemas, organização da rotina')
        ->assertSee('Tecnologias e áreas')
        ->assertSee('Spring Boot')
        ->assertSee('Montagem de Computadores')
        ->assertSee('Sua empresa precisa de uma TI mais organizada?')
        ->assertSee('Solicitar atendimento empresarial')
        ->assertDontSee('Falar no WhatsApp');

    preg_match('/<main id="main-content"[^>]*>(.*)<\/main>/s', $response->getContent(), $matches);

    expect($matches[1])
        ->not->toContain('Suporte Digital Pessoal')
        ->not->toContain('Meu computador está lento')
        ->and(substr_count($matches[1], 'card-lift group'))->toBe(12);
});

test('personal portal sells personal problems without business categories', function () {
    $response = $this->get(route('portal.personal'))
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertSee('Soluções de tecnologia para o seu dia a dia')
        ->assertSee('O que você precisa resolver hoje?')
        ->assertSee('Escolha o problema mais próximo da sua necessidade e encontre a solução adequada.')
        ->assertSee('Meu computador está lento')
        ->assertSee('Meu Wi-Fi está ruim')
        ->assertSee('Quero proteger meus arquivos')
        ->assertSee('Preciso organizar estudos ou carreira')
        ->assertSee('Quero montar ou melhorar meu PC')
        ->assertSee('Soluções organizadas por área')
        ->assertSee('Computador Lento')
        ->assertSee('Escolha o nível de atendimento ideal')
        ->assertSee('Para quem é?')
        ->assertSee('Famílias')
        ->assertSee('Profissionais autônomos')
        ->assertSee('Pessoas em home office')
        ->assertSee('Por que contratar a SophData?')
        ->assertSee('Ajuda para quem não entende termos técnicos')
        ->assertSee('Tecnologias e áreas')
        ->assertSee('Produtividade')
        ->assertSee('Quer resolver um problema de tecnologia sem complicação?')
        ->assertSee('Quero atendimento')
        ->assertDontSee('Falar no WhatsApp');

    preg_match('/<main id="main-content"[^>]*>(.*)<\/main>/s', $response->getContent(), $matches);

    expect($matches[1])
        ->not->toContain('Suporte de TI')
        ->not->toContain('Computadores parando?')
        ->and(substr_count($matches[1], 'card-lift group'))->toBe(10);
});

test('category pages present benefits problems and progressive commercial packages', function (string $routeName, string $slug, string $title, string $concreteItem) {
    $response = $this->get(route($routeName, $slug))
        ->assertOk()
        ->assertSee($title)
        ->assertSee('aria-label="Breadcrumb"', false)
        ->assertSee('O que essa solução resolve?')
        ->assertSee('Escolha o pacote ideal')
        ->assertSee('Comece pelo essencial, avance para o recomendado ou escolha a solução completa.')
        ->assertSee('Essencial')
        ->assertSee('Profissional')
        ->assertSee('Completo')
        ->assertSee('Para começar')
        ->assertSee('Mais escolhido')
        ->assertSee('Solução completa')
        ->assertSee('Para quem é indicado')
        ->assertSee('O que resolve')
        ->assertSee('Itens inclusos')
        ->assertSee('Inclui tudo do Essencial')
        ->assertSee('Inclui tudo do Profissional')
        ->assertSee('melhor equilíbrio entre custo e benefício')
        ->assertSee($concreteItem)
        ->assertSee('Escolher este pacote')
        ->assertSee('Compare os pacotes')
        ->assertSee('<table', false)
        ->assertSee('<caption', false)
        ->assertSee('<thead', false)
        ->assertSee('<tbody', false)
        ->assertSee('scope="col"', false)
        ->assertSee('scope="row"', false)
        ->assertSee('Como escolher?')
        ->assertSee('Escolha o Essencial')
        ->assertSee('Escolha o Profissional')
        ->assertSee('Escolha o Completo')
        ->assertSee('Como funciona o atendimento')
        ->assertSee('Primeiro contato')
        ->assertSee('Diagnóstico')
        ->assertSee('Proposta')
        ->assertSee('Execução')
        ->assertSee('Orientação final')
        ->assertSee('Perguntas sobre esta solução')
        ->assertDontSee('Diagnóstico inicial')
        ->assertDontSee('Execução do escopo essencial')
        ->assertDontSee('Falar no WhatsApp');

    expect(preg_match_all('/<h1\b/i', $response->getContent()))->toBe(1)
        ->and(substr_count($response->getContent(), 'Escolher este pacote'))->toBe(3);
})->with([
    'business' => ['portal.business.category', 'seguranca-e-backup', 'Segurança e Backup', 'Configuração de backup automático'],
    'personal' => ['portal.personal.category', 'wifi-e-casa-conectada', 'Wi-Fi e Casa Conectada', 'Análise do sinal nos ambientes principais'],
]);

test('category pages use specific FAQ when available and portal FAQ as fallback', function () {
    $this->get(route('portal.business.category', 'seguranca-e-backup'))
        ->assertOk()
        ->assertSee('Como escolher o pacote para minha empresa?');

    $this->get(route('portal.business.category', 'suporte-de-ti'))
        ->assertOk()
        ->assertSee('Como escolher o pacote para minha empresa?');

    $this->get(route('portal.personal.category', 'wifi-e-casa-conectada'))
        ->assertOk()
        ->assertSee('Como saber qual pacote escolher?');
});

test('unknown category slugs return not found in both portals', function () {
    $this->get('/para-empresas/categoria-inexistente')->assertNotFound();
    $this->get('/para-voce/categoria-inexistente')->assertNotFound();
});

test('category final calls to action match each portal', function () {
    $this->get(route('portal.business.category', 'suporte-de-ti'))
        ->assertOk()
        ->assertSee('Pronto para organizar esta área da sua empresa?')
        ->assertSee('Inicie o atendimento e receba orientação para escolher o melhor pacote.')
        ->assertSee('Solicitar atendimento empresarial');

    $this->get(route('portal.personal.category', 'computador-lento'))
        ->assertOk()
        ->assertSee('Quer resolver isso com orientação clara?')
        ->assertSee('Inicie o atendimento e receba ajuda para escolher o pacote mais adequado.')
        ->assertSee('Quero atendimento');
});

test('all configured categories render only in their own portal', function () {
    foreach (config('sophdata_services.personal') as $category) {
        $this->get(route('portal.personal.category', $category['slug']))
            ->assertOk()
            ->assertSee($category['title']);

        $this->get(route('portal.business.category', $category['slug']))
            ->assertNotFound();
    }

    foreach (config('sophdata_services.business') as $category) {
        $this->get(route('portal.business.category', $category['slug']))
            ->assertOk()
            ->assertSee($category['title']);

        $this->get(route('portal.personal.category', $category['slug']))
            ->assertNotFound();
    }
});

test('profile chooser consumes portal configuration', function () {
    $this->get(route('portal.choose'))
        ->assertOk()
        ->assertSee('Como você deseja navegar?')
        ->assertSee('Escolha o perfil mais adequado para encontrar as soluções certas da SophData.')
        ->assertSee('Acessar portal empresarial')
        ->assertSee('Acessar portal pessoal')
        ->assertSee('Suporte, redes e Wi-Fi, segurança, backup, sites, sistemas, automação e computadores')
        ->assertSee('Suporte para computador, internet, segurança digital')
        ->assertSee('/para-empresas', false)
        ->assertSee('/para-voce', false);
});

test('real SophData logo is rendered with accessible active portal link', function () {
    $this->get(route('portal.business'))
        ->assertOk()
        ->assertSee('src="'.asset('img/SophData-logo.svg').'"', false)
        ->assertSee('src="'.asset('img/SophData-text.svg').'"', false)
        ->assertSee('alt="SophData"', false)
        ->assertSee('aria-label="Ir para o portal principal da SophData"', false);

    $this->get(route('portal.personal'))
        ->assertSee('href="'.route('portal.personal').'"', false)
        ->assertSee('aria-label="Ir para o portal principal da SophData"', false);
});

test('header composes accessible profile switcher service navigation and mobile menu', function () {
    $business = $this->get(route('portal.business'))->assertOk();
    $personal = $this->get(route('portal.personal'))->assertOk();

    $business
        ->assertSee('Soluções em TI para pessoas e empresas')
        ->assertSee('aria-label="Navegação principal"', false)
        ->assertSee('aria-label="Alternar entre os portais"', false)
        ->assertSee('aria-label="Serviços principais do portal ativo"', false)
        ->assertDontSee('data-mega-menu', false)
        ->assertDontSee('data-mega-trigger', false)
        ->assertSee('aria-expanded="false"', false)
        ->assertSee('data-menu-button', false)
        ->assertSee('aria-controls="mobile-navigation"', false)
        ->assertSee('Miniatura de Suporte de TI')
        ->assertSee('Redes e Wi-Fi')
        ->assertDontSee('Miniatura de Computador Lento');

    $personal
        ->assertSee('Miniatura de Computador Lento')
        ->assertSee('Wi-Fi e Casa Conectada')
        ->assertDontSee('Miniatura de Suporte de TI');
});

test('layout exposes skip link and semantic regions', function () {
    $content = $this->get(route('portal.business'))->assertOk()->getContent();

    expect($content)
        ->toContain('href="#main-content"')
        ->toContain('Ir para o conteúdo principal')
        ->toContain('<header')
        ->toContain('<main id="main-content"')
        ->toContain('<footer');
});

test('portal home pages use one heading level one and semantic commercial cards', function (string $routeName) {
    $content = $this->get(route($routeName))->assertOk()->getContent();

    expect(preg_match_all('/<h1\b/i', $content))->toBe(1)
        ->and(substr_count($content, '<section'))->toBeGreaterThanOrEqual(8)
        ->and(substr_count($content, '<article'))->toBeGreaterThan(10)
        ->and(substr_count($content, '<figure'))->toBeGreaterThan(10)
        ->and($content)->toContain('alt="');
})->with(['portal.business', 'portal.personal']);

test('visible calls to action avoid application focused labels', function () {
    $urls = [
        route('portal.business'),
        route('portal.personal'),
        route('portal.business.category', 'suporte-de-ti'),
        route('portal.personal.category', 'computador-lento'),
        route('site.contact'),
    ];

    foreach ($urls as $url) {
        expect($this->get($url)->assertOk()->getContent())
            ->not->toContain('Falar no WhatsApp')
            ->not->toContain('Chamar no WhatsApp')
            ->not->toContain('Mandar WhatsApp');
    }
});

test('institutional pages render normally', function (string $routeName, string $text) {
    $this->get(route($routeName))
        ->assertOk()
        ->assertSee($text);
})->with([
    ['site.about', 'Sobre a SophData'],
    ['site.contact', 'Inicie seu atendimento'],
    ['site.privacy', 'Política de Privacidade'],
]);

test('about page presents institutional content logo and global call to action', function () {
    $this->get(route('site.about'))
        ->assertOk()
        ->assertSee('Quem somos')
        ->assertSee('Áreas de atuação')
        ->assertSee('Experiência técnica')
        ->assertSee('Forma de trabalho')
        ->assertSee('Entendemos o problema')
        ->assertSee('Indicamos a solução adequada')
        ->assertSee('Valores')
        ->assertSee('Imagem institucional da SophData')
        ->assertSee('src="'.asset('img/SophData-logo.svg').'"', false)
        ->assertSee('Iniciar atendimento');
});

test('contact page has no functional form and guides the customer to atendimento', function () {
    $this->get(route('site.contact'))
        ->assertOk()
        ->assertDontSee('<form', false)
        ->assertSee('Iniciar atendimento')
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee(config('sophdata.brand.region'))
        ->assertSee('Atendimento remoto')
        ->assertSee('Atendimento presencial sob consulta')
        ->assertSee('O atendimento é para pessoa física ou empresa?')
        ->assertSee('Qual problema deseja resolver?')
        ->assertSee('O atendimento é urgente?')
        ->assertSee('Pode ser remoto?')
        ->assertSee('Existe algum pacote de interesse?')
        ->assertSee('Não é um formulário funcional.');
});

test('privacy policy explains current institutional data practices', function () {
    $this->get(route('site.privacy'))
        ->assertOk()
        ->assertSee('Site institucional')
        ->assertSee('Atendimento por link externo')
        ->assertSee('Dados enviados voluntariamente')
        ->assertSee('Sem cadastro de usuários')
        ->assertSee('Sem pagamento online')
        ->assertSee('Sem área do cliente')
        ->assertSee('Análise de acesso futura')
        ->assertSee('Solicitar atendimento');
});

test('footer contains institutional summary links solutions contact and copyright', function () {
    $this->get(route('portal.business'))
        ->assertOk()
        ->assertSee('SophData')
        ->assertSee(config('sophdata.brand.slogan'))
        ->assertSee('Soluções em TI para pessoas, pequenos negócios e instituições')
        ->assertSee('Para Empresas')
        ->assertSee('Para Você')
        ->assertSee('Escolher perfil')
        ->assertSee('Sobre')
        ->assertSee('Contato')
        ->assertSee('Política de Privacidade')
        ->assertSee('Soluções para empresas')
        ->assertSee('Soluções para você')
        ->assertSee('Suporte de TI')
        ->assertSee('Computador Lento')
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee(config('sophdata.brand.whatsapp_display'))
        ->assertSee('Iniciar atendimento')
        ->assertSee('© '.date('Y').' SophData. Todos os direitos reservados.');
});

test('public pages expose specific seo metadata and canonical urls', function (string $path, string $title, string $descriptionFragment) {
    $content = $this->get($path)->assertOk()->getContent();

    expect($content)
        ->toContain("<title>{$title}</title>")
        ->toContain('name="description"')
        ->toContain($descriptionFragment)
        ->toContain('rel="canonical" href="'.url($path).'"')
        ->and(preg_match_all('/<h1\b/i', $content))->toBe(1);
})->with([
    ['/para-empresas', 'SophData | Soluções de TI para Empresas', 'paradas, Wi-Fi instável e planilhas demais'],
    ['/para-voce', 'SophData | Soluções de Tecnologia para Você', 'computador lento, Wi-Fi ruim, proteção de contas'],
    ['/escolher-perfil', 'Escolha seu Perfil | SophData', 'Escolha entre o portal Para Empresas'],
    ['/sobre', 'Sobre a SophData | Soluções em TI', 'Conheça a SophData'],
    ['/contato', 'Contato | SophData', 'Inicie atendimento'],
    ['/politica-de-privacidade', 'Política de Privacidade | SophData', 'privacidade e uso de dados'],
    ['/para-empresas/seguranca-e-backup', 'Segurança e Backup | SophData', 'Essencial, Profissional e Completo'],
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

    $expectedUrls = [
        'https://sophdata.com.br/',
        'https://sophdata.com.br/para-empresas',
        'https://sophdata.com.br/para-voce',
        'https://sophdata.com.br/sobre',
        'https://sophdata.com.br/contato',
        'https://sophdata.com.br/politica-de-privacidade',
    ];

    foreach (config('sophdata_services.business') as $category) {
        $expectedUrls[] = 'https://sophdata.com.br/para-empresas/'.$category['slug'];
    }

    foreach (config('sophdata_services.personal') as $category) {
        $expectedUrls[] = 'https://sophdata.com.br/para-voce/'.$category['slug'];
    }

    foreach ($expectedUrls as $url) {
        expect($sitemap)->toContain("<loc>{$url}</loc>");
    }

    expect(simplexml_load_string($sitemap))->not->toBeFalse();
});

test('robots file points to the public sitemap', function () {
    expect(file_get_contents(public_path('robots.txt')))
        ->toContain('User-agent: *')
        ->toContain('Allow: /')
        ->toContain('Sitemap: https://sophdata.com.br/sitemap.xml');
});

test('layout exposes SophData favicon and social sharing metadata', function () {
    $content = $this->get(route('portal.business'))->assertOk()->getContent();

    expect($content)
        ->toContain('name="csrf-token"')
        ->toContain('property="og:type" content="website"')
        ->toContain('property="og:url" content="'.route('portal.business').'"')
        ->toContain('property="og:title" content="SophData | Soluções de TI para Empresas"')
        ->toContain('property="og:image" content="'.asset(config('sophdata.logos.symbol')).'"')
        ->toContain('property="og:description"')
        ->toContain('name="twitter:card" content="summary"')
        ->toContain('rel="icon" type="image/svg+xml" href="'.asset('favicon.svg').'"')
        ->toContain('rel="mask-icon" href="'.asset('favicon.svg').'"')
        ->toContain('name="theme-color" content="#ffffff"');

    expect(file_get_contents(public_path('favicon.svg')))
        ->toContain('id="svg1"')
        ->toContain('fill="#08265a"');
});
