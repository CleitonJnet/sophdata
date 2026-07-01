# SophData

Site institucional da SophData, organizado como MVP comercial com dois portais públicos: **Para Empresas** e **Para Você**.

## Stack

- Laravel 13
- Blade
- Vite
- Tailwind CSS

## Escopo da Fase 1

- Site institucional
- Dois portais comerciais separados
- Portal padrão para empresas
- Conteúdo estático em arquivos de configuração PHP
- Sem banco de dados
- Sem login
- Sem painel administrativo
- Sem formulário funcional
- Atendimento iniciado por CTA comercial

## Rotas Principais

- `/` redireciona para `/para-empresas`
- `/para-empresas`
- `/para-empresas/{category}`
- `/para-voce`
- `/para-voce/{category}`
- `/escolher-perfil`
- `/sobre`
- `/contato`
- `/politica-de-privacidade`

## Onde Editar Conteúdos

- `config/sophdata.php`: dados gerais da marca, contato, diferenciais, tecnologias, FAQ e caminhos de imagens.
- `config/sophdata_portals.php`: dados dos portais Para Empresas e Para Você.
- `config/sophdata_services.php`: categorias, problemas, pacotes e FAQs por portal.

## Como Rodar Localmente

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
npm run dev
php artisan serve
```

## Como Gerar Build

```bash
npm run build
```

## SEO e Indexação

Em produção, configure `APP_URL=https://sophdata.com.br` e `SOPHDATA_INDEXABLE=true` para permitir que o layout gere `<meta name="robots" content="index, follow">`.

O sitemap oficial é `https://sophdata.com.br/sitemap.xml`, e o `robots.txt` oficial deve permitir o rastreamento do site. Mais detalhes estão em `docs/seo-indexacao.md`.

## Testes

```bash
php artisan test
```

## Próximas Fases

- Imagens reais
- Portfólio
- Depoimentos
- Blog
- Formulário funcional
- Área administrativa
- Sistema de chamados
