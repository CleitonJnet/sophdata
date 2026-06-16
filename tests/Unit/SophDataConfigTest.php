<?php

test('general configuration contains institutional data and real logo paths', function () {
    $config = require dirname(__DIR__, 2).'/config/sophdata.php';

    expect($config['brand'])->toMatchArray([
        'name' => 'SophData',
        'short_name' => 'SD',
        'slogan' => 'Tecnologia com clareza, organização e confiança.',
        'whatsapp' => '5521972765535',
        'whatsapp_display' => '(21) 97276-5535',
    ])->and($config['links'])->not->toBeEmpty()
        ->and($config['differentials'])->not->toBeEmpty()
        ->and($config['technologies'])->not->toBeEmpty()
        ->and($config['faq'])->not->toBeEmpty()
        ->and(dirname(__DIR__, 2).'/public/'.$config['logos']['symbol'])->toBeFile()
        ->and(dirname(__DIR__, 2).'/public/'.$config['logos']['wordmark'])->toBeFile();
});

test('portal configuration defines both commercial identities', function () {
    $portals = require dirname(__DIR__, 2).'/config/sophdata_portals.php';

    expect($portals)->toHaveKeys(['business', 'personal'])
        ->and($portals['business'])->toMatchArray([
            'key' => 'business',
            'label' => 'Para Empresas',
            'route' => 'portal.business',
            'url' => '/para-empresas',
            'primary_cta' => 'Solicitar atendimento empresarial',
        ])->and($portals['personal'])->toMatchArray([
            'key' => 'personal',
            'label' => 'Para Você',
            'route' => 'portal.personal',
            'url' => '/para-voce',
            'primary_cta' => 'Quero atendimento',
        ]);
});

test('service catalog separates portals and provides complete category structures', function () {
    $services = require dirname(__DIR__, 2).'/config/sophdata_services.php';
    $categoryKeys = [
        'key', 'slug', 'portal', 'title', 'eyebrow', 'short_description',
        'description', 'menu_title', 'menu_description', 'image', 'menu_image', 'mobile_image',
        'hero_image', 'benefits', 'problems_solved', 'customer_problem_cards',
        'packages', 'faq',
    ];
    $packageKeys = [
        'level', 'level_label', 'name', 'positioning', 'best_for', 'subtitle',
        'description', 'included_items', 'commercial_summary', 'featured',
        'badge', 'cta_label', 'whatsapp_message',
    ];

    expect($services['business'])->toHaveCount(6)
        ->and($services['personal'])->toHaveCount(5);

    foreach (['business', 'personal'] as $portal) {
        $categories = $services[$portal];

        foreach ($categories as $category) {
            expect($category)->toHaveKeys($categoryKeys)
                ->and($category['portal'])->toBe($portal)
                ->and($category['key'])->toMatch('/^[a-z][a-z0-9_]+$/')
                ->and($category['slug'])->toMatch('/^[a-z0-9-]+$/')
                ->and($category['benefits'])->not->toBeEmpty()
                ->and($category['problems_solved'])->not->toBeEmpty()
                ->and($category['customer_problem_cards'])->not->toBeEmpty()
                ->and($category['packages'])->toHaveCount(3)
                ->and($category['image'])->toStartWith('https://placehold.co/')
                ->and($category['menu_image'])->toStartWith('https://placehold.co/')
                ->and($category['hero_image'])->toStartWith('https://placehold.co/');

            foreach ($category['customer_problem_cards'] as $card) {
                expect($card)->toHaveKeys([
                    'title', 'description', 'target_category_slug', 'cta_label', 'image',
                ])->and($card['target_category_slug'])->toBe($category['slug'])
                    ->and($card['cta_label'])->toBe('Conhecer solução');
            }

            foreach ($category['packages'] as $package) {
                expect($package)->toHaveKeys($packageKeys)
                    ->and($package['cta_label'])->toBe('Escolher este pacote')
                    ->and($package['included_items'])->not->toContain('Diagnóstico inicial')
                    ->and($package['included_items'])->not->toContain('Execução do escopo essencial');
            }

            expect(array_column($category['packages'], 'level'))->toBe([
                'essential', 'professional', 'complete',
            ])->and(array_column($category['packages'], 'level_label'))->toBe([
                'Essencial', 'Profissional', 'Completo',
            ])->and(array_column($category['packages'], 'featured'))->toBe([
                false, true, false,
            ])->and(array_slice(
                $category['packages'][1]['included_items'],
                0,
                count($category['packages'][0]['included_items']),
            ))->toBe($category['packages'][0]['included_items'])
                ->and(array_slice(
                    $category['packages'][2]['included_items'],
                    0,
                    count($category['packages'][1]['included_items']),
                ))->toBe($category['packages'][1]['included_items']);
        }
    }
});

test('service configuration provides general FAQ for both portals', function () {
    $services = require dirname(__DIR__, 2).'/config/sophdata_services.php';

    expect($services['portal_faq'])->toHaveKeys(['business', 'personal'])
        ->and($services['portal_faq']['business'])->not->toBeEmpty()
        ->and($services['portal_faq']['personal'])->not->toBeEmpty();
});

test('problem catalog includes the requested customer situations', function () {
    $services = require dirname(__DIR__, 2).'/config/sophdata_services.php';
    $businessTitles = collect($services['business'])
        ->flatMap(fn (array $category): array => $category['customer_problem_cards'])
        ->pluck('title');
    $personalTitles = collect($services['personal'])
        ->flatMap(fn (array $category): array => $category['customer_problem_cards'])
        ->pluck('title');

    expect($businessTitles)->toContain(
        'Computadores parando?',
        'Internet ou Wi-Fi instável?',
        'Sua empresa não tem backup?',
        'Precisa de site ou sistema?',
        'Usa planilhas demais?',
        'Precisa renovar os computadores?',
    )->and($personalTitles)->toContain(
        'Meu computador está lento',
        'Meu Wi-Fi está ruim',
        'Quero proteger meus arquivos',
        'Preciso organizar estudos ou carreira',
        'Quero montar ou melhorar meu PC',
    );
});
