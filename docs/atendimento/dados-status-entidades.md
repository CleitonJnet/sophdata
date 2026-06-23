# Especificação técnica — Dados, status e entidades do mini CRM SophData

## 1. Objetivo do documento

Este documento define as entidades, campos, status e relacionamentos necessários para transformar o site da SophData em uma plataforma inicial de captação de leads, abertura de atendimentos e acompanhamento administrativo.

O objetivo é evitar a criação de banco de dados sem planejamento, deixando claro o papel de cada tabela antes da implementação de migrations, models, enums, formulários, dashboards e testes.

Este documento é apenas uma especificação técnica e funcional. Nenhuma tabela, migration, model ou enum PHP é criada nesta etapa.

## 2. Visão geral do modelo de dados

O sistema terá dois níveis principais de registro:

1. Lead rápido, criado por visitante ainda não autenticado.
2. Atendimento/chamado, criado por cliente autenticado.

Entidades planejadas:

- `users`: usuários autenticados.
- `companies`: empresas vinculadas a usuários.
- `lead_requests`: solicitações rápidas de visitantes não autenticados.
- `service_requests`: atendimentos/chamados de clientes autenticados.
- `privacy_consents`: registros de consentimento LGPD.
- `social_accounts`: vínculos com login social.
- `admin_notes`: observações internas da equipe SophData.
- `status_histories`: histórico de mudanças de status.

O modelo deve separar claramente captação pública, autenticação, acompanhamento de cliente e gestão administrativa.

## 3. Diferença entre lead e atendimento

Lead é o primeiro contato feito por visitante ainda não autenticado. Ele serve para captar nome, telefone, e-mail e, no caso de empresa, nome da empresa. O objetivo é permitir contato ativo da SophData.

Tabela futura:

```txt
lead_requests
```

Atendimento é uma solicitação criada por usuário autenticado, com possibilidade de acompanhamento de status pelo cliente e gestão pela área administrativa.

Tabela futura:

```txt
service_requests
```

Regra central:

```txt
Visitante anônimo cria lead_request.
Cliente autenticado cria service_request.
```

Um lead pode ser convertido em cliente depois, mas não deve ser tratado como chamado autenticado antes da conversão.

## 4. Entidade users

A tabela `users` representa usuários autenticados. Ela pode já existir quando o Laravel Livewire Starter Kit for instalado, mas deve ser planejada com os campos abaixo.

Campos planejados:

```txt
id
name
email
email_verified_at
password
phone
customer_type
role
remember_token
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| name | string | sim | nome do usuário |
| email | string unique | sim | usado para login |
| email_verified_at | timestamp nullable | não | verificação de e-mail |
| password | string nullable | não | pode ser nulo se usuário nasceu por login social, conforme decisão futura |
| phone | string nullable | não no registro inicial | telefone pode ser completado depois |
| customer_type | string/enum nullable | não | `personal` ou `business` |
| role | string/enum | sim | `customer` ou `admin` |
| remember_token | string nullable | não | padrão Laravel |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- `role` padrão deve ser `customer`.
- Admin não deve ser criado por formulário público.
- Telefone não deve ser obrigatório no registro inicial com Google/Microsoft.
- `customer_type` pode ser completado no fluxo de atendimento.
- Usuário autenticado pode criar `service_request`.
- Usuário com role `admin` pode acessar recursos administrativos futuros.

## 5. Entidade companies

A tabela `companies` representa a empresa associada a um usuário quando o atendimento for Pessoa Jurídica.

Campos planejados:

```txt
id
user_id
name
phone
email
city
notes
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| user_id | foreignId nullable | não | pode vincular ao usuário responsável |
| name | string | sim | nome da empresa |
| phone | string nullable | não | telefone da empresa, se diferente |
| email | string nullable | não | e-mail da empresa, se diferente |
| city | string nullable | não | cidade, opcional |
| notes | text nullable | não | observações internas ou complementares |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- `company` é obrigatória para atendimento PJ autenticado quando o usuário já estiver no fluxo completo.
- No lead rápido PJ, `company_name` pode ficar diretamente em `lead_requests`, sem criar `company` ainda.
- A `company` pode ser criada depois, quando lead virar cliente.
- Uma empresa pode ter vários atendimentos.

## 6. Entidade lead_requests

A tabela `lead_requests` armazena solicitações rápidas enviadas pelo dialog flutuante por visitantes ainda não autenticados.

Campos planejados:

