# Especificação LGPD — Consentimentos, privacidade e uso de dados no atendimento SophData

## 1. Objetivo do documento

Este documento define como a SophData deve coletar, registrar, usar e proteger dados pessoais no fluxo de atendimento, captação de leads, autenticação de clientes, login social e painel administrativo.

O objetivo é permitir atendimento comercial e técnico com baixa fricção, mas sem coletar dados excessivos e sem misturar consentimento obrigatório de atendimento com consentimento opcional de marketing.

Esta especificação orienta implementações futuras. Nenhuma migration, model, formulário real, rota, view pública ou alteração na política pública é criada nesta etapa.

## 2. Princípios de privacidade aplicados ao mini CRM

Princípios:

- Coletar apenas dados necessários.
- Explicar a finalidade antes do envio.
- Separar atendimento de marketing.
- Registrar consentimento de forma auditável.
- Não obrigar consentimento de marketing.
- Proteger dados contra acesso indevido.
- Limitar acesso administrativo.
- Permitir futura correção, exclusão ou anonimização.
- Evitar dados sensíveis no primeiro contato.
- Manter textos simples e compreensíveis.

Regra central:

```txt
O usuário deve entender por que está informando seus dados e para que a SophData vai usá-los.
```

## 3. Dados coletados no primeiro contato

Pessoa Física:

Obrigatórios:

- nome;
- telefone;
- e-mail;
- aceite da Política de Privacidade;
- permissão de contato sobre a solicitação.

Opcionais:

- serviço de interesse;
- mensagem curta;
- melhor horário para retorno;
- canal preferido de retorno;
- aceite de comunicações futuras.

Pessoa Jurídica:

Obrigatórios:

- nome;
- telefone;
- e-mail;
- nome da empresa;
- aceite da Política de Privacidade;
- permissão de contato sobre a solicitação.

Opcionais:

- área de interesse;
- mensagem curta;
- melhor horário para retorno;
- canal preferido de retorno;
- aceite de comunicações futuras.

`nome da empresa` é obrigatório apenas para Pessoa Jurídica. O primeiro contato não deve pedir CPF, CNPJ, endereço completo, documentos, dados financeiros ou senhas.

## 4. Dados coletados no cadastro de cliente

Cadastro básico com e-mail e senha:

- nome;
- e-mail;
- senha.

Complemento de perfil, quando necessário:

- telefone;
- tipo de cliente: Pessoa Física ou Pessoa Jurídica;
- empresa vinculada, se PJ.

Regras:

- Telefone pode ser solicitado depois do cadastro.
- Empresa só deve ser exigida quando o contexto for PJ.
- Senha não deve ser pedida para lead anônimo no primeiro contato.
- Cadastro não deve ser obrigatório para enviar lead inicial.
- O cadastro deve usar linguagem clara sobre finalidade e privacidade.

## 5. Dados coletados no login social

Provedores desta fase:

- Google.
- Microsoft/Outlook.

Dados que podem vir do provedor:

- nome;
- e-mail;
- id do provedor;
- avatar, se disponível e se for usado.

Regras:

- Não esperar telefone do Google ou Microsoft.
- Não exigir telefone no callback social.
- Telefone deve ser pedido depois, no complemento de perfil ou no atendimento.
- Não implementar Facebook nesta fase.
- Não armazenar tokens desnecessários no MVP.
- Não expor client secret.

O login social serve para facilitar acesso e identificação do cliente, não para coletar dados além do necessário.

## 6. Dados coletados na abertura de atendimento autenticado

Quando o cliente já estiver logado e abrir chamado, poderá ser solicitado:

- tipo PF/PJ;
- área de serviço;
- assunto;
- mensagem;
- urgência;
- canal preferido de retorno;
- empresa vinculada, se PJ.

Regras:

- Atendimento autenticado deve pertencer a um usuário.
- Cliente só pode visualizar seus próprios atendimentos.
- Admin pode visualizar todos.
- Notas internas não aparecem para o cliente.
- Mensagem livre pode conter dados pessoais e deve ser protegida.

## 7. Finalidade de uso dos dados

Dados de contato serão usados para:

