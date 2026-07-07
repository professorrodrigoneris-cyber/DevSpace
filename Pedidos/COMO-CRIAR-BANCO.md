# 🥥 Sistema de Pedidos — Como criar o banco de dados (Firebase)

Este guia mostra **do zero** como preparar o Firebase para o `pedido.php`/`pedido.html`
funcionar: criar o projeto, ativar login, criar o banco (Firestore), aplicar as regras
de segurança e definir o administrador.

> ⏱️ Leva ~10 minutos. Não precisa de cartão de crédito (plano gratuito **Spark**).

---

## 1. Criar (ou reaproveitar) o projeto Firebase

1. Acesse **https://console.firebase.google.com** e faça login com sua conta Google.
2. Clique em **"Adicionar projeto"** (ou use o projeto **`devspace-88a0c`** que já existe — o app já vem configurado com ele).
3. Dê um nome (ex: `pedidos-loja`), avance e pode **desativar** o Google Analytics (opcional).
4. Aguarde criar e clique em **Continuar**.

### Pegar as credenciais (só se criar projeto NOVO)
1. No projeto, clique na engrenagem ⚙️ → **Configurações do projeto**.
2. Role até **"Seus aplicativos"** → clique no ícone **`</>`** (Web).
3. Dê um apelido (ex: `loja-web`) e clique em **Registrar app**.
4. Copie o objeto `firebaseConfig` que aparece.
5. Cole no `pedido.php`/`pedido.html`, substituindo o bloco `const firebaseConfig = { ... }`.

> 🔓 Essas chaves são **públicas** por natureza (ficam no navegador). A segurança
> vem das **regras do Firestore** (passo 4), não do sigilo da chave.

---

## 2. Ativar o Login (Authentication)

1. Menu lateral → **Build → Authentication** → **Começar**.
2. Aba **"Sign-in method"** → ative:
   - **E-mail/senha** → ativar → Salvar.
   - **Google** → ativar → escolha um e-mail de suporte → Salvar.
3. (Se for publicar online) aba **Settings → Authorized domains**: adicione o domínio
   onde vai hospedar (ex: `professorrodrigoneris-cyber.github.io`). `localhost` já vem liberado.

---

## 3. Criar o banco de dados (Cloud Firestore)

1. Menu lateral → **Build → Firestore Database** → **Criar banco de dados**.
2. Escolha **"Iniciar em modo de produção"** (vamos aplicar regras no passo 4).
3. Local (location): **`southamerica-east1` (São Paulo)** para menor latência.
4. Clique em **Ativar**.

Você **não precisa criar as coleções manualmente** — elas nascem sozinhas quando o app
grava o primeiro dado. Estrutura usada:

### 📦 Coleção `produtos` (cardápio)
| Campo | Tipo | Exemplo |
|---|---|---|
| `nome` | string | "Açaí 500ml" |
| `descricao` | string | "Com granola e banana" |
| `preco` | number | 19.90 |
| `categoria` | string | "Açaí" |
| `imagem` | string | "https://..." (opcional) |
| `disponivel` | boolean | true |
| `criadoEm` | timestamp | (automático) |

### 🧾 Coleção `pedidos`
| Campo | Tipo | Exemplo |
|---|---|---|
| `userId` | string | uid do cliente |
| `cliente` | map | { nome, telefone, endereco, bairro } |
| `itens` | array | [{ id, nome, preco, qty }] |
| `subtotal` | number | 39.80 |
| `taxaEntrega` | number | 5.00 |
| `total` | number | 44.80 |
| `pagamento` | string | "pix" \| "cartao_entrega" \| "dinheiro" |
| `observacoes` | string | "Sem cebola" |
| `status` | string | novo → confirmado → preparando → saiu → entregue (ou cancelado) |
| `criadoEm` | timestamp | (automático) |

### 👥 Coleção `clientes`
| Campo | Tipo | Exemplo |
|---|---|---|
| (ID do doc) | =uid | do usuário logado |
| `nome` | string | "Maria" |
| `email` | string | "maria@email.com" |
| `telefone` | string | "(11) 90000-0000" |
| `role` | string | "cliente" \| "admin" |
| `criadoEm` | timestamp | (automático) |

---

## 4. Aplicar as REGRAS DE SEGURANÇA (importante!)

1. Em **Firestore Database** → aba **"Regras"**.
2. Apague o conteúdo e cole exatamente isto:

