<?php

use Illuminate\Support\Facades\Blade;

test('site components render their content and default assets', function () {
    $package = config('sophdata.categories.personal.0.packages.1');
    $faq = [config('sophdata.faq.0')];
    $steps = [
        ['title' => 'Diagnóstico', 'description' => 'Entender a necessidade.'],
        ['title' => 'Execução', 'description' => 'Aplicar a solução.'],
    ];

    $html = Blade::render(<<<'BLADE'
        <x-site.hero-banner
            eyebrow="Destaque"
            title="Hero reutilizável"
            subtitle="Descrição do hero."
            primary-button-text="Começar"
            primary-button-url="/contato"
            tertiary-button-text="WhatsApp"
            tertiary-button-url="https://wa.me/5521972765535"
        />
        <x-site.offer-card title="Oferta teste" description="Uma oferta." url="/oferta" button-text="Ver oferta" />
        <x-site.category-card title="Categoria teste" description="Uma categoria." url="/categoria" :items="['Item um']" />
        <x-site.package-card :package="$package" whatsapp-number="5521972765535" />
        <x-site.section-heading eyebrow="Seção" title="Título da seção" description="Descrição da seção." />
        <x-site.cta-section title="CTA teste" description="Descrição CTA." button-text="Conversar" button-url="/contato" />
        <x-site.quick-action-bar />
        <x-site.faq :items="$faq" />
        <x-site.process-steps :steps="$steps" />
        <x-site.profile-switch />
    BLADE, compact('package', 'faq', 'steps'));

    expect($html)
        ->toContain('Hero reutilizável')
        ->toContain('https://placehold.co/720x520/F3F6FA/0B1F4D?text=SophData')
        ->toContain('Oferta teste')
        ->toContain('Categoria teste')
        ->toContain('Mais escolhido')
        ->toContain('Título da seção')
        ->toContain('Fale+com+a+SophData')
        ->toContain('O que você precisa resolver?')
        ->toContain($faq[0]['question'])
        ->toContain('Diagnóstico')
        ->toContain('Para Você')
        ->toContain('Para Empresas')
        ->toContain('5521972765535');
});

test('commercial pages use the reusable visual components', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee('O que você precisa resolver?')
        ->assertSee('Principais soluções')
        ->assertSee('Pacotes em destaque');

    $this->get(route('para-voce'))
        ->assertOk()
        ->assertSee('Categorias de atendimento')
        ->assertSee('Mais escolhido')
        ->assertSee('Computador em Ordem');

    $this->get(route('para-empresas'))
        ->assertOk()
        ->assertSee('O que sua empresa precisa resolver?')
        ->assertSee('TI Profissional Mensal');

    $this->get(route('contato'))
        ->assertOk()
        ->assertSee('Estas respostas ajudam no diagnóstico inicial')
        ->assertSee('Responder pelo WhatsApp');
});

test('home renders the complete commercial portal structure', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('Soluções em TI para pessoas, pequenos negócios e instituições')
        ->assertSee('Quero atendimento para mim')
        ->assertSee('Quero soluções para minha empresa')
        ->assertSee('https://placehold.co/720x520/0B1F4D/FFFFFF?text=Solucoes+em+TI', false)
        ->assertSee('Escolha seu perfil')
        ->assertSee('https://placehold.co/640x360/F3F6FA/0B1F4D?text=Para+Voce', false)
        ->assertSee('Suporte Técnico')
        ->assertSee('Segurança e Backup')
        ->assertSee('Sites e Sistemas')
        ->assertSee('Redes e Infraestrutura')
        ->assertSee('Montagem de Computadores')
        ->assertSee('Consultoria e Automação')
        ->assertSee('Atendimento Essencial')
        ->assertSee('Solução Profissional')
        ->assertSee('Acompanhamento Completo')
        ->assertSee('Mais escolhido')
        ->assertSee('Tecnologia bem organizada evita perda de tempo, retrabalho e prejuízos.')
        ->assertSee(config('sophdata.differentials.0'))
        ->assertSee(config('sophdata.differentials.6'))
        ->assertSee('Você explica pelo WhatsApp')
        ->assertSee(config('sophdata.faq.0.question'))
        ->assertSee('Precisa organizar sua tecnologia?')
        ->assertSee('https://placehold.co/1200x360/F3F6FA/0B1F4D?text=Atendimento+SophData', false);
});

