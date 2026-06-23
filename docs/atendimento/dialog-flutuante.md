# Especificação funcional — Dialog flutuante de atendimento SophData

## 1. Objetivo do componente

O dialog flutuante de atendimento será a principal entrada de relacionamento da SophData. Ele deve permitir que visitantes iniciem um novo atendimento com poucos dados e que clientes existentes acessem sua conta para abrir ou acompanhar chamados.

O objetivo não é criar um chat em tempo real nesta fase. O componente deve funcionar como uma pequena central de atendimento, capaz de captar a intenção inicial, separar Pessoa Física e Pessoa Jurídica, registrar origem e preparar o futuro mini CRM.

Objetivos principais:

- Captar lead com baixa fricção.
- Separar PF e PJ desde o primeiro contato.
- Registrar intenção de atendimento.
- Permitir contato ativo pela SophData.
- Orientar cliente existente para login.
- Preparar o futuro mini CRM.

## 2. Problema que o dialog resolve

O modelo atual depende muito do fluxo direto para WhatsApp. Esse caminho é rápido, mas gera conversas soltas, dificulta medir a origem do lead, mistura pessoa física e pessoa jurídica e reduz a visibilidade do status de cada atendimento.

Problemas do modelo antigo:

- Conversas soltas.
- Dificuldade de medir origem do lead.
- Pouca organização dos atendimentos.
- Mistura entre pessoa física e pessoa jurídica.
- Ausência de histórico interno.
- Pouca visibilidade de status.

O novo dialog resolve isso porque captura dados mínimos, registra a origem da rota, separa PF e PJ, permite priorização futura, abre caminho para painel administrativo e permite contato ativo pela SophData.

## 3. Princípios de UX

O primeiro contato não deve parecer um cadastro burocrático.

Princípios:

- Baixa fricção para novo lead.
- Poucos campos no primeiro contato.
- Clareza entre "Novo atendimento" e "Já sou cliente".
- Contexto pré-marcado pela rota.
- Possibilidade de alterar PF/PJ.
- Visual leve e confiável.
- Não parecer pop-up invasivo.
- Não bloquear navegação do site.
- Funcionar bem em mobile.
- Acessível por teclado.
- Mensagens simples e diretas.

## 4. Contextos de atendimento

### Pessoa Física

Ativado por rotas:

```txt
/para-voce/*
```

Uso: atendimento técnico pessoal, computador, notebook, internet, Wi-Fi, impressora, backup, orientação técnica e suporte doméstico.

### Pessoa Jurídica

Ativado por rotas:

```txt
/para-empresas/*
```

Uso: atendimento empresarial, software, sites, sistemas, automações, infraestrutura, servidores, backup, rede, suporte e planos.

### Neutro

Ativado por rotas como:

```txt
/
/politica-de-privacidade
```

Uso: perguntar se o atendimento é para pessoa física ou empresa.

## 5. Comportamento fechado

O botão fechado deve ficar no canto inferior direito das páginas públicas. Ele deve ser discreto, visível e não cobrir conteúdo essencial.

Texto recomendado:

```txt
Iniciar atendimento
```

Alternativas aceitáveis:

```txt
Atendimento
Solicitar atendimento
```

Não usar como principal:

```txt
WhatsApp
Chamar no WhatsApp
```

Regras:

- Deve abrir o dialog.
- Não deve redirecionar diretamente.
- Não deve abrir WhatsApp diretamente.
- Deve funcionar em desktop e mobile.
- Deve ter `aria-label` claro.

## 6. Comportamento aberto

Ao abrir, o dialog deve mostrar:

- Título.
- Breve descrição.
- Botão ou card de Novo atendimento.
- Botão ou card de Já sou cliente.
- Opção de fechar.

Título PJ:

```txt
Atendimento para empresas
```

Descrição PJ:

```txt
Conte rapidamente o que sua empresa precisa. A SophData entra em contato para orientar o próximo passo.
```

Título PF:

```txt
Atendimento Para Você
```

Descrição PF:

```txt
Conte o que está acontecendo. A SophData retorna para orientar o melhor caminho.
```

Título neutro:

```txt
Como podemos ajudar?
```

Descrição neutra:

```txt
Escolha se o atendimento é para você ou para uma empresa.
```

## 7. Estados internos do dialog