```txt
id
customer_type
name
phone
email
company_name
service_area
message
preferred_contact_channel
best_contact_time
source_route
source_context
utm_source
utm_medium
utm_campaign
status
privacy_policy_version
contact_permission
marketing_opt_in
ip_address
user_agent
converted_user_id
converted_at
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| customer_type | enum/string | sim | `personal` ou `business` |
| name | string | sim | nome do lead |
| phone | string | sim | telefone informado |
| email | string | sim | e-mail informado |
| company_name | string nullable | obrigatório se PJ | nome da empresa |
| service_area | string nullable | não | área de interesse |
| message | text nullable | não | mensagem curta |
| preferred_contact_channel | string nullable | não | WhatsApp, e-mail ou telefone |
| best_contact_time | string nullable | não | melhor horário |
| source_route | string nullable | não | rota onde iniciou |
| source_context | string nullable | não | `personal`, `business`, `neutral` |
| utm_source | string nullable | não | marketing futuro |
| utm_medium | string nullable | não | marketing futuro |
| utm_campaign | string nullable | não | marketing futuro |
| status | enum/string | sim | padrão `new` |
| privacy_policy_version | string | sim | versão aceita |
| contact_permission | boolean | sim | permissão para contato sobre a solicitação |
| marketing_opt_in | boolean | sim | padrão false |
| ip_address | string nullable | não | auditoria LGPD |
| user_agent | text nullable | não | auditoria LGPD |
| converted_user_id | foreignId nullable | não | usuário criado/vinculado depois |
| converted_at | timestamp nullable | não | data de conversão |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras obrigatórias:

- `customer_type` é obrigatório.
- `name`, `phone` e `email` são obrigatórios.
- `company_name` é obrigatório apenas para `business`.
- `contact_permission` deve ser true para envio.
- `marketing_opt_in` nunca deve ser obrigatório.
- Status inicial deve ser `new`.
- Lead não exige senha.

## 7. Entidade service_requests

A tabela `service_requests` armazena atendimentos ou chamados criados por clientes autenticados.

Campos planejados:

```txt
id
user_id
company_id
customer_type
service_area
subject
message
urgency
preferred_contact_channel
source_route
status
assigned_to
created_at
updated_at
closed_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| user_id | foreignId | sim | cliente que abriu |
| company_id | foreignId nullable | obrigatório se PJ quando aplicável | empresa relacionada |
| customer_type | enum/string | sim | `personal` ou `business` |
| service_area | string | sim | área de atendimento |
| subject | string | sim | resumo do pedido |
| message | text | sim | descrição do atendimento |
| urgency | string/enum nullable | não | baixa, normal, alta |
| preferred_contact_channel | string nullable | não | WhatsApp, e-mail ou telefone |
| source_route | string nullable | não | rota de origem |
| status | enum/string | sim | padrão `new` |
| assigned_to | foreignId nullable | não | admin responsável, futuramente |
| closed_at | timestamp nullable | não | data de encerramento |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- `service_request` sempre pertence a um `user`.
- Cliente só pode ver seus próprios `service_requests`.
- Admin pode ver todos.
- Status inicial deve ser `new`.
- PJ deve ter empresa vinculada ou `company_name` tratado antes de criar chamado completo.

## 8. Entidade privacy_consents

A tabela `privacy_consents` registra consentimentos e permissões relacionados à LGPD.

Campos planejados:

```txt
id
user_id
lead_request_id
service_request_id
privacy_policy_version
accepted_at
contact_permission
marketing_opt_in
ip_address
user_agent
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| user_id | foreignId nullable | não | usuário autenticado |
| lead_request_id | foreignId nullable | não | lead relacionado |
| service_request_id | foreignId nullable | não | atendimento relacionado |
| privacy_policy_version | string | sim | versão aceita |
| accepted_at | timestamp | sim | data/hora do aceite |
| contact_permission | boolean | sim | permissão para contato sobre solicitação |
| marketing_opt_in | boolean | sim | comunicação futura |
| ip_address | string nullable | não | auditoria |
| user_agent | text nullable | não | auditoria |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- Deve existir pelo menos um vínculo: `user_id`, `lead_request_id` ou `service_request_id`.
- `marketing_opt_in` deve ser opcional.
- `contact_permission` deve ser obrigatório para enviar solicitação.
- A versão da política deve ser registrada.
- Consentimentos podem ser usados depois para auditoria, exclusão ou anonimização.

## 9. Entidade social_accounts

A tabela `social_accounts` armazena vínculos de usuários com provedores de login social.

Provedores desta fase:

```txt
google
microsoft
```

Facebook não entra nesta fase.

Campos planejados:

```txt
id
user_id
provider
provider_id
provider_email
provider_name
avatar_url
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| user_id | foreignId | sim | usuário vinculado |
| provider | string/enum | sim | google ou microsoft |
| provider_id | string | sim | ID vindo do provedor |
| provider_email | string nullable | não | e-mail do provedor |
| provider_name | string nullable | não | nome retornado |
| avatar_url | string nullable | não | avatar, se usado |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- `provider` + `provider_id` deve ser único.
- Se o e-mail já existir em `users`, vincular ao usuário existente.
- Não duplicar usuário com mesmo e-mail.
- Telefone não deve ser esperado do provedor social.