```
rules_version = '2';
service cloud.firestore {
  match /databases/{database}/documents {

    // Administradores (use os MESMOS e-mails do ADMIN_EMAILS no pedido.php)
    function isAdmin() {
      return request.auth != null &&
             request.auth.token.email in [
               'professorrodrigoneris@gmail.com'
             ];
    }

    // CARDÁPIO: todos leem; só o admin cria/edita/remove
    match /produtos/{id} {
      allow read: if true;
      allow write: if isAdmin();
    }

    // PEDIDOS: cliente cria o seu e lê os seus; admin lê/atualiza tudo
    match /pedidos/{id} {
      allow create: if request.auth != null
                    && request.resource.data.userId == request.auth.uid;
      allow read:   if isAdmin()
                    || (request.auth != null && resource.data.userId == request.auth.uid);
      allow update, delete: if isAdmin();
    }

    // CLIENTES: cada um cria/lê/edita o seu; admin lê todos
    match /clientes/{uid} {
      allow read:  if isAdmin() || (request.auth != null && request.auth.uid == uid);
      allow create, update: if request.auth != null && request.auth.uid == uid;
    }
  }
}
```

3. Clique em **Publicar**.

> ⚠️ Troque `professorrodrigoneris@gmail.com` pelos e-mails que serão administradores.
> Eles precisam ser **os mesmos** que estão na lista `ADMIN_EMAILS` dentro do app.

---

## 5. Definir o administrador

O admin é definido **pelo e-mail**, em dois lugares (mantenha iguais):

1. No `pedido.php`/`pedido.html`:
   ```js
   const ADMIN_EMAILS = ["professorrodrigoneris@gmail.com"];
   ```
2. Nas regras do Firestore (passo 4, dentro de `isAdmin()`).

Depois é só **criar uma conta** no site com esse e-mail (via "Criar conta" ou Google).
Ao entrar, aparece o botão **🛠️ Admin** no topo, com os pedidos em tempo real.

---

## 6. Configurar a loja (no topo do `<script>`)

```js
const LOJA = {
  nome: "Sabor Tropical",                        // nome da sua loja
  cidade: "SAO PAULO",                           // Pix: SEM acento, MAIÚSCULO, até 15 letras
  chavePix: "professorrodrigoneris@gmail.com",   // SUA chave Pix (recebe os pagamentos)
  whatsapp: "5511999999999",                     // seu número: DDI(55)+DDD+número, só dígitos
  taxaEntrega: 5.00,                             // taxa de entrega
};
```

O **Pix** gerado (copia-e-cola + QR Code) usa **sua chave real** — o cliente paga
direto na sua conta. É um Pix **estático padrão do Banco Central**, funciona em
qualquer banco/app.

---

## 7. Cadastrar os primeiros produtos

1. Entre com o e-mail de admin.
2. Vá em **🛠️ Admin → 🍽️ Cardápio → + Novo produto**.
3. Preencha nome, preço, categoria e (opcional) uma URL de imagem.
4. Salvou → já aparece no cardápio para os clientes na hora.

---

## 8. Publicar o site (hospedagem)

⚠️ **Atenção ao `.php`:** o app funciona **100% no navegador** (Firebase via JavaScript),
então o PHP não é obrigatório. Sobre a extensão:

- **GitHub Pages (onde está o portfólio):** não executa PHP. Por isso publicamos a
  versão **`pedido.html`** (idêntica) — o card do portfólio aponta para ela. ✅
- **Hospedagem com PHP** (Hostinger, InfinityFree, XAMPP local): pode usar o
  `pedido.php` e acessar `seusite.com/pedido.php`. ✅

Link publicado: **https://professorrodrigoneris-cyber.github.io/DevSpace/Pedidos/pedido.html**

---

## ✅ Checklist final
- [ ] Projeto Firebase criado / config colada no app
- [ ] Authentication: E-mail/senha **e** Google ativados
- [ ] Firestore criado (região São Paulo)
- [ ] Regras de segurança publicadas
- [ ] E-mail admin igual em `ADMIN_EMAILS` **e** nas regras
- [ ] Bloco `LOJA` configurado (chave Pix + WhatsApp)
- [ ] Primeiros produtos cadastrados

---

## 🔜 Próximo passo opcional: cartão de crédito online
Para cobrar **cartão online** (e não só na entrega), integre um gateway brasileiro —
o mais comum é o **Mercado Pago**:
1. Crie conta em https://www.mercadopago.com.br/developers
2. Use o **Checkout Pro** ou **Checkout Transparente**.
3. Exige um **backend** (as chaves secretas não podem ficar no navegador) —
   pode ser uma **Cloud Function do Firebase** ou um script PHP no servidor.
4. O app já cria o pedido no banco; o gateway só entra na etapa de pagamento.

Quando quiser, posso montar essa integração para você.
