# SEO e indexação SophData

## Resumo

Este documento registra os ajustes técnicos necessários para que o site público da SophData seja rastreável, interpretável e indexável por mecanismos de busca.

Os problemas corrigidos no repositório foram:

- `public/robots.txt` não deve bloquear todos os robôs.
- `public/sitemap.xml` deve usar somente o domínio oficial `https://sophdata.com.br`.
- O layout deve gerar `index, follow` apenas quando a produção estiver explicitamente configurada como indexável.
- O site deve ter canonical, metadados padrão, sitemap, robots e dados estruturados básicos coerentes com a marca.

## robots.txt

O arquivo `public/robots.txt` deve permitir rastreamento:

```txt
User-agent: *
Allow: /

Sitemap: https://sophdata.com.br/sitemap.xml
```

Ele não deve conter `Disallow: /` em produção, pois isso impede que mecanismos de busca rastreiem o site.

## sitemap.xml

O sitemap oficial fica em:

```txt
https://sophdata.com.br/sitemap.xml
```

Todas as URLs dentro do sitemap devem usar o domínio oficial `https://sophdata.com.br`. Não use domínio provisório, `localhost`, IP, subdomínio antigo ou ambiente de teste.

## SOPHDATA_INDEXABLE

O projeto mantém o padrão seguro para desenvolvimento:

```php
'indexable' => (bool) env('SOPHDATA_INDEXABLE', false),
```

Isso evita indexação acidental de ambientes locais ou de homologação. No servidor de produção, configure explicitamente `SOPHDATA_INDEXABLE=true`.

## Variáveis de produção

No `.env` de produção:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://sophdata.com.br
SOPHDATA_INDEXABLE=true
```

Não altere nem publique o `.env` real no repositório.

## Cache e build

Após atualizar o servidor, execute:

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## Validação do site publicado

Depois do deploy, valide:

```bash
curl -sL https://sophdata.com.br/robots.txt
curl -sL https://sophdata.com.br/sitemap.xml | head
curl -sL https://sophdata.com.br/para-empresas | grep -i 'meta name="robots"'
curl -sL https://sophdata.com.br/para-empresas | grep -i 'canonical'
```

O resultado esperado para robots em produção é:

```html
<meta name="robots" content="index, follow">
```

Também confira se `/` redireciona para `/para-empresas` e se `/para-empresas` responde normalmente.

## Google Search Console

1. Acesse o Google Search Console.
2. Crie ou selecione a propriedade de domínio `sophdata.com.br`.
3. Verifique a propriedade pelo método recomendado pelo Google, preferencialmente DNS.
4. Envie o sitemap `https://sophdata.com.br/sitemap.xml`.
5. Use a inspeção de URL para testar `https://sophdata.com.br/para-empresas`.
6. Solicite indexação das páginas principais após confirmar que elas não têm `noindex`.

## Perfil da Empresa no Google

Crie ou verifique o Perfil da Empresa no Google para a SophData. Use apenas informações reais e verificáveis da empresa. Não invente endereço físico, horário, avaliações ou dados fiscais.

## Checklist antes do deploy

- `APP_URL=https://sophdata.com.br`.
- `APP_ENV=production`.
- `APP_DEBUG=false`.
- `SOPHDATA_INDEXABLE=true`.
- `robots.txt` permite rastreamento.
- `sitemap.xml` usa apenas `https://sophdata.com.br`.
- A página `/para-empresas` gera `index, follow`.
- Canonical aponta para o domínio oficial.
- Caches Laravel foram limpos e recriados.
- Assets foram recompilados com `npm run build`.
- Sitemap foi enviado no Google Search Console.

Mesmo com tudo correto, a indexação no Google não é imediata. O Google precisa rastrear, processar e decidir quando exibir as páginas nos resultados.