## 10. Entidade admin_notes

A tabela `admin_notes` permite registrar observações internas sobre leads e atendimentos.

Campos planejados:

```txt
id
admin_user_id
lead_request_id
service_request_id
note
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| admin_user_id | foreignId | sim | admin que escreveu |
| lead_request_id | foreignId nullable | não | nota em lead |
| service_request_id | foreignId nullable | não | nota em atendimento |
| note | text | sim | conteúdo interno |
| created_at | timestamp | sim | padrão Laravel |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- Nota interna não deve aparecer para cliente.
- Deve estar vinculada a lead ou atendimento.
- Somente admin pode criar nota interna.
- Nota interna não deve ser usada como comunicação pública.

## 11. Entidade status_histories

A tabela `status_histories` registra mudanças de status de leads e atendimentos.

Campos planejados:

```txt
id
changed_by
lead_request_id
service_request_id
from_status
to_status
comment
created_at
updated_at
```

| Campo | Tipo sugerido | Obrigatório | Observação |
| --- | --- | --- | --- |
| id | bigint unsigned | sim | chave primária |
| changed_by | foreignId nullable | não | admin ou sistema |
| lead_request_id | foreignId nullable | não | lead relacionado |
| service_request_id | foreignId nullable | não | atendimento relacionado |
| from_status | string nullable | não | status anterior |
| to_status | string | sim | novo status |
| comment | text nullable | não | comentário opcional |
| created_at | timestamp | sim | data da mudança |
| updated_at | timestamp | sim | padrão Laravel |

Regras:

- Toda mudança manual de status deve registrar histórico.
- Deve estar vinculada a lead ou atendimento.
- Status inicial pode gerar histórico automático ou não, conforme decisão futura.
- `changed_by` pode ser nulo quando a mudança for automática pelo sistema.

## 12. Enums planejados

Os labels públicos devem ficar em português, mas os valores internos devem ser estáveis em inglês ou padrão técnico.

Exemplo:

```txt
new -> Novo
in_analysis -> Em análise
contact_started -> Contato iniciado
```

`CustomerType`:

```txt
personal
business
```

`UserRole`:

```txt
customer
admin
```

`LeadStatus`:

```txt
new
in_analysis
contact_started
converted
discarded
```

`ServiceRequestStatus`:

```txt
new
in_analysis
contact_started
waiting_customer
proposal_sent
converted
closed
discarded
```

`Urgency`:

```txt
low
normal
high
```

`ContactChannel`:

```txt
whatsapp
email
phone
```

`SocialProvider`:

```txt
google
microsoft
```

## 13. Status de leads

Status de `lead_requests`:

| Valor interno | Label público/admin | Descrição |
| --- | --- | --- |
| new | Novo | Lead recebido e ainda não analisado |
| in_analysis | Em análise | SophData está avaliando o lead |
| contact_started | Contato iniciado | SophData já iniciou ou tentou contato |
| converted | Convertido em cliente | Lead virou cliente ou oportunidade ativa |
| discarded | Descartado | Lead encerrado sem continuidade |

Regras:

- Status inicial deve ser `new`.
- Apenas admin deve alterar status.
- Mudança de status deve poder gerar histórico.
- Lead convertido deve manter o registro original.

## 14. Status de atendimentos

Status de `service_requests`:

| Valor interno | Label público/admin | Descrição |
| --- | --- | --- |
| new | Novo | Atendimento recebido |
| in_analysis | Em análise | SophData está avaliando |
| contact_started | Contato iniciado | SophData iniciou contato |
| waiting_customer | Aguardando cliente | Depende de resposta ou ação do cliente |
| proposal_sent | Proposta enviada | Proposta ou orientação formal enviada |
| converted | Convertido | Atendimento virou serviço/projeto |
| closed | Encerrado | Atendimento finalizado |
| discarded | Descartado | Atendimento sem continuidade |

Regras:

- Status inicial deve ser `new`.
- Cliente pode visualizar status.
- Admin pode alterar status.
- Notas internas não aparecem para cliente.
- Mudança de status deve registrar histórico quando feita manualmente.

## 15. Relacionamentos entre entidades

Relacionamentos planejados:

```txt
User hasMany ServiceRequest
User hasMany Company
User hasMany SocialAccount
User hasMany PrivacyConsent
User hasMany AdminNote, quando admin

