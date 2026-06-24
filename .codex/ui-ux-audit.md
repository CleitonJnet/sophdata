# SophData UI/UX Audit

Data: 2026-06-16

## Componentes encontrados

- Layout base: `resources/views/layouts/site.blade.php`
- Header e menu superior: `resources/views/components/site/header.blade.php`
- Alternador de portal: `resources/views/components/site/portal-switcher.blade.php`
- Menu inferior de servicos: `resources/views/components/site/header.blade.php`
- Hero/carousel: `resources/views/components/site/hero-banner.blade.php`
- Carousel de `/para-empresas`: `resources/views/pages/business/index.blade.php`
- Carousel de `/para-voce`: `resources/views/pages/personal/index.blade.php`
- Breadcrumb de categorias: `resources/views/components/site/category-page.blade.php`
- Cards de pacote: `resources/views/components/site/package-card.blade.php`
- Imagens/area de CTA: `resources/views/components/site/cta-section.blade.php`
- Pagina de politica de privacidade: `resources/views/pages/privacy-policy.blade.php`

## Observacoes de preservacao

- O componente `hero-banner.blade.php` usa Swiper com a classe `.site-hero-carousel`.
- As paginas `/para-empresas` e `/para-voce` montam o array `$heroSlides` e passam para `<x-site.hero-banner>`.
- O layout carrega Swiper via CDN em `site.blade.php`.
- O carousel dos heros dos dois perfis deve ser preservado em qualquer ajuste futuro.
- O arquivo provavel `resources/views/components/site/portal-mega-menu.blade.php` nao existe no projeto atual; a navegacao de servicos esta no `header.blade.php`.

## Arquivos candidatos para proximos ajustes

- `resources/css/app.css`
- `resources/views/layouts/site.blade.php`
- `resources/views/components/site/header.blade.php`
- `resources/views/components/site/portal-switcher.blade.php`
- `resources/views/components/site/hero-banner.blade.php`
- `resources/views/components/site/category-page.blade.php`
- `resources/views/components/site/package-card.blade.php`
- `resources/views/components/site/cta-section.blade.php`
- `resources/views/components/site/category-card.blade.php`
- `resources/views/pages/business/index.blade.php`
- `resources/views/pages/personal/index.blade.php`
- `resources/views/pages/about.blade.php`
- `resources/views/pages/contact.blade.php`
- `resources/views/pages/privacy-policy.blade.php`
- `config/sophdata.php`
- `config/sophdata_portals.php`
- `config/sophdata_services.php`
- `routes/web.php`

## Restricoes para os proximos prompts

- Nao criar banco de dados, login, painel administrativo ou formulario funcional.
- Nao remover rotas existentes.
- Nao remover nem substituir o carousel dos heros.
- Nao trocar textos principais sem necessidade.
- Manter nomes de arquivos, classes, componentes e variaveis em ingles.
- Manter textos visiveis ao usuario em portugues.
