# Especificação funcional — Funil PF/PJ de atendimento SophData

## 1. Objetivo do funil

O funil PF/PJ define como a SophData deve receber, classificar e registrar solicitações vindas do site, separando pessoa física e pessoa jurídica desde o primeiro contato.

O objetivo é transformar os CTAs públicos em uma jornada mais organizada, com baixa fricção para o visitante e informações suficientes para a SophData retornar com o melhor próximo passo.

O funil não substitui o atendimento humano. Ele organiza a entrada, registra o contexto inicial e reduz retrabalho antes do primeiro contato ativo.

## 2. Visão geral da jornada

Jornada para novo atendimento:

```txt
Visitante acessa o site
→ CTA/botão
→ dialog de atendimento
→ contexto PF/PJ detectado ou escolhido
→ opção "Novo atendimento"
→ coleta mínima de dados
→ consentimento LGPD
→ lead_request registrado
→ SophData analisa
→ contato ativo pelo canal preferido
```

Jornada para cliente existente:

```txt
Visitante acessa o site
→ CTA/botão ou dialog
→ opção "Já sou cliente"
→ login
→ painel do cliente
→ abertura ou acompanhamento de atendimento
→ service_request registrado
```

O funil deve priorizar clareza e rapidez. O visitante informa apenas o necessário para iniciar o contato, sem precisar criar conta antes de registrar uma solicitação inicial.

## 3. Perfis atendidos

Pessoa Física é o visitante que procura suporte para uso pessoal, residência, estudos, carreira ou equipamentos próprios.

Exemplos:

- computador lento ou travando;
- notebook com problema;
- internet, Wi-Fi ou dispositivos em casa;
- impressora;
- backup pessoal;
- senhas e segurança básica;
- orientação técnica para compra, upgrade ou uso de ferramentas.

Pessoa Jurídica é o visitante que procura atendimento para empresa, equipe, operação, infraestrutura, sistemas, servidores ou ambiente corporativo.

Exemplos:

- site, sistema, automação ou área logada;
- suporte técnico recorrente;
- rede, Wi-Fi corporativo e documentação;
- servidor de arquivos, backup, VPN ou Active Directory;
- planos empresariais;
- organização de tecnologia para reduzir improviso e retrabalho.

## 4. Entradas do funil

O funil poderá ser acionado por:

- botão fixo de atendimento;
- header;
- CTAs de hero;
- cards de serviços;
- páginas de serviços;
- páginas de planos;
- páginas de contato;
- futuras rotas específicas de atendimento.

Rotas futuras previstas:

```txt
/para-empresas/atendimento/iniciar
/para-voce/atendimento/iniciar
/atendimento/iniciar
```

Essas rotas não precisam existir nesta etapa. Elas servem como referência funcional para implementação futura.

## 5. Detecção de contexto por rota

O funil deve tentar identificar o perfil antes de perguntar ao visitante.

Regras:

```txt
/para-voce/* -> contexto PF
/para-empresas/* -> contexto PJ
demais rotas -> contexto neutro
```

Exemplos:

- `/para-voce` abre o funil em contexto PF;
- `/para-voce/contato` abre o funil em contexto PF;
- `/para-empresas` abre o funil em contexto PJ;
- `/para-empresas/desenvolvimento-de-software` abre o funil em contexto PJ;
- `/para-empresas/planos` abre o funil em contexto PJ;
- `/` abre o funil em contexto neutro;
- `/contato` abre o funil em contexto neutro, se existir como página geral.

Em contexto neutro, o dialog deve perguntar primeiro se o atendimento é pessoal ou empresarial.

## 6. Funil de Pessoa Física

Fluxo recomendado:

1. Visitante aciona um CTA no perfil Para Você ou em rota neutra.
2. Sistema identifica contexto PF ou pergunta o perfil em rota neutra.
3. Dialog apresenta as opções "Novo atendimento" e "Já sou cliente".
4. Visitante escolhe "Novo atendimento".
5. Sistema solicita dados mínimos.
6. Visitante informa o problema ou interesse de forma curta.
7. Visitante aceita a política de privacidade.
8. Sistema registra um `lead_request` com perfil PF.
9. SophData recebe o registro para análise.
10. SophData retorna pelo canal preferido ou pelo canal disponível.

