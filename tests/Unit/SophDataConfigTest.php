<?php

test('commercial catalog has the expected categories and packages', function () {
    $catalog = require dirname(__DIR__, 2).'/config/sophdata.php';
    $personalCategories = $catalog['categories']['personal'];
    $businessCategories = $catalog['categories']['business'];
    $categories = [...$personalCategories, ...$businessCategories];

    expect($catalog['brand']['name'])->toBe('SophData')
        ->and($catalog['brand']['whatsapp'])->toBe('5521972765535')
        ->and($personalCategories)->toHaveCount(6)
        ->and($businessCategories)->toHaveCount(9)
        ->and($catalog['differentials'])->toHaveCount(7)
        ->and($catalog['faq'])->toHaveCount(8);

    $slugs = [];

    foreach ($categories as $category) {
        expect($category)->toHaveKeys([
            'slug',
            'title',
            'eyebrow',
            'short_description',
            'description',
            'audience',
            'image',
            'packages',
        ])->and($category['packages'])->toHaveCount(3);

        $slugs[] = $category['slug'];

        foreach ($category['packages'] as $package) {
            expect($package)->toHaveKeys([
                'level',
                'name',
                'subtitle',
                'description',
                'included_items',
                'featured',
                'badge',
                'button_text',
                'whatsapp_message',
            ])->and($package['name'])->not->toBeEmpty()
                ->and($package['button_text'])->toBeIn(['Falar no WhatsApp', 'Solicitar orçamento'])
                ->and($package['description'])->not->toMatch('/(?:R\\$|\\$\\s*\\d|\\bpreço\\b)/iu');
        }

        expect(array_column($category['packages'], 'level'))->toBe([
            'essential',
            'professional',
            'complete',
        ])->and(array_column($category['packages'], 'featured'))->toBe([
            false,
            true,
            false,
        ]);
    }

    expect($slugs)->toHaveCount(count(array_unique($slugs)));
});

test('personal categories use the requested commercial package names', function () {
    $catalog = require dirname(__DIR__, 2).'/config/sophdata.php';
    $personalCategories = $catalog['categories']['personal'];

    expect(array_map(
        fn (array $category): array => array_column($category['packages'], 'name'),
        $personalCategories,
    ))->toBe([
        ['SOS Digital Essencial', 'Computador em Ordem', 'Suporte Pessoal Completo'],
        ['Wi-Fi Essencial', 'Casa Conectada Plus', 'Home Office Seguro'],
        ['Contas Protegidas', 'Família Segura Digital', 'Blindagem Digital Familiar'],
        ['Kit Estudante Digital', 'Carreira Digital Profissional', 'Mentoria Digital de Carreira'],
        ['IA para o Dia a Dia', 'Produtividade Digital com IA', 'Oficina IA Profissional'],
        ['Upgrade Essencial', 'PC Sob Medida', 'Estação Completa Personalizada'],
    ]);
});

test('business categories use the requested commercial package names', function () {
    $catalog = require dirname(__DIR__, 2).'/config/sophdata.php';
    $businessCategories = $catalog['categories']['business'];

    expect(array_map(
        fn (array $category): array => array_column($category['packages'], 'name'),
        $businessCategories,
    ))->toBe([
        ['TI Essencial Empresarial', 'TI Profissional Mensal', 'TI Completa para Pequenos Negócios'],
        ['Rede Organizada Essencial', 'Infraestrutura Profissional', 'Ambiente Corporativo Conectado'],
        ['Check-up de Segurança', 'Empresa Segura', 'Blindagem Empresarial Digital'],
        ['Página Profissional Essencial', 'Site Institucional Profissional', 'Presença Digital Completa'],
        ['Sistema Essencial de Gestão', 'Sistema Profissional Sob Medida', 'Plataforma Completa de Gestão'],
        ['Planilhas Inteligentes', 'Automação Administrativa', 'Fluxo Digital Automatizado'],
        ['Publicação Web Essencial', 'Deploy Profissional de Sistemas', 'Servidor Gerenciado Linux'],
        ['Diagnóstico de TI', 'Plano de Modernização Digital', 'Gestão Consultiva de TI'],
        ['Estação Corporativa Essencial', 'Renovação Profissional do Parque de TI', 'Ambiente Corporativo Completo'],
    ]);
});
