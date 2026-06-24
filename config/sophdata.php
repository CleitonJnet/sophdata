<?php

return [
    'brand' => [
        'name' => 'SophData',
        'short_name' => 'SD',
        'slogan' => 'Tecnologia com clareza, organização e confiança.',
        'whatsapp' => '5521972765535',
        'whatsapp_display' => '(21) 97276-5535',
        'email' => 'contato@sophdata.com.br',
        'region' => 'Rio de Janeiro / Atendimento Remoto',
    ],

    'contact' => [
        'whatsapp_number' => env('SOPHDATA_WHATSAPP_NUMBER', env('SOPHDATA_WHATSAPP', '5521972765535')),
        'whatsapp_url' => env('SOPHDATA_WHATSAPP_URL'),
    ],

    'whatsapp_messages' => [
        'neutral' => 'Olá! Quero iniciar atendimento com a SophData.',
        'business' => 'Olá! Quero atendimento empresarial com a SophData.',
        'business_diagnosis' => 'Olá! Quero solicitar um diagnóstico empresarial com a SophData.',
        'business_software' => 'Olá! Quero falar sobre desenvolvimento de software para minha empresa.',
        'business_infrastructure' => 'Olá! Quero avaliar a infraestrutura de TI da minha empresa.',
        'business_servers' => 'Olá! Quero avaliar servidores, backup ou ambiente corporativo para minha empresa.',
        'personal' => 'Olá! Quero atendimento técnico para pessoa física com a SophData.',
        'personal_computer' => 'Olá! Meu computador ou notebook está lento e quero atendimento da SophData.',
        'personal_wifi' => 'Olá! Quero ajuda com internet, Wi-Fi ou roteador em casa.',
        'personal_backup' => 'Olá! Quero orientação sobre backup e organização de arquivos pessoais.',
    ],

    'links' => [
        ['label' => 'Para Empresas', 'route' => 'portal.business'],
        ['label' => 'Para Você', 'route' => 'portal.personal'],
        ['label' => 'Escolher perfil', 'route' => 'portal.choose'],
        ['label' => 'Sobre', 'route' => 'site.about'],
    ],

    'seo' => [
        'indexable' => (bool) env('SOPHDATA_INDEXABLE', false),
        'site_url' => env('APP_URL', 'http://localhost'),
        'default_title' => 'SophData',
        'default_description' => 'Soluções de tecnologia para empresas e pessoas.',
        'default_og_image' => 'img/sophdata/portals/business-hero.webp',
    ],

    'differentials' => [
        'Atendimento humano e didático',
        'Soluções práticas para problemas reais',
        'Experiência com suporte, redes e sistemas',
        'Montagem e upgrade de computadores',
        'Foco em pessoas, pequenos negócios e instituições',
        'Orientação simples e clara',
        'Atendimento remoto e presencial sob consulta',
    ],

    'technologies' => [
        'Linux',
        'Laravel',
        'PHP',
        'MySQL',
        'PostgreSQL',
        'Java',
        'Spring Boot',
        'Redes',
        'Backup',
        'Segurança digital',
    ],

    'faq' => [
        [
            'question' => 'O atendimento é remoto ou presencial?',
            'answer' => 'O atendimento pode ser remoto e, em Niterói/RJ e regiões combinadas, presencial sob consulta.',
        ],
        [
            'question' => 'A SophData atende pessoas físicas e empresas?',
            'answer' => 'Sim. Os portais Para Você e Para Empresas organizam soluções específicas para cada perfil.',
        ],
        [
            'question' => 'É preciso contratar mensalidade?',
            'answer' => 'Não necessariamente. Existem serviços pontuais e opções recorrentes conforme a necessidade.',
        ],
        [
            'question' => 'A SophData cria sites e sistemas?',
            'answer' => 'Sim. Desenvolvemos sites institucionais e sistemas web ajustados aos objetivos de cada projeto.',
        ],
        [
            'question' => 'Há soluções de backup e segurança?',
            'answer' => 'Sim. Planejamos proteção de dispositivos, acessos, arquivos e rotinas de backup.',
        ],
        [
            'question' => 'É possível montar um computador personalizado?',
            'answer' => 'Sim. Planejamos e montamos computadores para uso pessoal e corporativo conforme objetivo e orçamento.',
        ],
        [
            'question' => 'Como funciona a orientação inicial?',
            'answer' => 'A necessidade é entendida antes da recomendação do pacote e do escopo mais adequado.',
        ],
        [
            'question' => 'Como funciona o suporte para empresas?',
            'answer' => 'O suporte pode ser pontual ou recorrente, com atendimento remoto, visitas combinadas e prioridades definidas em proposta.',
        ],
    ],

    'logos' => [
        'symbol' => 'img/SophData-logo.svg',
        'wordmark' => 'img/SophData-text.svg',
        'fallback' => 'SD',
    ],

    'images' => [
        'hero' => 'img/sophdata/portals/business-hero.webp',
        'banner' => 'img/sophdata/cta/contact-banner.webp',
        'category_card' => 'img/sophdata/services/business/suporte-de-ti.webp',
        'menu_card' => 'img/sophdata/menu/business-suporte-de-ti.webp',
        'mobile_thumbnail' => 'img/sophdata/menu/business-suporte-de-ti-mobile.webp',
        'about' => 'img/sophdata/pages/about.webp',
        'contact' => 'img/sophdata/pages/contact-hero.webp',
    ],
];
