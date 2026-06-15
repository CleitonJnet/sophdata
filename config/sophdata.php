<?php

$packageImage = 'https://placehold.co/480x320/FFFFFF/0B1F4D?text=Pacote';

$packages = static function (string $service) use ($packageImage): array {
    return [
        [
            'level' => 'essential',
            'name' => 'Essencial',
            'subtitle' => 'O necessário para começar',
            'description' => "Uma solução objetiva de {$service} para necessidades pontuais e ambientes menores.",
            'included_items' => [
                'Diagnóstico inicial',
                'Execução do escopo essencial',
                'Orientações de uso e boas práticas',
            ],
            'featured' => false,
            'badge' => 'Para começar',
            'button_text' => 'Falar no WhatsApp',
            'whatsapp_message' => "Olá, gostaria de saber mais sobre o pacote Essencial de {$service}.",
            'image' => $packageImage,
        ],
        [
            'level' => 'professional',
            'name' => 'Profissional',
            'subtitle' => 'Equilíbrio entre alcance e investimento',
            'description' => "Atendimento mais completo de {$service}, com planejamento, execução e acompanhamento.",
            'included_items' => [
                'Tudo do pacote Essencial',
                'Configuração e otimização avançadas',
                'Acompanhamento após a entrega',
            ],
            'featured' => true,
            'badge' => 'Mais escolhido',
            'button_text' => 'Falar no WhatsApp',
            'whatsapp_message' => "Olá, gostaria de saber mais sobre o pacote Profissional de {$service}.",
            'image' => $packageImage,
        ],
        [
            'level' => 'complete',
            'name' => 'Completo',
            'subtitle' => 'Cobertura ampla e personalizada',
            'description' => "Uma entrega abrangente de {$service}, adaptada a cenários que exigem maior profundidade.",
            'included_items' => [
                'Tudo do pacote Profissional',
                'Plano personalizado de implementação',
                'Suporte prioritário no período acordado',
            ],
            'featured' => false,
            'badge' => 'Melhor cobertura',
            'button_text' => 'Falar no WhatsApp',
            'whatsapp_message' => "Olá, gostaria de saber mais sobre o pacote Completo de {$service}.",
            'image' => $packageImage,
        ],
    ];
};

$category = static function (
    string $slug,
    string $title,
    string $eyebrow,
    string $shortDescription,
    string $description,
    string $audience,
    array $packageNames = [],
) use ($packages): array {
    $categoryPackages = $packages($title);

    foreach ($categoryPackages as $index => &$package) {
        if (! isset($packageNames[$index])) {
            continue;
        }

        $package['name'] = $packageNames[$index];
        $package['button_text'] = 'Falar no WhatsApp';
        $package['whatsapp_message'] = "Olá, gostaria de saber mais sobre o pacote {$packageNames[$index]}.";
    }
    unset($package);

    return [
        'slug' => $slug,
        'title' => $title,
        'eyebrow' => $eyebrow,
        'short_description' => $shortDescription,
        'description' => $description,
        'audience' => $audience,
        'image' => 'https://placehold.co/1200x360/F3F6FA/0B1F4D?text='.rawurlencode($title),
        'packages' => $categoryPackages,
    ];
};