- `closed`: botão fixo visível, painel fechado.
- `opened`: painel aberto com opções iniciais.
- `context_choice`: usado quando a rota é neutra.
- `new_lead_intro`: introdução antes do formulário rápido.
- `new_lead_personal_form`: formulário rápido para pessoa física.
- `new_lead_business_form`: formulário rápido para pessoa jurídica.
- `existing_customer_options`: opções para cliente existente acessar conta.
- `login_options`: opções de login por e-mail, Google ou Microsoft.
- `success`: confirmação após envio.
- `validation_error`: exibição de erros de validação.
- `loading`: envio em andamento.

## 8. Detecção de contexto por rota

Regra conceitual:

```txt
/para-voce/*       → personal
/para-empresas/*   → business
demais rotas       → neutral
```

Pseudocódigo:

```txt
if route starts with /para-voce:
    context = personal

else if route starts with /para-empresas:
    context = business

else:
    context = neutral
```

A implementação futura pode usar `request()->is('para-voce*')` e `request()->is('para-empresas*')`, mas isso não deve ser implementado neste prompt.

## 9. Fluxo de novo atendimento

1. Visitante clica no botão fixo.
2. Dialog abre.
3. Sistema detecta contexto pela rota.
4. Visitante escolhe "Novo atendimento".
5. Se contexto for neutro, escolhe PF ou PJ.
6. Formulário curto aparece.
7. Visitante preenche dados mínimos.
8. Visitante aceita Política de Privacidade.
9. Visitante pode aceitar ou não comunicações futuras.
10. Solicitação é enviada.
11. Sistema exibe confirmação.
12. SophData entra em contato posteriormente.

Esse fluxo não exige senha no primeiro momento. Novo lead não deve ser obrigado a criar conta antes de enviar nome, telefone e e-mail.

## 10. Fluxo “Já sou cliente”

1. Visitante clica no botão fixo.
2. Dialog abre.
3. Visitante escolhe "Já sou cliente".
4. Dialog mostra opções de acesso.
5. Cliente pode entrar com e-mail/senha, Google ou Microsoft.
6. Após login, cliente vai para abertura de chamado ou painel do cliente.

Opções exibidas:

- Entrar com e-mail.
- Entrar com Google.
- Entrar com Microsoft.
- Recuperar senha.

A autenticação será implementada depois com Laravel Livewire Starter Kit.

## 11. Campos mínimos por perfil

### Pessoa Física

Campos obrigatórios:

- Nome.
- Telefone.
- E-mail.
- Aceite da Política de Privacidade.

Campos opcionais:

- Serviço de interesse.
- Mensagem curta.
- Melhor horário para retorno.
- Canal preferido de retorno.
- Aceite de comunicações futuras.

### Pessoa Jurídica

Campos obrigatórios:

- Nome.
- Telefone.
- E-mail.
- Nome da empresa.
- Aceite da Política de Privacidade.

Campos opcionais:

- Área de interesse.
- Mensagem curta.
- Melhor horário para retorno.
- Canal preferido de retorno.
- Aceite de comunicações futuras.

Regras:

- Empresa é obrigatória apenas para PJ.
- PF não deve ver empresa como obrigatório.
- E-mail deve ser válido.
- Telefone deve ser obrigatório, mas a validação não deve ser excessivamente rígida no MVP.

## 12. Textos e mensagens sugeridas

Cards iniciais:

```txt
Novo atendimento
Quero que a SophData entre em contato comigo.

Já sou cliente
Entrar para abrir ou acompanhar um chamado.
```

Título formulário PF:

```txt
Atendimento pessoal
```

Descrição PF:

```txt
Deixe seus dados e a SophData retorna para entender o problema e orientar o melhor caminho.
```

Título formulário PJ:

```txt
Atendimento empresarial
```

Descrição PJ:

```txt
Deixe seus dados e a SophData retorna para entender a necessidade da sua empresa.
```

Texto LGPD curto:

```txt
Usaremos seus dados para responder sua solicitação de atendimento e entrar em contato pelos canais informados.
```

Checkbox obrigatório:

```txt
Li e aceito a Política de Privacidade.
```

Checkbox opcional:

```txt
Aceito receber comunicações da SophData sobre serviços, conteúdos e novidades.
```

Botão de envio:

```txt
Enviar solicitação
```

Mensagem de sucesso:

```txt
Solicitação recebida. A SophData entrará em contato para orientar o próximo passo.
```