Company belongsTo User
Company hasMany ServiceRequest

LeadRequest hasMany PrivacyConsent
LeadRequest hasMany AdminNote
LeadRequest hasMany StatusHistory
LeadRequest may belongTo converted User

ServiceRequest belongsTo User
ServiceRequest belongsTo Company nullable
ServiceRequest hasMany PrivacyConsent
ServiceRequest hasMany AdminNote
ServiceRequest hasMany StatusHistory

SocialAccount belongsTo User

AdminNote belongsTo User as admin
AdminNote belongsTo LeadRequest nullable
AdminNote belongsTo ServiceRequest nullable

StatusHistory belongsTo User nullable as changedBy
StatusHistory belongsTo LeadRequest nullable
StatusHistory belongsTo ServiceRequest nullable
```

## 16. Regras PF/PJ no modelo de dados

Regras:

- `customer_type personal` não exige `company_name`.
- `customer_type business` exige `company_name` no lead.
- `customer_type business` deve ter `company` em atendimento autenticado, quando possível.
- `user.customer_type` pode ser nullable até o usuário completar perfil.
- `lead_request` pode existir sem `user`.
- `service_request` exige `user`.
- Perfil PF não deve exigir empresa, CNPJ ou cargo.
- Perfil PJ pode começar com `company_name` e só criar `company` depois.

## 17. Regras LGPD no modelo de dados

Regras:

- Registrar versão da política aceita.
- Registrar data/hora do aceite.
- Registrar permissão de contato.
- Registrar `marketing_opt_in` separadamente.
- Não tornar marketing obrigatório.
- Permitir futuramente localizar dados por e-mail.
- Permitir futuramente exclusão ou anonimização.
- Registrar IP e user agent quando aplicável.

A permissão para contato sobre a solicitação é necessária para que a SophData responda o atendimento. A permissão de marketing é opcional e não deve bloquear o envio.

O modelo deve permitir rastrear o consentimento relacionado a lead, usuário ou atendimento, sem misturar autorização operacional com autorização promocional.

## 18. Campos de auditoria e origem

Campos de origem e auditoria:

```txt
source_route
source_context
utm_source
utm_medium
utm_campaign
ip_address
user_agent
```

Uso:

- `source_route`: saber de qual página o lead veio.
- `source_context`: `personal`, `business` ou `neutral`.
- `utm_source`: campanha ou origem futura.
- `utm_medium`: meio da campanha futura.
- `utm_campaign`: nome da campanha futura.
- `ip_address`: auditoria e LGPD.
- `user_agent`: auditoria e LGPD.

Esses campos ajudam a entender a origem da solicitação sem depender apenas de relatos manuais.

## 19. Campos UTM e marketing futuro

UTM é opcional no MVP, mas útil para campanhas futuras.

Campos previstos:

```txt
utm_source
utm_medium
utm_campaign
```

Esses campos devem ser salvos quando existirem na URL ou no contexto de entrada. Eles não devem ser obrigatórios.

Não incluir analytics neste prompt.

Não implementar rastreamento agora.

## 20. Conversão de lead em cliente

Lead pode ser convertido em cliente quando houver continuidade.

Cenários:

- Admin cria usuário a partir do lead.
- Lead cria conta depois do envio.
- Lead usa e-mail já cadastrado e é vinculado ao usuário existente.

Campos úteis:

```txt
converted_user_id
converted_at
```

Regras:

- Conversão não deve apagar o lead original.
- Dados de origem e consentimento devem continuar consultáveis.
- Lead convertido pode originar `user`, `company` e futuros `service_requests`.
- Se o e-mail já existir, a vinculação deve evitar duplicidade de usuário.

## 21. Regras de validação futuras

Lead PF:

- `name` obrigatório.
- `phone` obrigatório.
- `email` obrigatório e válido.
- Privacy consent obrigatório.
- `company_name` não obrigatório.

Lead PJ:

- `name` obrigatório.
- `phone` obrigatório.
- `email` obrigatório e válido.
- `company_name` obrigatório.
- Privacy consent obrigatório.

Atendimento autenticado:

- `user_id` obrigatório.
- `customer_type` obrigatório.
- `service_area` obrigatório.
- `subject` obrigatório.
- `message` obrigatório.
- `status` obrigatório.

Telefone:

- Deve ser obrigatório no lead, mas a validação não deve ser rígida demais no MVP.
- Deve aceitar formatos comuns com DDD, espaços, parênteses ou hífen.

## 22. Regras de acesso e segurança

Regras:

- Visitante pode criar lead.
- Visitante não pode listar leads.
- Cliente pode criar `service_request`.
- Cliente pode ver apenas seus próprios `service_requests`.
- Admin pode ver leads e atendimentos.
- Admin pode alterar status.
- Admin pode criar notas internas.
- Cliente não pode ver notas internas.
- Cliente não pode acessar admin.
- Admin não deve ser criado por formulário público.
- Dados sensíveis devem ser protegidos por autorização no backend.

## 23. Diagrama textual das relações

```txt
User
 ├── hasMany Company
 ├── hasMany ServiceRequest
 ├── hasMany SocialAccount
 └── hasMany PrivacyConsent