Dados obrigatórios para PF:

- nome;
- telefone;
- e-mail;
- aceite da política de privacidade.

Dados opcionais para PF:

- serviço de interesse;
- mensagem curta;
- melhor horário para retorno;
- canal preferido;
- consentimento de marketing.

Serviços de interesse para PF:

- computador lento ou travando;
- internet, Wi-Fi e dispositivos;
- backup, senhas e segurança;
- estudos, carreira e IA;
- montagem e upgrade de PC;
- suporte técnico pessoal;
- outro assunto.

O funil PF deve usar linguagem simples, sem termos como infraestrutura corporativa, continuidade operacional ou ambiente gerenciado.

## 7. Funil de Pessoa Jurídica

Fluxo recomendado:

1. Visitante aciona um CTA no perfil Para Empresas ou em rota neutra.
2. Sistema identifica contexto PJ ou pergunta o perfil em rota neutra.
3. Dialog apresenta as opções "Novo atendimento" e "Já sou cliente".
4. Visitante escolhe "Novo atendimento".
5. Sistema solicita dados mínimos empresariais.
6. Visitante informa a área de interesse ou necessidade principal.
7. Visitante aceita a política de privacidade.
8. Sistema registra um `lead_request` com perfil PJ.
9. SophData analisa a solicitação e classifica o tipo de demanda.
10. SophData retorna com orientação sobre diagnóstico, atendimento, proposta ou próximo passo.

Dados obrigatórios para PJ:

- nome;
- telefone;
- e-mail;
- nome da empresa;
- aceite da política de privacidade.

Dados opcionais para PJ:

- área de interesse;
- mensagem curta;
- melhor horário para retorno;
- canal preferido;
- consentimento de marketing.

Áreas de interesse para PJ:

- sites, sistemas e automações;
- suporte, rede e infraestrutura;
- servidores, backup e acessos;
- planos empresariais;
- diagnóstico inicial;
- outro assunto.

O nome da empresa deve ser obrigatório apenas no fluxo PJ. O funil PF não deve exigir empresa, CNPJ ou cargo.

## 8. Funil em rotas neutras

Quando o visitante estiver em uma rota sem contexto claro, o dialog deve iniciar com a pergunta:

```txt
O atendimento é para você ou para uma empresa?
```

Opções:

```txt
Para mim
Para minha empresa
```

Depois da escolha:

- "Para mim" segue o funil PF;
- "Para minha empresa" segue o funil PJ.

A escolha deve ser salva no registro inicial para evitar mistura entre perfis.

## 9. Fluxo de novo atendimento

O fluxo de novo atendimento é destinado a visitantes ainda não autenticados ou pessoas que querem iniciar uma primeira conversa.

Regras:

- não exigir login antes da captação inicial;
- não exigir criação de senha;
- não pedir documentos sensíveis no primeiro contato;
- registrar a solicitação como `lead_request`;
- separar perfil PF e PJ;
- registrar origem, rota e contexto quando possível;
- permitir que a SophData faça o contato ativo depois.

O objetivo é captar uma solicitação clara, não fechar todo o atendimento dentro do dialog.

## 10. Fluxo de cliente existente

O fluxo de cliente existente deve levar o usuário para autenticação e, depois, para o painel do cliente.

Opções de login previstas:

- e-mail e senha;
- Google;
- Microsoft;
- recuperação de senha.

Rotas futuras previstas:

```txt
/login
/cliente
/cliente/atendimentos
/cliente/atendimentos/novo
```

Depois do login:

- cliente autenticado acessa o painel;
- cliente pode abrir um novo atendimento;
- cliente pode acompanhar atendimentos existentes;
- registros autenticados devem ser tratados como `service_request`.