test('personal page renders every category and its commercial packages', function () {
    $response = $this->get(route('para-voce'));
    $categories = config('sophdata.categories.personal');
    $expectedPackageNames = [
        'SOS Digital Essencial',
        'Computador em Ordem',
        'Suporte Pessoal Completo',
        'Wi-Fi Essencial',
        'Casa Conectada Plus',
        'Home Office Seguro',
        'Contas Protegidas',
        'Família Segura Digital',
        'Blindagem Digital Familiar',
        'Kit Estudante Digital',
        'Carreira Digital Profissional',
        'Mentoria Digital de Carreira',
        'IA para o Dia a Dia',
        'Produtividade Digital com IA',
        'Oficina IA Profissional',
        'Upgrade Essencial',
        'PC Sob Medida',
        'Estação Completa Personalizada',
    ];

    $response->assertOk()
        ->assertSee('Soluções de tecnologia para o seu dia a dia')
        ->assertSee('Falar no WhatsApp')
        ->assertSee('Ver pacotes')
        ->assertSee('Tecnologia+Para+Voce', false)
        ->assertSee('Suporte')
        ->assertSee('Casa Conectada')
        ->assertSee('Proteção')
        ->assertSee('Estudos')
        ->assertSee('IA')
        ->assertSee('Montagem de PCs')
        ->assertSee('Quer resolver um problema de tecnologia sem complicação?')
        ->assertSee('Atendimento+Para+Voce', false);

    foreach ($categories as $category) {
        $response
            ->assertSee($category['title'])
            ->assertSee($category['image'], false)
            ->assertSee('id="'.$category['slug'].'"', false);
    }

    foreach ($expectedPackageNames as $packageName) {
        $response->assertSee($packageName);
    }

    expect(substr_count($response->getContent(), 'Mais escolhido'))->toBeGreaterThanOrEqual(6)
        ->and(substr_count($response->getContent(), 'https://wa.me/5521972765535'))->toBeGreaterThanOrEqual(18);
});

test('business page renders every category and its commercial packages', function () {
    $response = $this->get(route('para-empresas'));
    $categories = config('sophdata.categories.business');
    $expectedPackageNames = [
        'TI Essencial Empresarial',
        'TI Profissional Mensal',
        'TI Completa para Pequenos Negócios',
        'Rede Organizada Essencial',
        'Infraestrutura Profissional',
        'Ambiente Corporativo Conectado',
        'Check-up de Segurança',
        'Empresa Segura',
        'Blindagem Empresarial Digital',
        'Página Profissional Essencial',
        'Site Institucional Profissional',
        'Presença Digital Completa',
        'Sistema Essencial de Gestão',
        'Sistema Profissional Sob Medida',
        'Plataforma Completa de Gestão',
        'Planilhas Inteligentes',
        'Automação Administrativa',
        'Fluxo Digital Automatizado',
        'Publicação Web Essencial',
        'Deploy Profissional de Sistemas',
        'Servidor Gerenciado Linux',
        'Diagnóstico de TI',
        'Plano de Modernização Digital',
        'Gestão Consultiva de TI',
        'Estação Corporativa Essencial',
        'Renovação Profissional do Parque de TI',
        'Ambiente Corporativo Completo',
    ];
    $segments = ['Igrejas', 'Escolas', 'Escritórios', 'Consultórios', 'Lojas', 'Prestadores de serviço', 'Pequenas empresas', 'Instituições'];

    $response->assertOk()
        ->assertSee('Soluções de TI para pequenos negócios e instituições')
        ->assertSee('Solicitar orçamento')
        ->assertSee('Ver soluções')
        ->assertSee('TI+Para+Empresas', false)
        ->assertSee('O que sua empresa precisa resolver?')
        ->assertSee('Suporte')
        ->assertSee('Redes')
        ->assertSee('Segurança')
        ->assertSee('Sites')
        ->assertSee('Sistemas')
        ->assertSee('Automação')
        ->assertSee('Servidores')
        ->assertSee('Consultoria')
        ->assertSee('Computadores')
        ->assertSee('Pequenos+Negocios+e+Instituicoes', false)
        ->assertSee('Por que contratar uma consultoria de TI?')
        ->assertSee('Reduz problemas recorrentes')
        ->assertSee('Permite atendimento recorrente')
        ->assertSee('Sua empresa precisa de uma TI mais organizada?')
        ->assertSee('Solicite+um+Orcamento', false);

    foreach ($categories as $category) {
        $response
            ->assertSee($category['title'])
            ->assertSee($category['image'], false)
            ->assertSee('id="'.$category['slug'].'"', false);
    }

    foreach ($expectedPackageNames as $packageName) {
        $response->assertSee($packageName);
    }

    foreach ($segments as $segment) {
        $response->assertSee($segment);
    }

    expect(substr_count($response->getContent(), 'Mais escolhido'))->toBeGreaterThanOrEqual(9)
        ->and(substr_count($response->getContent(), 'https://wa.me/5521972765535'))->toBeGreaterThanOrEqual(27);
});

test('about page presents identity expertise process and values', function () {
    $response = $this->get(route('sobre'));
    $areas = [
        'Suporte técnico',
        'Redes',
        'Linux',
        'Sistemas web',
        'Laravel',
        'PHP',
        'MySQL',
        'PostgreSQL',
        'Java',
        'Spring Boot',
        'Backup',
        'Segurança digital',
        'Montagem e upgrade de computadores',
    ];
    $values = ['Clareza', 'Confiança', 'Organização', 'Responsabilidade', 'Solução prática', 'Acompanhamento'];

    $response->assertOk()
        ->assertSee('Sobre a SophData')
        ->assertSee('Tecnologia com clareza, organização e confiança para pessoas, pequenos negócios e instituições.')
        ->assertSee('Sobre+SophData', false)
        ->assertSee('A SophData nasceu para ajudar pessoas, pequenos negócios e instituições')
        ->assertSee('Diagnóstico inicial')
        ->assertSee('Proposta adequada')
        ->assertSee('Execução organizada')
        ->assertSee('Orientação ao cliente')
        ->assertSee('Fale com a SophData');

    foreach ($areas as $area) {
        $response->assertSee($area);
    }

    foreach ($values as $value) {
        $response->assertSee($value);
    }
});