return [
    'brand' => [
        'name' => 'SophData',
        'short_name' => 'SD',
        'slogan' => 'Tecnologia com clareza, organização e confiança.',
        'whatsapp' => '5521972765535',
        'email' => 'contato@sophdata.com.br',
        'region' => 'Niterói/RJ e atendimento remoto',
        'primary_color' => 'azul',
        'cta_color' => 'laranja ou vermelho',
    ],

    'links' => [
        ['label' => 'Início', 'route' => 'home'],
        ['label' => 'Para Você', 'route' => 'para-voce'],
        ['label' => 'Para Empresas', 'route' => 'para-empresas'],
        ['label' => 'Sobre', 'route' => 'sobre'],
        ['label' => 'Contato', 'route' => 'contato'],
    ],

    'images' => [
        'hero_desktop' => 'https://placehold.co/1440x520/0B1F4D/FFFFFF?text=SophData+Hero',
        'internal_banner' => 'https://placehold.co/1200x360/0B1F4D/FFFFFF?text=Banner+SophData',
        'category_card' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Categoria',
        'package_card' => $packageImage,
        'about' => 'https://placehold.co/720x720/F3F6FA/0B1F4D?text=Sobre+SophData',
    ],

    'categories' => [
        'personal' => [
            $category(
                'suporte-digital-pessoal',
                'Suporte Digital Pessoal',
                'Ajuda técnica sem complicação',
                'Solução de problemas em computadores, celulares, programas e contas digitais.',
                'Diagnóstico, configuração e orientação para você usar seus dispositivos com mais segurança e tranquilidade.',
                'Pessoas que precisam resolver dificuldades tecnológicas do dia a dia.',
                ['SOS Digital Essencial', 'Computador em Ordem', 'Suporte Pessoal Completo'],
            ),
            $category(
                'casa-conectada',
                'Casa Conectada',
                'Conectividade em todos os ambientes',
                'Configuração de Wi-Fi, impressoras, TVs e dispositivos inteligentes.',
                'Organização da rede e integração dos equipamentos da casa para uma experiência estável e simples.',
                'Residências que desejam melhor cobertura, integração e desempenho da rede.',
                ['Wi-Fi Essencial', 'Casa Conectada Plus', 'Home Office Seguro'],
            ),
            $category(
                'protecao-digital-familiar',
                'Proteção Digital Familiar',
                'Mais segurança para toda a família',
                'Proteção de dispositivos, contas, arquivos e hábitos digitais.',
                'Configurações e orientações para reduzir riscos, evitar golpes e proteger informações importantes.',
                'Famílias que querem navegar, estudar e trabalhar com mais segurança.',
                ['Contas Protegidas', 'Família Segura Digital', 'Blindagem Digital Familiar'],
            ),
            $category(
                'estudos-e-carreira',
                'Estudos e Carreira',
                'Tecnologia para aprender e crescer',
                'Organização de ferramentas, equipamentos e rotina digital para estudo e trabalho.',
                'Preparação do ambiente tecnológico para aulas, processos seletivos, trabalho remoto e desenvolvimento profissional.',
                'Estudantes, profissionais em transição e pessoas em trabalho remoto.',
                ['Kit Estudante Digital', 'Carreira Digital Profissional', 'Mentoria Digital de Carreira'],
            ),
            $category(
                'ia-e-produtividade',
                'IA e Produtividade',
                'Ferramentas inteligentes na prática',
                'Uso responsável de inteligência artificial e automações pessoais.',
                'Orientação para escolher e aplicar ferramentas de IA na organização, criação, pesquisa e produtividade.',
                'Pessoas que desejam produzir melhor e economizar tempo com tecnologia.',
                ['IA para o Dia a Dia', 'Produtividade Digital com IA', 'Oficina IA Profissional'],
            ),
            $category(
                'montagem-e-upgrade-de-computadores',
                'Montagem e Upgrade de Computadores',
                'Desempenho adequado ao seu objetivo',
                'Planejamento, montagem e atualização de computadores personalizados.',
                'Escolha equilibrada de componentes, montagem, configuração e testes conforme uso e orçamento.',
                'Usuários domésticos, estudantes, profissionais, criadores e jogadores.',
                ['Upgrade Essencial', 'PC Sob Medida', 'Estação Completa Personalizada'],
            ),
        ],

        'business' => [
            $category(
                'suporte-de-ti',
                'Suporte de TI',
                'Sua equipe trabalhando sem interrupções',
                'Atendimento técnico remoto e presencial para usuários e equipamentos.',
                'Suporte organizado para reduzir paradas, orientar usuários e manter a operação funcionando.',
                'Pequenas empresas, escritórios, comércios e instituições.',
                ['TI Essencial Empresarial', 'TI Profissional Mensal', 'TI Completa para Pequenos Negócios'],
            ),
            $category(
                'infraestrutura-e-redes',
                'Infraestrutura e Redes',
                'Conectividade estável para o negócio',
                'Planejamento e organização de redes, Wi-Fi e equipamentos.',
                'Implantação e melhoria da infraestrutura para ampliar estabilidade, cobertura e capacidade de crescimento.',
                'Empresas que dependem de conectividade confiável em sua operação.',
                ['Rede Organizada Essencial', 'Infraestrutura Profissional', 'Ambiente Corporativo Conectado'],
            ),
            $category(
                'seguranca-e-backup',
                'Segurança e Backup',
                'Dados protegidos e recuperáveis',
                'Proteção de acessos, dispositivos e informações importantes.',
                'Boas práticas, rotinas de backup e camadas de proteção alinhadas aos riscos do negócio.',
                'Organizações que precisam reduzir riscos e garantir continuidade.',
                ['Check-up de Segurança', 'Empresa Segura', 'Blindagem Empresarial Digital'],
            ),
            $category(
                'sites-e-presenca-digital',
                'Sites e Presença Digital',
                'Sua marca bem apresentada na internet',
                'Sites institucionais e páginas comerciais responsivas.',
                'Planejamento e desenvolvimento de presença digital clara, rápida e alinhada aos objetivos comerciais.',
                'Negócios, profissionais e instituições que precisam fortalecer sua presença online.',
                ['Página Profissional Essencial', 'Site Institucional Profissional', 'Presença Digital Completa'],
            ),
            $category(
                'sistemas-web',
                'Sistemas Web',
                'Processos organizados em uma solução própria',
                'Desenvolvimento de sistemas web adaptados à operação.',
                'Aplicações para organizar informações, fluxos e atividades que ferramentas genéricas não atendem bem.',
                'Empresas com processos específicos que precisam de centralização e controle.',
                ['Sistema Essencial de Gestão', 'Sistema Profissional Sob Medida', 'Plataforma Completa de Gestão'],
            ),
            $category(
                'automacao-e-dados',
                'Automação e Dados',
                'Menos tarefas repetitivas, mais informação',
                'Automação de rotinas, integrações e organização de dados.',
                'Mapeamento de processos e criação de soluções para reduzir trabalho manual e melhorar decisões.',
                'Equipes que lidam com planilhas, relatórios e tarefas operacionais repetitivas.',
                ['Planilhas Inteligentes', 'Automação Administrativa', 'Fluxo Digital Automatizado'],
            ),
            $category(
                'hospedagem-e-servidores',
                'Hospedagem e Servidores',
                'Ambientes disponíveis e bem administrados',
                'Configuração, publicação e acompanhamento de serviços e aplicações.',
                'Estrutura adequada para hospedar sites, sistemas, arquivos e serviços com organização e segurança.',
                'Empresas que mantêm serviços digitais próprios ou de terceiros.',
                ['Publicação Web Essencial', 'Deploy Profissional de Sistemas', 'Servidor Gerenciado Linux'],
            ),
            $category(
                'consultoria-e-treinamentos',
                'Consultoria e Treinamentos',
                'Decisões melhores e equipes mais preparadas',
                'Diagnósticos, planejamento tecnológico e capacitação prática.',
                'Orientação para priorizar investimentos, melhorar processos e desenvolver autonomia na equipe.',
                'Gestores, equipes administrativas, educacionais e operacionais.',
                ['Diagnóstico de TI', 'Plano de Modernização Digital', 'Gestão Consultiva de TI'],
            ),
            $category(
                'montagem-e-renovacao-de-computadores-corporativos',
                'Montagem e Renovação de Computadores Corporativos',
                'Equipamentos adequados à operação',
                'Planejamento, montagem, padronização e renovação do parque de computadores.',
                'Análise de uso, escolha de componentes e implantação para equilibrar desempenho, durabilidade e orçamento.',
                'Empresas que precisam comprar, atualizar ou padronizar computadores.',
                ['Estação Corporativa Essencial', 'Renovação Profissional do Parque de TI', 'Ambiente Corporativo Completo'],
            ),
        ],
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

    'faq' => [
        [
            'question' => 'O atendimento é remoto ou presencial?',
            'answer' => 'O atendimento pode ser remoto e, em Niterói/RJ e regiões combinadas, presencial sob consulta.',
        ],
        [
            'question' => 'Você atende pessoas físicas e empresas?',
            'answer' => 'Sim. A SophData possui soluções específicas para pessoas, pequenos negócios, empresas e instituições.',
        ],
        [
            'question' => 'É preciso contratar mensalidade?',
            'answer' => 'Não necessariamente. Existem serviços pontuais e opções recorrentes conforme a necessidade.',
        ],
        [
            'question' => 'Você cria sites e sistemas?',
            'answer' => 'Sim. Desenvolvemos sites institucionais e sistemas web ajustados aos objetivos de cada projeto.',
        ],
        [
            'question' => 'Trabalha com backup e segurança?',
            'answer' => 'Sim. Planejamos proteção de dispositivos, acessos, arquivos e rotinas de backup.',
        ],
        [
            'question' => 'Faz montagem de computadores personalizados?',
            'answer' => 'Sim. Planejamos e montamos computadores para uso pessoal e corporativo conforme objetivo e orçamento.',
        ],
        [
            'question' => 'O orçamento é gratuito?',
            'answer' => 'A conversa inicial e a análise preliminar são gratuitas. Projetos que exigem diagnóstico aprofundado podem ter escopo próprio.',
        ],
        [
            'question' => 'Como funciona o suporte para empresas?',
            'answer' => 'O suporte pode ser pontual ou recorrente, com atendimento remoto, visitas combinadas e prioridades definidas em proposta.',
        ],
    ],
];