## 13. Regras para Pessoa Física

Para Pessoa Física:

- Linguagem simples.
- Não usar termos corporativos demais.
- Não exigir empresa.
- Foco em problema do dia a dia.
- Permitir serviço de interesse pessoal.

Serviços pessoais possíveis:

- Computador ou notebook lento.
- Formatação e instalação.
- Internet, Wi-Fi e roteador.
- Impressora e dispositivos.
- Backup e arquivos pessoais.
- Orientação técnica.
- Outro assunto.

## 14. Regras para Pessoa Jurídica

Para Pessoa Jurídica:

- Exigir nome da empresa.
- Linguagem profissional.
- Foco em organização, suporte, infraestrutura, software e continuidade.
- Permitir área de interesse empresarial.

Áreas empresariais possíveis:

- Sites, sistemas e automações.
- Suporte, rede e infraestrutura.
- Servidores, backup e acessos.
- Planos empresariais.
- Diagnóstico inicial.
- Outro assunto.

## 15. Regras para rotas neutras

Em rota neutra, o dialog deve perguntar:

```txt
O atendimento é para você ou para uma empresa?
```

Opções:

```txt
Para mim
Para minha empresa
```

Depois da escolha:

- Para mim → formulário PF.
- Para minha empresa → formulário PJ.

## 16. Comportamento desktop

No desktop:

- Botão no canto inferior direito.
- Painel aberto acima do botão ou alinhado ao canto direito.
- Largura aproximada entre 360px e 420px.
- Altura máxima com scroll interno se necessário.
- Não deve ocupar a tela inteira.
- Deve manter o conteúdo do site visível.
- Deve ter sombra, borda suave e cabeçalho claro.

Não definir classes Tailwind específicas nesta etapa.

## 17. Comportamento mobile

No mobile:

- Botão fixo no canto inferior direito.
- Ao abrir, painel pode virar bottom sheet.
- Ocupar largura quase total.
- Altura suficiente para formulário.
- Permitir rolagem interna.
- Botão de fechar visível.
- Campos grandes e fáceis de tocar.
- Não cobrir permanentemente o teclado.

Em telas muito pequenas, o dialog pode ocupar quase a tela toda.

## 18. Acessibilidade

Requisitos:

- Botão com `aria-label`.
- Dialog com `role="dialog"`.
- Dialog com `aria-modal` quando aplicável.
- Título associado ao dialog.
- Botão fechar acessível.
- Fechar com ESC.
- Foco deve ir para o dialog ao abrir.
- Foco deve retornar ao botão ao fechar.
- Mensagens de erro devem ser claras.
- Campos devem ter label.
- Não depender apenas de cor para erro.
- Navegação por teclado deve funcionar.

## 19. Validação e erros

Mensagens de erro futuras:

- Informe seu nome.
- Informe um telefone para contato.
- Informe um e-mail válido.
- Informe o nome da empresa.
- Você precisa aceitar a Política de Privacidade para enviar a solicitação.

Regras:

- Erros devem aparecer próximos aos campos.
- Não apagar dados preenchidos após erro.
- Não usar mensagens técnicas.

## 20. Confirmação de envio

Após envio de lead:

```txt
Solicitação recebida
A SophData entrará em contato para orientar o próximo passo.
```

Opções pós-envio:

- Fechar.
- Voltar ao site.
- Criar conta para acompanhar, futuramente.

## 21. Papel do WhatsApp

O WhatsApp não será o destino principal do botão fixo nem dos CTAs principais. Ele poderá ser usado como canal preferido de retorno, alternativa secundária ou canal usado pela SophData depois que o lead for registrado.

Campo futuro:

```txt
Canal preferido de retorno:
- WhatsApp
- E-mail
- Telefone
```

O dialog principal não deve gerar link direto de WhatsApp como ação principal.

## 22. Integração futura com autenticação

O fluxo "Já sou cliente" será integrado ao Laravel Livewire Starter Kit. O dialog poderá direcionar para a tela de login ou embutir opções de acesso, conforme viabilidade técnica futura.

Provedores futuros:

- E-mail e senha.
- Google.
- Microsoft/Outlook.

Facebook não será implementado nesta fase.

## 23. Integração futura com leads

O formulário rápido criará registros futuros em:

```txt
lead_requests
```

Campos previstos:

- `customer_type`
- `name`
- `phone`
- `email`
- `company_name`
- `source_route`
- `service_area`
- `message`
- `status`
- `privacy_policy_version`
- `contact_permission`
- `marketing_opt_in`
- `ip_address`
- `user_agent`

Não criar tabela nesta etapa.

## 24. Integração futura com chamados

Cliente autenticado usará registros futuros em:

```txt
service_requests
```

Campos previstos:

- `user_id`
- `company_id`
- `customer_type`
- `service_area`
- `subject`
- `message`
- `urgency`
- `preferred_contact_channel`
- `status`
- `source_route`

Não criar tabela nesta etapa.

## 25. Eventos e rastreamento futuro

Eventos futuros possíveis:

- `attendance_widget_opened`
- `attendance_widget_closed`
- `lead_form_started`
- `lead_form_submitted`
- `lead_form_failed`
- `existing_customer_clicked`
- `login_started_from_widget`

Esses eventos servirão para marketing e análise de conversão. Analytics não deve ser implementado agora.

## 26. O que o dialog não deve fazer

- Não deve ser chat em tempo real nesta fase.
- Não deve exigir senha para novo lead.
- Não deve pedir dados excessivos.
- Não deve abrir WhatsApp como ação principal.
- Não deve bloquear o site de forma invasiva.
- Não deve misturar PF e PJ.
- Não deve gerar atendimento sem aceite de privacidade.
- Não deve expor dados sensíveis.
- Não deve criar usuário automaticamente sem clareza.

## 27. Critérios de aceite para implementação futura

- Botão fechado aparece nas páginas públicas definidas.
- Botão fechado abre o dialog sem redirecionar.
- Contexto é detectado por rota.
- Usuário pode alterar PF/PJ quando necessário.
- Novo atendimento PF exibe apenas campos adequados para pessoa física.
- Novo atendimento PJ exige nome da empresa.
- Aceite da Política de Privacidade é obrigatório.
- WhatsApp não é ação principal do dialog.
- Fluxo "Já sou cliente" direciona para autenticação.
- Dialog funciona por teclado.
- Dialog fecha com ESC.
- Foco retorna ao botão ao fechar.
- Mobile usa comportamento adequado, como bottom sheet.
- Erros aparecem próximos aos campos.
- Envio bem-sucedido exibe confirmação clara.

## 28. Wireframe textual

Estado fechado:

```txt
[ Iniciar atendimento ]
```

Estado aberto inicial:

```txt
┌────────────────────────────────┐
│ Atendimento SophData        X  │
│ Como podemos ajudar?           │
│                                │
│ [ Novo atendimento ]           │
│ Quero que a SophData retorne.  │
│                                │
│ [ Já sou cliente ]             │
│ Entrar e abrir chamado.        │
└────────────────────────────────┘
```

Formulário PF:

```txt
┌────────────────────────────────┐
│ Atendimento pessoal         X  │
│ Nome                           │
│ Telefone                       │
│ E-mail                         │
│ Serviço de interesse opcional  │
│ [ ] Aceito a Política          │
│ [ ] Aceito comunicações        │
│ [ Enviar solicitação ]         │
└────────────────────────────────┘
```

Formulário PJ:

```txt
┌────────────────────────────────┐
│ Atendimento empresarial     X  │
│ Nome                           │
│ Telefone                       │
│ E-mail                         │
│ Nome da empresa                │
│ Área de interesse opcional     │
│ [ ] Aceito a Política          │
│ [ ] Aceito comunicações        │
│ [ Enviar solicitação ]         │
└────────────────────────────────┘
```

## 29. Decisões em aberto

- O dialog ficará em todas as páginas públicas ou apenas em páginas comerciais?
- O login será embutido no dialog ou direcionará para uma tela de acesso?
- Lead poderá criar conta logo após enviar solicitação?
- Haverá notificação por e-mail para admin quando um lead chegar?
- Haverá integração com WhatsApp API no futuro?
- Haverá campos UTM no primeiro MVP?
- Haverá upload de arquivo em chamados autenticados?

## 30. Conclusão

O dialog flutuante deve ser a nova porta de entrada do atendimento SophData. Ele substitui a dependência do WhatsApp direto por um fluxo organizado, separa PF e PJ, prepara captação de leads, respeita LGPD e cria base funcional para autenticação, painel do cliente, chamados e mini CRM nas próximas etapas.