test('contact page provides channels and a non functional preparation guide', function () {
    $response = $this->get(route('contato'));
    $questions = [
        'Você precisa de atendimento para pessoa física ou empresa?',
        'Qual problema deseja resolver?',
        'É algo urgente?',
        'O atendimento pode ser remoto?',
        'Você precisa de orçamento para algum pacote específico?',
    ];

    $response->assertOk()
        ->assertSee('Fale com a SophData')
        ->assertSee('Explique sua necessidade e receba orientação sobre o pacote mais adequado.')
        ->assertSee('Contato+SophData', false)
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee(config('sophdata.brand.region'))
        ->assertSee('Atendimento presencial sob consulta.')
        ->assertSee('Responder pelo WhatsApp')
        ->assertSee('não possui formulário funcional')
        ->assertSee('https://wa.me/'.config('sophdata.brand.whatsapp'), false);

    foreach ($questions as $question) {
        $response->assertSee($question);
    }
});

test('privacy page explains the current data practices', function () {
    $response = $this->get(route('politica-de-privacidade'));

    $response->assertOk()
        ->assertSee('Site institucional')
        ->assertSee('Contato pelo WhatsApp')
        ->assertSee('Uso dos dados enviados')
        ->assertSee('não possui cadastro de usuários')
        ->assertSee('pagamento online')
        ->assertSee('ferramentas de análise de acesso')
        ->assertSee('Remoção de dados')
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee('Falar pelo WhatsApp');
});

test('whatsapp helper sanitizes the number and encodes the message', function () {
    $url = sophdata_whatsapp_url(
        'Olá, teste & segurança.',
        '55 (21) 99999-0000',
    );

    expect($url)->toBe(
        'https://wa.me/5521999990000?text=Ol%C3%A1%2C%20teste%20%26%20seguran%C3%A7a.',
    );
});

test('commercial pages use contextual whatsapp messages', function () {
    $this->get(route('home'))
        ->assertOk()
        ->assertSee(rawurlencode('Olá, gostaria de conhecer as soluções da SophData.'), false);

    $this->get(route('para-voce'))
        ->assertOk()
        ->assertSee(rawurlencode('Olá, gostaria de atendimento para pessoa física.'), false);

    $this->get(route('para-empresas'))
        ->assertOk()
        ->assertSee(rawurlencode('Olá, gostaria de solicitar um orçamento para minha empresa.'), false);

    $package = config('sophdata.categories.personal.0.packages.0');

    $this->get(route('para-voce'))
        ->assertSee(sophdata_whatsapp_url($package['whatsapp_message']), false);
});

test('footer renders brand navigation solutions contact and legal information', function () {
    $response = $this->get(route('home'));
    $year = now()->year;

    $response->assertOk()
        ->assertSee(config('sophdata.brand.name'))
        ->assertSee(config('sophdata.brand.slogan'))
        ->assertSee('Soluções em TI para pessoas, pequenos negócios e instituições.')
        ->assertSee('Política de Privacidade')
        ->assertSee('Suporte Técnico')
        ->assertSee('Segurança e Backup')
        ->assertSee('Sites e Sistemas')
        ->assertSee('Redes e Infraestrutura')
        ->assertSee('Montagem de Computadores')
        ->assertSee('Consultoria de TI')
        ->assertSee(config('sophdata.brand.whatsapp'))
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee(config('sophdata.brand.region'))
        ->assertSee('Falar no WhatsApp')
        ->assertSee("© {$year} SophData. Todos os direitos reservados.")
        ->assertSee(route('politica-de-privacidade'), false)
        ->assertSee(route('para-voce').'#suporte-digital-pessoal', false)
        ->assertSee(route('para-empresas').'#seguranca-e-backup', false);
});

test('commercial pages keep responsive navigation and external whatsapp behavior', function () {
    $this->get(route('para-voce'))
        ->assertOk()
        ->assertSee('horizontal-scroll', false)
        ->assertSee('lg:top-40', false)
        ->assertSee('target="_blank" rel="noopener noreferrer"', false);

    $this->get(route('para-empresas'))
        ->assertOk()
        ->assertSee('horizontal-scroll', false)
        ->assertSee('Plano recomendado · Profissional')
        ->assertDontSee('Plano recomendado · professional')
        ->assertSee('Falar no WhatsApp');

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('Lorem ipsum')
        ->assertDontSee('R$', false)
        ->assertDontSee('>Quero o Essencial<', false)
        ->assertSee('whatsapp-floating', false);
});