Não haverá login social com Facebook nesta fase prevista.

## 11. Dados mínimos do primeiro contato

Para PF:

- nome;
- telefone;
- e-mail;
- aceite da política de privacidade.

Para PJ:

- nome;
- telefone;
- e-mail;
- nome da empresa;
- aceite da política de privacidade.

O primeiro contato não deve exigir:

- CPF;
- CNPJ;
- endereço completo;
- senha obrigatória;
- descrição longa obrigatória;
- upload de arquivos;
- contrato;
- dados financeiros.

Esses dados podem ser solicitados depois, caso sejam realmente necessários.

## 12. Dados opcionais

Campos opcionais úteis:

- serviço ou área de interesse;
- mensagem curta;
- melhor horário para retorno;
- canal preferido;
- consentimento de marketing;
- rota de origem;
- página de origem;
- campanha ou parâmetro de origem, quando existir.

Campos opcionais não devem bloquear o envio. Eles ajudam na triagem, mas não devem criar atrito excessivo.

## 13. Regras para baixa fricção

Baixa fricção significa permitir que o visitante peça atendimento com poucos passos, linguagem simples e campos mínimos.

Regras:

- começar pelo contexto quando ele já puder ser detectado;
- perguntar PF/PJ apenas em rotas neutras;
- solicitar poucos dados obrigatórios;
- usar listas curtas para serviço ou área de interesse;
- aceitar mensagem curta;
- não exigir conta antes do primeiro contato;
- não pedir documentos no primeiro contato;
- deixar claro que a SophData retornará com orientação;
- permitir que o atendimento continue por outro canal depois.

O funil deve reduzir dúvida e esforço, sem prometer solução imediata ou automática.

## 14. Regras de transição entre lead e cliente

Um registro começa como lead quando a pessoa ainda não está autenticada e inicia uma solicitação pelo site público.

Um lead pode virar cliente quando:

- a SophData confirma atendimento recorrente;
- existe contratação;
- existe necessidade de painel para acompanhamento;
- existe proposta aceita;
- a SophData decide criar acesso para acompanhamento formal.

Ao converter um lead em cliente:

- os dados de contato devem ser preservados;
- o histórico da solicitação inicial deve continuar consultável;
- o perfil PF/PJ deve ser mantido;
- o usuário pode receber acesso ao painel;
- futuras solicitações autenticadas passam a ser `service_request`.

A conversão não deve apagar o lead original.

## 15. Regras de abertura de chamado

Diferença entre os registros:

- `lead_request`: solicitação inicial criada por visitante não autenticado pelo site público;
- `service_request`: atendimento ou chamado criado por cliente autenticado no painel.

Regras:

- visitante não autenticado sempre cria `lead_request`;
- cliente autenticado sempre cria `service_request`;
- lead convertido pode originar cliente e chamados posteriores;
- o painel administrativo deve permitir visualizar ambos, mas com distinção clara;
- um lead não deve ser tratado como chamado técnico completo antes da triagem.

## 16. Status iniciais do funil

Status de lead:

- `novo`;
- `em análise`;
- `contato iniciado`;
- `convertido em cliente`;
- `descartado`.

Status de atendimento:

- `novo`;
- `em análise`;
- `contato iniciado`;
- `aguardando cliente`;
- `proposta enviada`;
- `convertido`;
- `encerrado`;
- `descartado`.

Os nomes finais podem ser ajustados na modelagem de dados, mas a implementação futura deve preservar a diferença entre lead e atendimento autenticado.

## 17. Mensagens e microcopy

Microcopy para contexto neutro:

```txt
O atendimento é para você ou para uma empresa?
```

Microcopy para PF:

```txt
Conte rapidamente o que está acontecendo. A SophData retorna para orientar o melhor caminho.
```

Microcopy para PJ:

```txt
Conte o que sua empresa precisa. A SophData analisa o contexto e retorna com o próximo passo.
```

Microcopy para cliente existente:

```txt
Já é cliente? Entre para acompanhar ou abrir um atendimento.
```

