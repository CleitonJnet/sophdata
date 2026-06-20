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
- `/contato` redireciona para o atendimento via WhatsApp quando configurado; sem WhatsApp, cai em `/para-empresas/contato`.
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

## Configuração de ambiente

1. Copie `.env.example` para `.env`.
2. Gere a chave da aplicação com `php artisan key:generate`.
3. Ajuste `APP_URL`, banco de dados e contatos conforme o ambiente.
4. Em ambiente público, use `APP_DEBUG=false`.
5. Mantenha `SOPHDATA_INDEXABLE=false` em homologação ou domínio provisório; altere para `true` somente quando o domínio de produção estiver definido.
6. Use `APP_LOCALE=pt_BR`.

## Atendimento via WhatsApp

Os CTAs de atendimento usam `SOPHDATA_WHATSAPP_NUMBER` ou `SOPHDATA_WHATSAPP_URL`. As mensagens base ficam centralizadas em `config/sophdata.php`, separadas por contexto: neutro, Empresarial e Para Você. Não há formulário funcional nesta fase.

## Como Gerar Build

```bash
npm run build
```

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