- responder solicitação de atendimento;
- entrar em contato pelos canais informados;
- entender a necessidade técnica ou comercial;
- registrar histórico de atendimento;
- permitir acompanhamento pelo cliente autenticado;
- permitir gestão administrativa interna.

Dados de marketing só serão usados se houver opt-in:

- envio de comunicações sobre serviços;
- novidades da SophData;
- conteúdos técnicos ou comerciais.

Regra:

```txt
O usuário pode solicitar atendimento mesmo recusando comunicações de marketing.
```

## 8. Consentimento obrigatório para atendimento

O consentimento obrigatório está ligado à finalidade de responder à solicitação.

Texto do checkbox obrigatório:

```txt
Li e aceito a Política de Privacidade.
```

Texto auxiliar recomendado:

```txt
Usaremos seus dados para responder sua solicitação de atendimento e entrar em contato pelos canais informados.
```

Regra:

```txt
Sem aceite da Política de Privacidade, o formulário de lead ou atendimento não deve ser enviado.
```

Esse aceite não é permissão para marketing. Ele autoriza o tratamento necessário para responder à solicitação enviada.

## 9. Consentimento opcional para marketing

Texto do checkbox opcional:

```txt
Aceito receber comunicações da SophData sobre serviços, conteúdos e novidades.
```

Regras:

- Deve vir desmarcado por padrão.
- Não pode ser obrigatório.
- Não pode bloquear envio do atendimento.
- Deve ser registrado separadamente.
- Deve poder ser revogado futuramente.

Valor esperado:

```txt
marketing_opt_in = true ou false
```

Padrão:

```txt
marketing_opt_in = false
```

## 10. Texto de finalidade para formulários

Texto curto padrão:

```txt
Usaremos seus dados para responder sua solicitação de atendimento e entrar em contato pelos canais informados.
```

Texto para lead PF:

```txt
Informe seus dados para que a SophData possa retornar e orientar o melhor caminho para o seu atendimento.
```

Texto para lead PJ:

```txt
Informe seus dados para que a SophData possa entender a necessidade da sua empresa e retornar com o próximo passo.
```

Texto para cliente autenticado:

```txt
As informações enviadas serão usadas para registrar seu atendimento e permitir acompanhamento pela área do cliente.
```

## 11. Checkboxes e microcopy

Checkbox obrigatório:

```txt
[ ] Li e aceito a Política de Privacidade.
```

Validação:

```txt
Você precisa aceitar a Política de Privacidade para enviar a solicitação.
```

Checkbox opcional:

```txt
[ ] Aceito receber comunicações da SophData sobre serviços, conteúdos e novidades.
```

Microcopy:

```txt
Você pode solicitar atendimento mesmo sem aceitar comunicações de marketing.
```

Os checkboxes devem aparecer próximos ao envio e com link para a Política de Privacidade.

## 12. Registro técnico do consentimento

Cada envio deve registrar:

- versão da política de privacidade;
- data e hora do aceite;
- aceite obrigatório;
- opt-in de marketing;
- IP, quando aplicável;
- user agent, quando aplicável;
- vínculo com `lead_request`, `service_request` ou `user`.

Tabela futura planejada:

```txt
privacy_consents
```

Campos planejados:

```txt
user_id
lead_request_id
service_request_id
privacy_policy_version
accepted_at
contact_permission
marketing_opt_in
ip_address
user_agent
```

Regras:

- `accepted_at` deve ser preenchido no momento do envio.
- `contact_permission` deve ser true para envio de atendimento.
- `marketing_opt_in` pode ser false.
- Deve haver vínculo com lead, atendimento ou usuário.

## 13. Versão da política de privacidade

O sistema deve usar uma versão identificável da política.

Sugestões:

```txt
privacy_policy_version = 2026-01
```

ou:

```txt
privacy_policy_version = v1.0
```

Regras:

- Não deixar versão vazia.
- Registrar a versão aceita no momento do envio.
- Se a política mudar futuramente, novos consentimentos devem registrar nova versão.

A versão pode ser definida futuramente em:

```txt
config/sophdata.php
```

ou em outro config específico.

Não implementar agora.

## 14. IP, user agent e dados de auditoria

IP e user agent podem ser registrados para fins de auditoria, segurança e comprovação do consentimento.

Regras:

- Não exibir IP e user agent para cliente comum.
- Admin pode visualizar somente se houver necessidade operacional.
- Não usar esses dados para marketing.
- Não expor em páginas públicas.
- Não registrar esses dados em logs desnecessários.

## 15. Tratamento de dados de Pessoa Física

Para PF, os dados devem ser tratados com cuidado porque representam diretamente uma pessoa natural.

Regras:

- Pedir apenas dados necessários.
- Não pedir CPF no primeiro atendimento.
- Não pedir endereço completo no primeiro atendimento.
- Não pedir dados financeiros.
- Não pedir informações sensíveis.
- Mensagem livre pode conter dados pessoais, então deve ser protegida.

O fluxo PF deve ser simples, claro e sem linguagem empresarial excessiva.

## 16. Tratamento de dados de Pessoa Jurídica

Para PJ, ainda pode haver dados pessoais do responsável pelo contato.

Regras:

- Nome, e-mail e telefone do contato continuam sendo dados pessoais.
- Nome da empresa deve ser usado apenas para contextualizar atendimento.
- Não pedir CNPJ no primeiro lead.
- Não pedir contrato ou dados financeiros no primeiro contato.

Mesmo no fluxo empresarial, a SophData deve tratar o contato responsável como titular de dados pessoais.

## 17. Tratamento de leads não autenticados

Lead não autenticado é visitante que envia dados mínimos sem criar conta.

Regras:

- Pode enviar solicitação sem senha.
- Deve aceitar política.
- Pode recusar marketing.
- Deve receber confirmação de envio.
- Não terá acesso a painel até criar conta ou fazer login.
- Admin poderá visualizar e tratar o lead.
- Lead descartado deve seguir regra futura de retenção, exclusão ou anonimização.

## 18. Tratamento de clientes autenticados

Cliente autenticado é usuário logado que pode abrir e acompanhar atendimentos.

Regras:

- Cliente visualiza apenas seus próprios atendimentos.
- Cliente não visualiza leads de outros usuários.
- Cliente não acessa painel administrativo.
- Cliente não visualiza notas internas.
- Cliente pode atualizar dados básicos futuramente.
- Atendimento autenticado deve registrar vínculo com o usuário.

## 19. Tratamento de dados de login social

Regras específicas:

- Google e Microsoft podem criar ou vincular usuário.
- E-mail deve ser usado para evitar duplicidade.
- `provider_id` deve ser armazenado em `social_accounts`.
- Se e-mail já existir, vincular conta social ao usuário existente.
- Não armazenar secrets no banco.
- Não exibir dados do provedor para outros usuários.
- Não implementar login social agora.

Tokens de acesso só devem ser armazenados se uma necessidade futura justificar, com proteção adequada e escopo mínimo.

## 20. Papel do WhatsApp sob a ótica da LGPD

O WhatsApp poderá ser canal preferido de retorno indicado pelo usuário, mas não deve substituir o registro do lead.

Regras:

- Se usuário escolher WhatsApp como canal preferido, o telefone informado poderá ser usado para retorno.
- WhatsApp não deve ser destino obrigatório.
- WhatsApp não deve ser o único canal possível.
- O usuário deve entender que será contatado pelo canal informado.

Campo futuro:

```txt
preferred_contact_channel = whatsapp | email | phone
```

O uso do WhatsApp deve permanecer vinculado à finalidade de atendimento, exceto quando houver consentimento separado para marketing.

## 21. Direitos do titular

A política futura deve informar que o usuário poderá solicitar:

- confirmação de tratamento;
- acesso aos dados;
- correção de dados;
- exclusão ou anonimização quando aplicável;
- revogação de consentimento de marketing;
- informações sobre uso dos dados.

Não implementar fluxo de solicitação de direitos neste MVP. A documentação e a política devem preparar esse caminho para versões posteriores.

## 22. Retenção, exclusão e anonimização futura

Regras iniciais:

- Leads descartados não devem ser mantidos indefinidamente sem critério.
- Atendimentos encerrados podem ser retidos por histórico operacional.
- `marketing_opt_in` deve poder ser revogado futuramente.
- Exclusão completa pode ser substituída por anonimização quando houver necessidade legítima de histórico operacional.

Decisão em aberto:

```txt
Definir prazo de retenção formal em versão futura da política.
```