LeadRequest
 ├── hasMany PrivacyConsent
 ├── hasMany AdminNote
 ├── hasMany StatusHistory
 └── may convertTo User

ServiceRequest
 ├── belongsTo User
 ├── belongsTo Company nullable
 ├── hasMany PrivacyConsent
 ├── hasMany AdminNote
 └── hasMany StatusHistory
```

Diagrama complementar:

```txt
Company
 ├── belongsTo User
 └── hasMany ServiceRequest

SocialAccount
 └── belongsTo User

AdminNote
 ├── belongsTo User as admin
 ├── belongsTo LeadRequest nullable
 └── belongsTo ServiceRequest nullable

StatusHistory
 ├── belongsTo User nullable as changedBy
 ├── belongsTo LeadRequest nullable
 └── belongsTo ServiceRequest nullable
```

## 24. Ordem recomendada de criação das migrations

Ordem futura recomendada:

1. `users`, se ainda não existir ou ajuste da tabela `users`.
2. `companies`.
3. `lead_requests`.
4. `service_requests`.
5. `privacy_consents`.
6. `social_accounts`.
7. `admin_notes`.
8. `status_histories`.

A ordem pode mudar conforme tabelas já existentes no projeto, especialmente se o Starter Kit criar ou alterar `users` antes das demais migrations.

## 25. O que não entra no MVP

Não entra no MVP:

- pagamento online;
- contratos digitais;
- emissão de nota fiscal;
- chat em tempo real;
- upload de arquivos;
- integração WhatsApp API;
- SLA avançado;
- múltiplos atendentes;
- permissões complexas;
- funil comercial completo;
- CRM externo;
- automações de e-mail marketing.

Esses itens podem ser reavaliados depois que o fluxo básico de lead, cliente, atendimento e admin estiver estável.

## 26. Critérios de aceite para implementação futura

A implementação futura será aceita quando:

- Lead PF salvar nome, telefone, e-mail e consentimento.
- Lead PJ exigir nome da empresa.
- Marketing for opcional.
- Lead não exigir senha.
- Cliente autenticado criar atendimento.
- Atendimento pertencer a um usuário.
- Admin visualizar leads.
- Admin visualizar atendimentos.
- Cliente não acessar admin.
- Cliente não ver dados de outro cliente.
- Consentimento ficar registrado.
- Status inicial ser `new`.
- Origem da rota ser registrada.
- Mudanças de status puderem gerar histórico.
- Notas internas ficarem invisíveis ao cliente.
- Login social aceitar Google e Microsoft.
- Facebook não ser incluído nesta fase.

## 27. Decisões em aberto

Decisões para prompts futuros:

- `password` pode ser nullable para usuários criados por login social?
- Lead com e-mail já cadastrado deve ser vinculado automaticamente?
- Admin poderá converter lead em `user` manualmente?
- Haverá notificação por e-mail ao admin?
- Haverá notificação ao cliente?
- `status_histories` será polimórfico ou terá colunas nullable?
- `privacy_consents` será polimórfico ou terá colunas nullable?
- O status inicial deve gerar histórico automaticamente?
- O campo `company_id` será obrigatório para todo atendimento PJ autenticado ou haverá exceção temporária?
- Quais labels finais serão exibidos no painel do cliente e no painel administrativo?

## 28. Conclusão

Esta especificação define a base de dados planejada para o mini CRM SophData, separando lead público, atendimento autenticado, usuário, empresa, consentimentos, login social, notas internas e histórico de status.

O documento deve orientar os próximos prompts de migrations, models, enums, formulários, dashboards e testes, mantendo a separação entre PF/PJ, visitante/cliente e lead/atendimento.

Nenhum código funcional é implementado nesta etapa.
