# 🔒 Cofre dos Sonhos

![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow)
![Firebase](https://img.shields.io/badge/backend-Firebase-orange?logo=firebase)
![JavaScript](https://img.shields.io/badge/frontend-JavaScript-yellow?logo=javascript)
![License](https://img.shields.io/badge/license-MIT-blue)

Plataforma web onde o usuário escreve sonhos, metas e planos, "tranca" esse
conteúdo em um cofre digital com data de abertura futura (1, 5, 10 anos ou
data customizada) e recebe, no dia marcado, uma retrospectiva com tudo o que
escreveu, a timeline construída ao longo do tempo e mensagens de apoio de
amigos e familiares.

> Projeto de portfólio — documento de arquitetura e lógica de negócio,
> pensado para implementação com **Firebase** (Auth, Firestore, Storage,
> Cloud Functions, Hosting).

---

## Sumário

- [Visão Geral](#visão-geral)
- [Tecnologias](#tecnologias)
- [Papéis de Usuário](#papéis-de-usuário)
- [Modelo de Dados](#modelo-de-dados-firestore)
- [Máquina de Estados do Cofre](#máquina-de-estados-do-cofre)
- [Regras de Negócio e Imutabilidade](#regras-de-negócio-e-imutabilidade)
- [Fluxos Principais](#fluxos-principais)
- [Regras de Segurança](#regras-de-segurança-conceito-sem-código)
- [Cloud Functions](#cloud-functions)
- [Decisões de Produto em Aberto](#decisões-de-produto-a-confirmar-com-o-cliente)
- [Estrutura de Telas](#estrutura-de-telas)
- [Roadmap](#roadmap-sugerido-fases-de-desenvolvimento)
- [Licença](#licença)

---

## Visão Geral

Durante o período trancado:

- O conteúdo principal (o sonho/meta/plano) **não pode ser editado**.
- O usuário pode ir adicionando itens a uma **timeline** (fotos, mensagens,
  conquistas, lembranças).
- O usuário pode **compartilhar um sonho específico** com amigos/família,
  que deixam mensagens de apoio — também ocultas até a abertura.

Na data de abertura, tudo é revelado de uma vez: conteúdo original + timeline
+ mensagens de apoio, em formato de retrospectiva.

## Tecnologias

**Backend / infraestrutura (Firebase)**
- Firebase Authentication — login (e-mail/senha, Google)
- Cloud Firestore — banco de dados principal
- Firebase Storage — fotos e mídia
- Cloud Functions — regras agendadas, gatilhos e notificações
- Firebase Hosting — deploy do frontend
- FCM / extensão Trigger Email — notificações

**Frontend**
- HTML5, CSS3, JavaScript (ou framework de preferência, ex: React)

---

## Papéis de Usuário

| Papel | Descrição |
|---|---|
| **Dono (owner)** | Cria e tranca o cofre, gerencia compartilhamentos |
| **Apoiador (convidado)** | Recebe link de um sonho compartilhado, deixa mensagem de apoio |
| **Visitante** | Acessa a landing page pública, ainda não autenticado |

---

## Modelo de Dados (Firestore)

### `users`
- `uid`, `nome`, `email`, `fotoPerfil`
- `dataCriacao` (server timestamp)
- `preferenciasNotificacao` (lembrete 30/7/1 dia, etc.)

### `vaults` (cofres) — dados **públicos/leves**, sempre legíveis pelo dono
- `id`, `ownerId`
- `titulo`, `categoria` (sonho | meta | plano)
- `capaUrl` (imagem de capa, pode ser exibida mesmo trancado)
- `dataCriacao` (server timestamp — nunca editável)
- `dataAbertura` (definida na criação — imutável após selar)
- `status`: `draft` → `sealed` → `ready_to_open` → `opened`
- `totalItensTimeline`, `totalMensagensApoio` (contadores, sem conteúdo)
- `compartilhavel` (boolean)

### `vaults/{id}/sealedContent` (subcoleção) — conteúdo protegido
- `conteudoPrincipal` (texto do sonho/meta/plano)
- `midiaPrincipal` (array de URLs do Storage)
- `dataAberturaEspelhada` (cópia da data, usada pela regra de segurança)

> Separar o conteúdo real do documento "leve" do vault é o que permite negar
> a leitura por completo até a data de abertura, em vez de tentar esconder
> campos individuais.

### `vaults/{id}/timelineEntries`
- `id`, `autorId`
- `tipo`: `foto` | `mensagem` | `conquista` | `lembranca`
- `conteudo` / `midiaUrl`
- `dataAdicao` (server timestamp — define a ordem cronológica real)

### `shareInvites`
- `id`, `vaultId`, `criadoPor`
- `tokenUnico` (usado na URL pública de convite)
- `destinatarioNome` (opcional)
- `status`: `pendente` | `respondido`
- `dataCriacao`, `dataExpiracao` (opcional)

### `supportMessages`
- `id`, `vaultId`, `inviteId`
- `autorNome`, `autorEmail` (opcional, convidado pode não ter conta)
- `mensagem`
- `dataEnvio` (server timestamp)

### `notifications`
- `id`, `userId`, `vaultIdRelacionado`
- `tipo`: `lembrete_abertura` | `cofre_pronto` | `nova_mensagem_apoio`
- `lida` (boolean), `dataCriacao`

---

## Máquina de Estados do Cofre

```
[draft] --(usuário confirma criação + define dataAbertura)--> [sealed]
[sealed] --(dataAbertura <= agora, verificado por função agendada)--> [ready_to_open]
[ready_to_open] --(usuário acessa e visualiza pela 1ª vez)--> [opened]
```

Duas estratégias possíveis para a transição `sealed → ready_to_open`
(escolher uma na implementação):

1. **Lazy check**: ao carregar o vault, comparar `dataAbertura` com o horário
   do servidor e atualizar o status na hora — não depende de job rodando em
   background.
2. **Scheduled function**: uma função agendada (ex: a cada hora) varre os
   vaults `sealed` e atualiza os que já venceram — permite disparar
   notificações proativas ("seu cofre abriu!") mesmo sem o usuário acessar.

Recomendação: usar as duas — lazy check garante consistência mesmo se a
função agendada falhar; a função agendada garante a notificação proativa.

---

## Regras de Negócio e Imutabilidade

- Campos de `vaults` (`titulo`, `dataAbertura`, `categoria`) só podem ser
  escritos enquanto `status == draft`. Após selar, viram somente leitura.
- `sealedContent` só pode ser **lido** quando `dataAberturaEspelhada <= now`
  (comparado com o horário do servidor, nunca do cliente). Isso vale
  inclusive para o próprio dono — é uma decisão de produto a confirmar (ver
  seção de decisões em aberto).
- `timelineEntries` podem ser **criadas** a qualquer momento enquanto
  `sealed`, mas só podem ser **lidas** quando o vault estiver `opened` (ou
  `ready_to_open`, se preferir liberar assim que a data chegar).
- `supportMessages`: qualquer convidado com um `tokenUnico` válido pode
  **criar** uma mensagem a qualquer momento; **ninguém** (nem o dono) pode
  **ler** o conteúdo antes da abertura — só a contagem
  (`totalMensagensApoio`) fica visível, para gerar expectativa sem entregar
  o conteúdo.
- Nenhuma escrita usa data enviada pelo cliente para decisões de segurança —
  sempre `request.time` / timestamp do servidor.

---

## Fluxos Principais

### Criar cofre
1. Usuário autenticado preenche título, categoria, conteúdo do sonho, mídia
   e escolhe a data de abertura (presets 1/5/10 anos + data customizada).
2. Ao confirmar, o sistema grava `vaults` (status `draft` → `sealed` em uma
   única transação) e `sealedContent` na subcoleção.
3. A partir daqui, os campos principais ficam bloqueados.

### Adicionar à timeline (durante o período trancado)
1. Usuário acessa o cofre trancado (vê apenas capa + countdown).
2. Adiciona uma entrada (foto/mensagem/conquista/lembrança).
3. Entrada é salva com `dataAdicao` do servidor; não é exibida a ninguém até
   a abertura.

### Compartilhar um sonho
1. Dono gera um convite (`shareInvites`) para um sonho específico — link
   genérico ou nominal.
2. Convidado abre o link público (sem precisar de conta), informa nome e
   escreve uma mensagem de apoio.
3. Mensagem é salva em `supportMessages`, vinculada ao `inviteId`.
4. Dono recebe apenas a confirmação de que "alguém deixou uma mensagem" —
   sem ver o conteúdo.

### Abertura / Revelação
1. Ao chegar a data (via lazy check ou função agendada), o status muda para
   `ready_to_open`/`opened`.
2. Usuário é notificado.
3. Ao acessar, a interface libera: conteúdo principal (`sealedContent`) +
   timeline ordenada cronologicamente + todas as mensagens de apoio —
   apresentados como uma retrospectiva/linha do tempo única.

---

## Regras de Segurança (conceito, sem código)

- Leitura de `sealedContent`: permitida somente se
  `dataAberturaEspelhada <= request.time`.
- Escrita em `vaults` (campos congelados): permitida somente se
  `resource.data.status == 'draft'`.
- Leitura de `timelineEntries`: permitida somente se o vault pai estiver
  `opened` (ou `ready_to_open`).
- Escrita em `timelineEntries`: permitida somente para `autorId == ownerId`
  do vault e enquanto `status != opened`.
- Escrita em `supportMessages`: permitida para qualquer requisição que
  apresente um `tokenUnico` de convite válido e não expirado; leitura
  restrita ao próprio dono e somente após a abertura.
- Nenhuma regra de segurança confia em campos de data vindos do próprio
  documento sem que esse campo tenha sido gravado por uma função de servidor
  ou validado na criação — evita que alguém manipule `dataAbertura` para
  abrir o cofre antes da hora.

---

## Cloud Functions

| Função | Gatilho | O que faz |
|---|---|---|
| `verificarAberturaCofres` | Agendada (ex: de hora em hora) | Busca vaults `sealed` com `dataAbertura <= now`, atualiza status, dispara notificação "cofre pronto" |
| `enviarLembretesAbertura` | Agendada (diária) | Busca vaults `sealed` cuja `dataAbertura` está a 30/7/1 dia, envia lembrete |
| `onSupportMessageCreated` | Firestore `onCreate` em `supportMessages` | Valida convite, incrementa `totalMensagensApoio` no vault, notifica o dono (sem conteúdo) |
| `onInviteCreated` | Firestore `onCreate` em `shareInvites` | Gera/valida token único, opcionalmente envia e-mail ao convidado via extensão Trigger Email |
| `validarImutabilidade` | Firestore `onUpdate` em `vaults` | Camada extra de segurança: rejeita/reverte updates indevidos em campos congelados, redundante às regras do Firestore |

---

## Decisões de Produto a Confirmar com o Cliente

1. **O próprio dono pode reler o conteúdo antes da abertura, ou fica "cego"
   também**, para preservar 100% o efeito surpresa?
2. Convidados precisam criar conta, ou o modelo **anônimo (nome + mensagem)**
   é suficiente?
3. Existe alguma forma de **abrir o cofre antecipadamente** (ex: emergência),
   ou a regra é 100% rígida até a data?
4. O cofre pode ser **excluído** antes da abertura?
5. Há **limite de tamanho/quantidade** de mídia por cofre (custo de Storage)?
6. Itens de timeline podem ser adicionados **depois** de o cofre já ter
   aberto (como um "adendo" contínuo), ou a timeline também congela na
   abertura?

---

## Estrutura de Telas

1. Landing page (pública, explica o conceito)
2. Cadastro/Login (Firebase Auth — e-mail/senha + Google)
3. Dashboard (lista de cofres: trancados com countdown, prontos, abertos)
4. Criar novo cofre (wizard: título → conteúdo → mídia → data de abertura)
5. Detalhe do cofre trancado (capa, countdown, botão de adicionar à
   timeline, botão de compartilhar)
6. Gerenciar compartilhamento (gerar convites, ver contagem de respostas)
7. Página pública do convite (formulário simples para o apoiador, sem
   login)
8. Página de revelação (animação de abertura + conteúdo + timeline +
   mensagens de apoio, em ordem cronológica)
9. Configurações de notificação

---

## Roadmap Sugerido (fases de desenvolvimento)

- [ ] **Fase 1** — Auth + CRUD básico: criar/listar/ver cofre, sem lógica de bloqueio
- [ ] **Fase 2** — Máquina de estados + imutabilidade: separar `sealedContent`, aplicar regras de segurança do Firestore
- [ ] **Fase 3** — Timeline: adicionar itens ao longo do tempo, exibição só na abertura
- [ ] **Fase 4** — Compartilhamento: convites + mensagens de apoio de convidados
- [ ] **Fase 5** — Cloud Functions: lembretes, verificação de abertura, notificações
- [ ] **Fase 6** — Página de revelação: animação e experiência de retrospectiva
- [ ] **Fase 7** — Polimento: notificações push/e-mail, ajustes de UX

---

## Licença

Projeto de portfólio, distribuído sob a licença MIT.