Microcopy de consentimento:

```txt
Li e aceito a Política de Privacidade e autorizo o contato da SophData sobre esta solicitação.
```

Microcopy de marketing opcional:

```txt
Aceito receber comunicações da SophData sobre novidades, conteúdos e serviços.
```

Microcopy de confirmação:

```txt
Solicitação recebida. A SophData retornará pelo canal informado.
```

## 18. Consentimento e LGPD no funil

Regras obrigatórias:

- exibir aceite obrigatório da Política de Privacidade;
- não deixar o visitante enviar sem aceitar a política;
- separar consentimento de atendimento e consentimento de marketing;
- deixar marketing sempre opcional;
- registrar versão da política aceita;
- registrar data e hora do aceite;
- registrar IP;
- registrar user agent;
- registrar origem do consentimento quando possível.

O aceite principal autoriza o contato relacionado à solicitação. Ele não deve ser usado como autorização automática para marketing.

## 19. Papel do WhatsApp no funil

O WhatsApp deve ser um canal de retorno ou continuidade, não o centro do funil público.

Regras:

- o site deve priorizar "Iniciar atendimento" ou "Solicitar atendimento";
- WhatsApp pode aparecer como canal preferido;
- WhatsApp pode ser usado pela SophData para retorno, se o visitante escolher ou informar telefone compatível;
- não depender exclusivamente de link direto para WhatsApp no fluxo futuro;
- manter rastreabilidade da solicitação antes do contato externo.

Canais preferidos possíveis:

- WhatsApp;
- ligação;
- e-mail.

## 20. Relação com CTAs públicos

Regras para CTAs:

- CTAs em `/para-empresas/*` devem abrir dialog em contexto PJ ou apontar futuramente para `/para-empresas/atendimento/iniciar`;
- CTAs em `/para-voce/*` devem abrir dialog em contexto PF ou apontar futuramente para `/para-voce/atendimento/iniciar`;
- CTAs em rotas neutras devem abrir o fluxo neutro;
- CTAs para cliente existente devem levar à opção "Já sou cliente" ou ao login;
- CTAs não devem misturar linguagem PF e PJ.

Exemplos de rótulos adequados:

- Iniciar atendimento;
- Solicitar atendimento empresarial;
- Iniciar atendimento pessoal;
- Solicitar análise inicial;
- Abrir solicitação;
- Já sou cliente.

## 21. Relação com autenticação

Regras:

- lead não precisa de login;
- cliente precisa de login para painel;
- visitante não autenticado cria `lead_request`;
- cliente autenticado cria `service_request`;
- autenticação futura deve usar Laravel Livewire Starter Kit;
- login social previsto: Google e Microsoft;
- Facebook não faz parte do escopo previsto.

A autenticação deve entrar depois da captação inicial, exceto quando o usuário escolher "Já sou cliente".

## 22. Relação com painel administrativo

O painel administrativo futuro deve permitir:

- visualizar leads;
- filtrar por PF/PJ;
- filtrar por status;
- ver dados de contato;
- ver rota ou origem da solicitação;
- alterar status;
- adicionar notas internas;
- converter lead em cliente;
- visualizar chamados autenticados;
- diferenciar `lead_request` de `service_request`.

O painel administrativo não faz parte desta implementação documental, mas o funil deve preparar os dados para essa operação.

## 23. Casos especiais

Casos previstos:

- visitante em rota neutra não sabe se é PF ou PJ;
- pessoa física pede atendimento para MEI ou pequeno negócio;
- empresa entra pelo perfil Para Você;
- pessoa física entra pelo perfil Para Empresas;
- cliente existente tenta abrir novo atendimento sem login;
- visitante informa telefone, mas prefere retorno por e-mail;
- visitante abandona o dialog antes de concluir;
- lead duplicado com mesmo e-mail ou telefone;
- solicitação urgente fora do horário comercial.

Regras gerais:

- permitir correção de perfil antes do envio;
- não bloquear pequenos negócios por falta de CNPJ no primeiro contato;
- em caso de dúvida entre PF/PJ, priorizar a intenção informada pelo visitante;
- tratar abandono como evento analítico futuro, não como lead completo;
- duplicidade deve ser analisada no painel, não impedir automaticamente o envio.

## 24. O que o funil não deve fazer

O funil não deve:

- criar autenticação obrigatória para visitante novo;
- pedir CPF no primeiro contato;
- pedir CNPJ no primeiro contato;
- pedir endereço completo no primeiro contato;
- exigir senha para lead;
- exigir upload de arquivos;
- prometer solução imediata;
- prometer atendimento garantido;
- misturar PF e PJ no mesmo formulário sem contexto;
- substituir a triagem humana;
- criar orçamento automático;
- fechar contratação automaticamente;
- enviar marketing sem consentimento específico;
- depender apenas de WhatsApp direto.

## 25. Critérios de aceite para implementação futura

A implementação futura do funil será aceita quando:

- o dialog abrir em contexto PF nas rotas `/para-voce/*`;
- o dialog abrir em contexto PJ nas rotas `/para-empresas/*`;
- rotas neutras perguntarem PF/PJ antes do restante do fluxo;
- novo atendimento não exigir login;
- cliente existente for encaminhado para login;
- PF e PJ tiverem campos obrigatórios diferentes;
- nome da empresa for obrigatório apenas no fluxo PJ;
- aceite de privacidade for obrigatório;
- consentimento de marketing for opcional;
- `lead_request` e `service_request` forem tratados separadamente;
- status iniciais forem aplicados;
- painel administrativo conseguir filtrar PF/PJ;
- WhatsApp for canal de retorno, não substituto do registro;
- CTAs públicos permanecerem coerentes com o perfil da página;
- a jornada funcionar sem alterar slugs públicos desnecessariamente.

## 26. Fluxogramas textuais

Fluxo PF:

```txt
/para-voce/*
→ CTA "Iniciar atendimento pessoal"
→ dialog em contexto PF
→ Novo atendimento
→ nome, telefone, e-mail, aceite LGPD
→ serviço de interesse opcional
→ lead_request PF
→ análise SophData
→ retorno ao visitante
```

Fluxo PJ:

```txt
/para-empresas/*
→ CTA "Solicitar atendimento empresarial"
→ dialog em contexto PJ
→ Novo atendimento
→ nome, telefone, e-mail, empresa, aceite LGPD
→ área de interesse opcional
→ lead_request PJ
→ análise SophData
→ retorno ao visitante
```

Fluxo neutro:

```txt
rota neutra
→ CTA "Iniciar atendimento"
→ dialog pergunta "O atendimento é para você ou para uma empresa?"
→ Para mim: segue PF
→ Para minha empresa: segue PJ
```

Fluxo cliente:

```txt
dialog
→ Já sou cliente
→ login por e-mail/senha, Google ou Microsoft
→ painel do cliente
→ abrir ou acompanhar atendimento
→ service_request
```

## 27. Decisões em aberto

Decisões para prompts futuros:

- nomes finais das tabelas e models;
- se `lead_request` e `service_request` serão tabelas separadas ou tipos de uma estrutura comum;
- campos exatos de origem e rastreamento;
- política de deduplicação de leads;
- horário comercial e mensagem para urgências;
- quais áreas de interesse serão configuráveis pelo admin;
- quando um lead convertido deve criar usuário automaticamente;
- se o cliente receberá convite por e-mail para criar senha;
- texto final dos e-mails transacionais;
- regras de SLA ou prioridade.

## 28. Conclusão

O funil PF/PJ da SophData deve organizar a entrada de solicitações públicas com separação clara entre pessoa física e pessoa jurídica, mantendo baixa fricção no primeiro contato e preparando a evolução para autenticação, painel do cliente, painel administrativo e LGPD.

Nesta etapa, a especificação define comportamento esperado, dados mínimos, status, microcopy, consentimentos e limites funcionais. Nenhum código funcional é implementado por este documento.