## 23. Segurança e controle de acesso

Regras:

- Visitante pode criar lead, mas não pode listar leads.
- Cliente pode ver apenas seus próprios atendimentos.
- Admin pode ver leads e atendimentos.
- Admin pode alterar status.
- Admin pode registrar notas internas.
- Notas internas não são públicas.
- Dados pessoais não devem aparecer em logs desnecessariamente.
- Erros não devem expor dados sensíveis.
- Acesso administrativo deve ser protegido por autenticação e autorização.

## 24. Relação com painel administrativo

O painel administrativo terá acesso a dados de leads e atendimentos para que a SophData possa responder solicitações, alterar status e registrar notas internas.

Regras:

- Acesso administrativo deve ser restrito.
- Cliente não acessa admin.
- Notas internas não aparecem para cliente.
- Alterações de status devem gerar histórico.
- Dados de consentimento devem ficar disponíveis para auditoria interna quando necessário.

## 25. Relação com a política de privacidade pública

A política pública precisará ser atualizada posteriormente para mencionar:

- captação de leads;
- formulários de atendimento;
- cadastro de usuários;
- login social Google/Microsoft;
- abertura de chamados;
- painel do cliente;
- painel administrativo;
- contato ativo;
- WhatsApp como canal possível de retorno;
- marketing opcional;
- direitos do titular;
- retenção de dados.

A atualização da política pública será feita no Prompt 29.

Não alterar a política pública agora.

## 26. Regras para formulários futuros

Todos os formulários futuros devem seguir:

- Label visível em cada campo.
- Finalidade explicada antes do envio.
- Checkbox obrigatório de política.
- Checkbox opcional de marketing separado.
- Mensagem de erro clara.
- Não apagar dados do usuário ao validar erro.
- Não usar linguagem jurídica excessiva.
- Link para Política de Privacidade.

Formulários devem usar a menor quantidade de campos possível para cumprir a finalidade do momento.

## 27. O que não deve ser coletado no MVP

No primeiro MVP, não coletar:

- CPF;
- CNPJ;
- RG;
- endereço completo;
- dados bancários;
- cartão de crédito;
- informações médicas;
- dados de crianças;
- documentos pessoais;
- arquivos anexos;
- senhas de equipamentos;
- senhas de e-mail;
- senhas de redes sociais.

Se algum atendimento exigir senha técnica no futuro, isso deve ser tratado fora do formulário inicial e com orientação específica.

## 28. Critérios de aceite para implementação futura

Critérios:

- Lead não envia sem aceitar política.
- Marketing é opcional.
- Marketing vem desmarcado por padrão.
- PF exige nome, telefone e e-mail.
- PJ exige nome, telefone, e-mail e empresa.
- Versão da política é registrada.
- `accepted_at` é registrado.
- IP e user agent são registrados quando aplicável.
- Consentimento fica vinculado ao lead ou atendimento.
- Cliente vê apenas seus próprios dados.
- Admin tem acesso restrito.
- WhatsApp é canal preferido, não destino obrigatório.
- Login social não exige telefone no callback.
- Consentimento de atendimento e marketing são campos separados.
- Política pública é atualizada antes do deploy final do mini CRM.

## 29. Decisões em aberto

Decisões para prompts futuros:

- Qual será a versão inicial da política: `v1.0` ou data?
- Haverá e-mail específico para solicitações LGPD?
- Qual será o prazo de retenção de leads descartados?
- Lead descartado será excluído ou anonimizado?
- Cliente poderá solicitar exclusão pelo painel?
- Admin verá IP/user agent por padrão ou apenas em detalhes técnicos?
- Haverá logs de consentimento imutáveis no futuro?
- Como será registrada a revogação de marketing?
- A política pública terá histórico de versões visível?

## 30. Conclusão

Esta especificação define como a SophData deve tratar privacidade, consentimentos e uso de dados no futuro mini CRM, mantendo o primeiro contato simples e registrando consentimentos de forma auditável.

O fluxo deve separar atendimento obrigatório de marketing opcional, proteger dados de PF e PJ, tratar login social com coleta mínima e preparar a futura atualização da Política de Privacidade pública.

Nenhum código funcional é implementado nesta etapa.
