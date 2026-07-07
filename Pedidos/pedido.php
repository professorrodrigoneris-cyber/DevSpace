<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabor Tropical — Peça Online</title>
  <meta name="description" content="Sistema de pedidos online: cardápio, carrinho, pagamento via Pix e acompanhamento de pedidos.">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🥥</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
/* ============================================
   SABOR TROPICAL — Design System
   ============================================ */
:root {
  --bg: #f7f8f6;
  --bg-soft: #ffffff;
  --surface: #ffffff;
  --text: #14201a;
  --text-soft: #5b6b62;
  --text-mut: #94a39a;
  --border: #e6ebe7;
  --primary: #16a34a;
  --primary-dark: #128a3e;
  --primary-soft: #e9f7ef;
  --accent: #ff6b35;
  --accent-soft: #fff0ea;
  --warn: #f59e0b;
  --danger: #ef4444;
  --danger-soft: #fdecec;
  --info: #3b82f6;
  --shadow-sm: 0 1px 3px rgba(20,32,26,.06);
  --shadow: 0 6px 24px rgba(20,32,26,.08);
  --shadow-lg: 0 16px 48px rgba(20,32,26,.14);
  --radius: 14px;
  --radius-sm: 10px;
  --radius-lg: 20px;
  --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  --mono: 'JetBrains Mono', monospace;
  --header-h: 66px;
  --max: 1120px;
  --t: .22s cubic-bezier(.4,0,.2,1);
}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:var(--font);background:var(--bg);color:var(--text);line-height:1.55;min-height:100vh;-webkit-font-smoothing:antialiased;}
a{text-decoration:none;color:inherit;}
button{font-family:inherit;cursor:pointer;border:none;background:none;color:inherit;}
input,textarea,select{font-family:inherit;}
img{max-width:100%;display:block;}
::-webkit-scrollbar{width:8px;height:8px;}
::-webkit-scrollbar-thumb{background:#cfd8d2;border-radius:4px;}

.container{max-width:var(--max);margin:0 auto;padding:0 20px;}
.hidden{display:none !important;}
.muted{color:var(--text-soft);}
.mono{font-family:var(--mono);}

/* ---------- Buttons ---------- */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;
  padding:11px 20px;border-radius:var(--radius-sm);font-size:.9rem;font-weight:600;
  transition:var(--t);white-space:nowrap;}
.btn-primary{background:var(--primary);color:#fff;box-shadow:0 4px 14px rgba(22,163,74,.25);}
.btn-primary:hover{background:var(--primary-dark);transform:translateY(-1px);}
.btn-accent{background:var(--accent);color:#fff;box-shadow:0 4px 14px rgba(255,107,53,.25);}
.btn-accent:hover{filter:brightness(.96);transform:translateY(-1px);}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--text);}
.btn-outline:hover{border-color:var(--primary);color:var(--primary);}
.btn-ghost{background:transparent;color:var(--text-soft);padding:8px 14px;}
.btn-ghost:hover{background:#eef2ef;color:var(--text);}
.btn-danger{background:var(--danger-soft);color:var(--danger);}
.btn-danger:hover{background:#fbdcdc;}
.btn-sm{padding:7px 14px;font-size:.82rem;}
.btn-block{width:100%;}
.btn:disabled{opacity:.55;cursor:not-allowed;transform:none;}

/* ---------- Header ---------- */
.header{position:fixed;top:0;left:0;width:100%;height:var(--header-h);z-index:100;
  background:rgba(255,255,255,.9);backdrop-filter:blur(14px);border-bottom:1px solid var(--border);}
.header-inner{max-width:var(--max);margin:0 auto;height:100%;display:flex;align-items:center;
  justify-content:space-between;padding:0 20px;gap:12px;}
.brand{display:flex;align-items:center;gap:9px;font-weight:800;font-size:1.15rem;cursor:pointer;}
.brand .logo{width:36px;height:36px;border-radius:11px;display:flex;align-items:center;justify-content:center;
  font-size:1.2rem;background:linear-gradient(135deg,var(--primary),#22c55e);box-shadow:0 4px 12px rgba(22,163,74,.3);}
.brand .name{background:linear-gradient(135deg,var(--primary),var(--accent));-webkit-background-clip:text;
  -webkit-text-fill-color:transparent;background-clip:text;}
.nav{display:flex;align-items:center;gap:4px;}
.nav a,.nav button.navlink{padding:8px 14px;border-radius:9px;font-size:.88rem;font-weight:500;color:var(--text-soft);transition:var(--t);}
.nav a:hover,.nav button.navlink:hover{color:var(--text);background:#eef2ef;}
.nav .active{color:var(--primary);background:var(--primary-soft);}
.header-actions{display:flex;align-items:center;gap:8px;}
.cart-btn{position:relative;width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;
  font-size:1.15rem;background:#eef2ef;transition:var(--t);}
.cart-btn:hover{background:#e2e9e4;}
.cart-count{position:absolute;top:-5px;right:-5px;min-width:19px;height:19px;padding:0 5px;border-radius:10px;
  background:var(--accent);color:#fff;font-size:.68rem;font-weight:700;display:flex;align-items:center;justify-content:center;}
.user-chip{display:flex;align-items:center;gap:8px;}
.user-chip .uname{font-size:.85rem;color:var(--text-soft);max-width:120px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.avatar{width:34px;height:34px;border-radius:50%;background:var(--primary-soft);color:var(--primary);
  display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;border:2px solid var(--primary);}
.menu-toggle{display:none;flex-direction:column;gap:4px;padding:8px;}
.menu-toggle span{width:20px;height:2px;background:var(--text);border-radius:2px;}

/* ---------- Screens ---------- */
.screen{display:none;min-height:100vh;padding-top:calc(var(--header-h) + 26px);padding-bottom:60px;animation:fade .3s ease;}
.screen.active{display:block;}
@keyframes fade{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}

/* ---------- Hero / store head ---------- */
.store-hero{background:linear-gradient(135deg,#0f4d2c,#16a34a 60%,#1f9d55);color:#fff;border-radius:var(--radius-lg);
  padding:34px 30px;margin-bottom:26px;position:relative;overflow:hidden;box-shadow:var(--shadow);}
.store-hero::after{content:'🥥';position:absolute;right:-10px;bottom:-20px;font-size:9rem;opacity:.12;}
.store-hero h1{font-size:1.9rem;font-weight:800;margin-bottom:6px;letter-spacing:-.02em;}
.store-hero p{opacity:.92;max-width:520px;font-size:.95rem;}
.store-hero .badges{display:flex;gap:10px;margin-top:16px;flex-wrap:wrap;}
.store-hero .badge{background:rgba(255,255,255,.15);padding:6px 13px;border-radius:20px;font-size:.8rem;font-weight:600;backdrop-filter:blur(4px);}

/* ---------- Category tabs ---------- */
.cat-bar{display:flex;gap:8px;overflow-x:auto;padding-bottom:6px;margin-bottom:22px;}
.cat-bar::-webkit-scrollbar{height:0;}
.cat-chip{padding:8px 18px;border-radius:22px;font-size:.86rem;font-weight:600;white-space:nowrap;
  background:var(--surface);border:1px solid var(--border);color:var(--text-soft);transition:var(--t);}
.cat-chip.active{background:var(--primary);border-color:var(--primary);color:#fff;}

/* ---------- Menu grid ---------- */
.cat-group{margin-bottom:34px;}
.cat-group h2{font-size:1.2rem;font-weight:800;margin-bottom:14px;display:flex;align-items:center;gap:8px;}
.menu-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;}
.product{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;
  display:flex;flex-direction:column;transition:var(--t);box-shadow:var(--shadow-sm);}
.product:hover{transform:translateY(-3px);box-shadow:var(--shadow);}
.product-img{height:150px;background:#eef2ef;display:flex;align-items:center;justify-content:center;font-size:3rem;overflow:hidden;position:relative;}
.product-img img{width:100%;height:100%;object-fit:cover;}
.product.unavailable{opacity:.6;}
.product-tag{position:absolute;top:10px;left:10px;background:var(--danger);color:#fff;font-size:.7rem;font-weight:700;padding:3px 9px;border-radius:20px;}
.product-body{padding:15px;display:flex;flex-direction:column;flex:1;gap:6px;}
.product-body h3{font-size:1rem;font-weight:700;}
.product-body .desc{font-size:.83rem;color:var(--text-soft);flex:1;}
.product-foot{display:flex;align-items:center;justify-content:space-between;margin-top:8px;gap:10px;}
.price{font-size:1.15rem;font-weight:800;color:var(--primary);}

/* ---------- Cart ---------- */
.two-col{display:grid;grid-template-columns:1fr 360px;gap:22px;align-items:start;}
.card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:20px;box-shadow:var(--shadow-sm);}
.card h2{font-size:1.15rem;font-weight:800;margin-bottom:16px;}
.cart-item{display:flex;gap:12px;padding:14px 0;border-bottom:1px solid var(--border);}
.cart-item:last-child{border-bottom:none;}
.cart-item .thumb{width:56px;height:56px;border-radius:10px;background:#eef2ef;display:flex;align-items:center;justify-content:center;font-size:1.5rem;overflow:hidden;flex-shrink:0;}
.cart-item .thumb img{width:100%;height:100%;object-fit:cover;}
.cart-item .info{flex:1;min-width:0;}
.cart-item .info h4{font-size:.92rem;font-weight:600;}
.cart-item .info .unit{font-size:.8rem;color:var(--text-soft);}
.qty{display:flex;align-items:center;gap:8px;}
.qty button{width:28px;height:28px;border-radius:8px;background:#eef2ef;font-weight:700;font-size:1rem;display:flex;align-items:center;justify-content:center;}
.qty button:hover{background:var(--primary-soft);color:var(--primary);}
.qty span{min-width:20px;text-align:center;font-weight:600;}
.summary-row{display:flex;justify-content:space-between;padding:7px 0;font-size:.9rem;color:var(--text-soft);}
.summary-row.total{font-size:1.15rem;font-weight:800;color:var(--text);border-top:1px solid var(--border);margin-top:8px;padding-top:14px;}

/* ---------- Forms ---------- */
.field{margin-bottom:14px;}
.field label{display:block;font-size:.82rem;font-weight:600;color:var(--text-soft);margin-bottom:6px;}
.field input,.field textarea,.field select{width:100%;padding:11px 13px;border-radius:var(--radius-sm);
  border:1px solid var(--border);background:var(--bg-soft);font-size:.92rem;color:var(--text);transition:var(--t);outline:none;}
.field input:focus,.field textarea:focus,.field select:focus{border-color:var(--primary);box-shadow:0 0 0 3px rgba(22,163,74,.12);}
.field textarea{resize:vertical;min-height:70px;}
.row-2{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.pay-methods{display:grid;gap:10px;}
.pay-opt{display:flex;align-items:center;gap:12px;padding:13px;border:1px solid var(--border);border-radius:var(--radius-sm);cursor:pointer;transition:var(--t);}
.pay-opt:hover{border-color:var(--primary);}
.pay-opt.selected{border-color:var(--primary);background:var(--primary-soft);}
.pay-opt .ico{font-size:1.4rem;}
.pay-opt .txt strong{display:block;font-size:.9rem;}
.pay-opt .txt small{color:var(--text-soft);font-size:.78rem;}
.pay-opt input{margin-left:auto;}

/* ---------- Auth ---------- */
.auth-wrap{display:flex;align-items:center;justify-content:center;min-height:calc(100vh - var(--header-h) - 60px);padding:20px;}
.auth-card{width:100%;max-width:410px;background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-lg);padding:34px;box-shadow:var(--shadow);}
.auth-card h2{font-size:1.4rem;font-weight:800;text-align:center;margin-bottom:4px;}
.auth-card .sub{text-align:center;color:var(--text-soft);font-size:.88rem;margin-bottom:22px;}
.btn-google{width:100%;padding:11px;border-radius:var(--radius-sm);font-weight:600;font-size:.9rem;background:#fff;
  border:1px solid var(--border);display:flex;align-items:center;justify-content:center;gap:10px;margin-bottom:14px;transition:var(--t);}
.btn-google:hover{background:#f5f7f5;}
.btn-google svg{width:18px;height:18px;}
.divider{display:flex;align-items:center;gap:12px;margin:16px 0;color:var(--text-mut);font-size:.78rem;}
.divider::before,.divider::after{content:'';flex:1;height:1px;background:var(--border);}
.auth-foot{text-align:center;margin-top:16px;font-size:.85rem;color:var(--text-soft);}
.auth-foot a{color:var(--primary);font-weight:600;cursor:pointer;}
.form-error{padding:10px 13px;border-radius:var(--radius-sm);background:var(--danger-soft);color:var(--danger);font-size:.82rem;margin-bottom:14px;display:none;}

/* ---------- Orders ---------- */
.order-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px;margin-bottom:14px;box-shadow:var(--shadow-sm);}
.order-head{display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;margin-bottom:10px;}
.order-id{font-family:var(--mono);font-size:.82rem;color:var(--text-soft);}
.order-items{font-size:.86rem;color:var(--text-soft);margin:8px 0;}
.status{display:inline-flex;align-items:center;gap:6px;padding:5px 12px;border-radius:20px;font-size:.76rem;font-weight:700;}
.st-novo{background:#fff4e0;color:#b45309;}
.st-confirmado{background:#e0f0ff;color:#1d4ed8;}
.st-preparando{background:#f3e8ff;color:#7c3aed;}
.st-saiu{background:#e9f7ef;color:#128a3e;}
.st-entregue{background:#e6f4ea;color:#166534;}
.st-cancelado{background:var(--danger-soft);color:var(--danger);}

/* ---------- Admin ---------- */
.admin-tabs{display:flex;gap:6px;background:#eef2ef;padding:5px;border-radius:12px;margin-bottom:22px;width:fit-content;}
.admin-tab{padding:9px 20px;border-radius:9px;font-size:.86rem;font-weight:600;color:var(--text-soft);transition:var(--t);}
.admin-tab.active{background:var(--surface);color:var(--primary);box-shadow:var(--shadow-sm);}
.stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:14px;margin-bottom:24px;}
.stat{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px;box-shadow:var(--shadow-sm);}
.stat .n{font-size:1.7rem;font-weight:800;color:var(--primary);}
.stat .l{font-size:.82rem;color:var(--text-soft);}
.admin-order{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:18px;margin-bottom:14px;box-shadow:var(--shadow-sm);}
.admin-order.st-new{border-left:4px solid var(--warn);}
table.simple{width:100%;border-collapse:collapse;font-size:.88rem;}
table.simple th,table.simple td{text-align:left;padding:11px 10px;border-bottom:1px solid var(--border);}
table.simple th{font-size:.76rem;text-transform:uppercase;letter-spacing:.04em;color:var(--text-mut);}
.prod-admin-img{width:44px;height:44px;border-radius:9px;object-fit:cover;background:#eef2ef;display:flex;align-items:center;justify-content:center;}

.empty{text-align:center;padding:60px 20px;color:var(--text-soft);}
.empty .ico{font-size:3rem;margin-bottom:12px;opacity:.5;}
.empty h3{font-size:1.1rem;color:var(--text);margin-bottom:6px;}

/* ---------- Pix box ---------- */
.pix-box{text-align:center;}
.pix-box img{margin:0 auto 16px;border:1px solid var(--border);border-radius:12px;padding:8px;background:#fff;}
.pix-code{display:flex;gap:8px;align-items:center;background:#eef2ef;border-radius:var(--radius-sm);padding:10px;margin-top:8px;}
.pix-code input{flex:1;border:none;background:transparent;font-family:var(--mono);font-size:.72rem;color:var(--text-soft);outline:none;}

/* ---------- Modal / Toast ---------- */
.modal-bg{position:fixed;inset:0;background:rgba(20,32,26,.5);backdrop-filter:blur(3px);z-index:200;display:none;align-items:center;justify-content:center;padding:20px;}
.modal-bg.active{display:flex;}
.modal{width:100%;max-width:460px;background:var(--surface);border-radius:var(--radius-lg);padding:26px;box-shadow:var(--shadow-lg);position:relative;max-height:90vh;overflow-y:auto;animation:fade .25s ease;}
.modal h2{font-size:1.2rem;font-weight:800;margin-bottom:18px;}
.modal-close{position:absolute;top:16px;right:18px;font-size:1.2rem;color:var(--text-mut);cursor:pointer;}
.toast-wrap{position:fixed;top:78px;right:20px;z-index:300;display:flex;flex-direction:column;gap:8px;}
.toast{padding:12px 18px;border-radius:var(--radius-sm);background:var(--surface);box-shadow:var(--shadow-lg);font-size:.86rem;font-weight:500;
  display:flex;align-items:center;gap:8px;border-left:4px solid var(--primary);animation:slideIn .3s ease;}
.toast.error{border-left-color:var(--danger);}
.toast.warn{border-left-color:var(--warn);}
@keyframes slideIn{from{transform:translateX(90px);opacity:0}to{transform:translateX(0);opacity:1}}

.loader{display:inline-block;width:18px;height:18px;border:2px solid rgba(255,255,255,.35);border-top-color:#fff;border-radius:50%;animation:spin .6s linear infinite;}
.page-load{display:flex;align-items:center;justify-content:center;gap:10px;padding:60px;color:var(--text-soft);}
.page-load .loader{border-color:#dde4df;border-top-color:var(--primary);}
@keyframes spin{to{transform:rotate(360deg)}}

/* ---------- Responsive ---------- */
@media(max-width:820px){
  .two-col{grid-template-columns:1fr;}
  .nav{display:none;position:fixed;top:var(--header-h);left:0;width:100%;flex-direction:column;align-items:stretch;
    background:var(--surface);border-bottom:1px solid var(--border);padding:12px;gap:4px;}
  .nav.open{display:flex;}
  .menu-toggle{display:flex;}
  .store-hero h1{font-size:1.5rem;}
  .row-2{grid-template-columns:1fr;}
}
</style>
</head>
<body>

<div class="toast-wrap" id="toasts"></div>

<!-- ========== HEADER ========== -->
<header class="header">
  <div class="header-inner">
    <div class="brand" onclick="go('loja')">
      <div class="logo">🥥</div>
      <span class="name">Sabor Tropical</span>
    </div>
    <nav class="nav" id="nav">
      <button class="navlink" data-nav="loja" onclick="go('loja')">Cardápio</button>
      <button class="navlink" data-nav="meus-pedidos" onclick="go('meus-pedidos')">Meus Pedidos</button>
      <button class="navlink hidden" id="nav-admin" data-nav="admin" onclick="go('admin')">🛠️ Admin</button>
    </nav>
    <div class="header-actions">
      <button class="cart-btn" onclick="go('carrinho')" title="Carrinho">
        🛒<span class="cart-count hidden" id="cart-count">0</span>
      </button>
      <div id="auth-guest">
        <button class="btn btn-primary btn-sm" onclick="go('login')">Entrar</button>
      </div>
      <div id="auth-user" class="user-chip hidden">
        <div class="avatar" id="avatar">?</div>
        <button class="btn-ghost btn-sm" onclick="handleLogout()">Sair</button>
      </div>
      <button class="menu-toggle" onclick="document.getElementById('nav').classList.toggle('open')">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</header>

<!-- ========== LOJA / CARDÁPIO ========== -->
<section class="screen active" id="screen-loja">
  <div class="container">
    <div class="store-hero">
      <h1>Peça o seu 🥥</h1>
      <p>Cardápio fresquinho, pagamento por Pix na hora e entrega rápida. Monte seu pedido e acompanhe em tempo real.</p>
      <div class="badges">
        <span class="badge">⚡ Entrega rápida</span>
        <span class="badge">💚 Pix instantâneo</span>
        <span class="badge">📍 Acompanhe o pedido</span>
      </div>
    </div>
    <div class="cat-bar" id="cat-bar"></div>
    <div id="menu-content">
      <div class="page-load"><span class="loader"></span> Carregando cardápio...</div>
    </div>
  </div>
</section>

<!-- ========== CARRINHO ========== -->
<section class="screen" id="screen-carrinho">
  <div class="container">
    <h1 style="font-size:1.6rem;font-weight:800;margin-bottom:20px;">Seu carrinho 🛒</h1>
    <div class="two-col">
      <div class="card">
        <h2>Itens</h2>
        <div id="cart-items"></div>
      </div>
      <div class="card">
        <h2>Resumo</h2>
        <div id="cart-summary"></div>
        <button class="btn btn-primary btn-block" style="margin-top:16px;" id="btn-checkout" onclick="irCheckout()">Finalizar pedido →</button>
        <button class="btn btn-ghost btn-block" style="margin-top:8px;" onclick="go('loja')">Continuar comprando</button>
      </div>
    </div>
  </div>
</section>

<!-- ========== CHECKOUT ========== -->
<section class="screen" id="screen-checkout">
  <div class="container">
    <h1 style="font-size:1.6rem;font-weight:800;margin-bottom:20px;">Finalizar pedido</h1>
    <div class="two-col">
      <div class="card">
        <h2>Seus dados e entrega</h2>
        <div class="field"><label>Nome completo</label><input type="text" id="co-name"></div>
        <div class="row-2">
          <div class="field"><label>WhatsApp / Telefone</label><input type="tel" id="co-phone" placeholder="(11) 90000-0000"></div>
          <div class="field"><label>Bairro</label><input type="text" id="co-bairro"></div>
        </div>
        <div class="field"><label>Endereço (rua, número, complemento)</label><input type="text" id="co-address" placeholder="Rua Exemplo, 123 - Apto 4"></div>
        <div class="field"><label>Observações (opcional)</label><textarea id="co-notes" placeholder="Ex: sem cebola, troco para R$50..."></textarea></div>

        <h2 style="margin-top:8px;">Forma de pagamento</h2>
        <div class="pay-methods" id="pay-methods">
          <label class="pay-opt selected" data-pay="pix">
            <span class="ico">💠</span>
            <span class="txt"><strong>Pix</strong><small>Copia-e-cola e QR Code na hora</small></span>
            <input type="radio" name="pay" value="pix" checked>
          </label>
          <label class="pay-opt" data-pay="cartao_entrega">
            <span class="ico">💳</span>
            <span class="txt"><strong>Cartão na entrega</strong><small>Crédito/débito na maquininha</small></span>
            <input type="radio" name="pay" value="cartao_entrega">
          </label>
          <label class="pay-opt" data-pay="dinheiro">
            <span class="ico">💵</span>
            <span class="txt"><strong>Dinheiro</strong><small>Pague na entrega</small></span>
            <input type="radio" name="pay" value="dinheiro">
          </label>
        </div>
      </div>
      <div class="card">
        <h2>Resumo do pedido</h2>
        <div id="checkout-summary"></div>
        <button class="btn btn-primary btn-block" style="margin-top:16px;" id="btn-confirm" onclick="confirmarPedido()">Confirmar pedido</button>
        <button class="btn btn-ghost btn-block" style="margin-top:8px;" onclick="go('carrinho')">Voltar</button>
      </div>
    </div>
  </div>
</section>

<!-- ========== PEDIDO CONFIRMADO ========== -->
<section class="screen" id="screen-sucesso">
  <div class="container" style="max-width:560px;">
    <div class="card" style="text-align:center;">
      <div style="font-size:3.4rem;margin-bottom:8px;">✅</div>
      <h2 style="font-size:1.4rem;">Pedido enviado!</h2>
      <p class="muted" style="margin-bottom:6px;">Seu pedido <span class="mono" id="sucesso-id"></span> foi recebido e já aparece para a loja.</p>
      <div id="sucesso-pix"></div>
      <div style="display:flex;gap:10px;flex-direction:column;margin-top:18px;">
        <button class="btn btn-accent btn-block" id="btn-whats" onclick="enviarWhatsApp()">📱 Avisar a loja pelo WhatsApp</button>
        <button class="btn btn-outline btn-block" onclick="go('meus-pedidos')">Acompanhar meus pedidos</button>
        <button class="btn btn-ghost btn-block" onclick="go('loja')">Fazer novo pedido</button>
      </div>
    </div>
  </div>
</section>

<!-- ========== MEUS PEDIDOS ========== -->
<section class="screen" id="screen-meus-pedidos">
  <div class="container" style="max-width:720px;">
    <h1 style="font-size:1.6rem;font-weight:800;margin-bottom:20px;">Meus pedidos</h1>
    <div id="my-orders"><div class="page-load"><span class="loader"></span> Carregando...</div></div>
  </div>
</section>

<!-- ========== LOGIN ========== -->
<section class="screen" id="screen-login">
  <div class="auth-wrap">
    <div class="auth-card">
      <h2>Bem-vindo 👋</h2>
      <p class="sub">Entre para fazer e acompanhar pedidos</p>
      <div class="form-error" id="login-err"></div>
      <button class="btn-google" onclick="handleGoogle()">
        <svg viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
        Continuar com Google
      </button>
      <div class="divider">ou</div>
      <form onsubmit="handleEmailLogin(event)">
        <div class="field"><label>E-mail</label><input type="email" id="login-email" placeholder="seu@email.com" required></div>
        <div class="field"><label>Senha</label><input type="password" id="login-pass" placeholder="••••••••" required></div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
      </form>
      <p class="auth-foot">Não tem conta? <a onclick="go('cadastro')">Criar conta</a></p>
    </div>
  </div>
</section>

<!-- ========== CADASTRO ========== -->
<section class="screen" id="screen-cadastro">
  <div class="auth-wrap">
    <div class="auth-card">
      <h2>Criar conta ✨</h2>
      <p class="sub">Rápido: peça em segundos</p>
      <div class="form-error" id="reg-err"></div>
      <button class="btn-google" onclick="handleGoogle()">
        <svg viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
        Continuar com Google
      </button>
      <div class="divider">ou</div>
      <form onsubmit="handleEmailRegister(event)">
        <div class="field"><label>Nome</label><input type="text" id="reg-name" placeholder="Seu nome" required></div>
        <div class="field"><label>WhatsApp</label><input type="tel" id="reg-phone" placeholder="(11) 90000-0000"></div>
        <div class="field"><label>E-mail</label><input type="email" id="reg-email" placeholder="seu@email.com" required></div>
        <div class="field"><label>Senha</label><input type="password" id="reg-pass" placeholder="Mínimo 6 caracteres" minlength="6" required></div>
        <button type="submit" class="btn btn-primary btn-block">Criar conta</button>
      </form>
      <p class="auth-foot">Já tem conta? <a onclick="go('login')">Entrar</a></p>
    </div>
  </div>
</section>

<!-- ========== ADMIN ========== -->
<section class="screen" id="screen-admin">
  <div class="container">
    <h1 style="font-size:1.6rem;font-weight:800;margin-bottom:6px;">Painel do Administrador 🛠️</h1>
    <p class="muted" style="margin-bottom:20px;">Receba pedidos em tempo real, gerencie o cardápio e veja seus clientes.</p>
    <div class="admin-tabs">
      <button class="admin-tab active" data-tab="pedidos" onclick="adminTab('pedidos')">📥 Pedidos</button>
      <button class="admin-tab" data-tab="produtos" onclick="adminTab('produtos')">🍽️ Cardápio</button>
      <button class="admin-tab" data-tab="clientes" onclick="adminTab('clientes')">👥 Clientes</button>
    </div>

    <div id="admin-pedidos">
      <div class="stat-grid" id="admin-stats"></div>
      <div id="admin-orders-list"><div class="page-load"><span class="loader"></span> Carregando pedidos...</div></div>
    </div>

    <div id="admin-produtos" class="hidden">
      <button class="btn btn-primary" style="margin-bottom:18px;" onclick="abrirProdutoModal()">+ Novo produto</button>
      <div class="card"><div id="admin-products-list"></div></div>
    </div>

    <div id="admin-clientes" class="hidden">
      <div class="card"><div id="admin-clients-list"></div></div>
    </div>
  </div>
</section>

<!-- ========== MODAL: Produto (admin) ========== -->
<div class="modal-bg" id="modal-produto">
  <div class="modal">
    <span class="modal-close" onclick="fecharModal('modal-produto')">✕</span>
    <h2 id="produto-modal-title">Novo produto</h2>
    <input type="hidden" id="prod-id">
    <div class="field"><label>Nome</label><input type="text" id="prod-name" placeholder="Ex: Açaí 500ml"></div>
    <div class="field"><label>Descrição</label><textarea id="prod-desc" placeholder="Ingredientes, tamanho..."></textarea></div>
    <div class="row-2">
      <div class="field"><label>Preço (R$)</label><input type="number" id="prod-price" step="0.01" min="0" placeholder="19.90"></div>
      <div class="field"><label>Categoria</label><input type="text" id="prod-cat" placeholder="Ex: Açaí, Bebidas..." list="cat-list"><datalist id="cat-list"></datalist></div>
    </div>
    <div class="field"><label>URL da imagem (opcional)</label><input type="url" id="prod-img" placeholder="https://..."></div>
    <label class="pay-opt" style="cursor:pointer;">
      <span class="ico">✅</span>
      <span class="txt"><strong>Disponível</strong><small>Aparece no cardápio para os clientes</small></span>
      <input type="checkbox" id="prod-avail" checked style="margin-left:auto;">
    </label>
    <button class="btn btn-primary btn-block" style="margin-top:16px;" id="btn-save-prod" onclick="salvarProduto()">Salvar produto</button>
  </div>
</div>

<!-- ========== FIREBASE + APP ========== -->
<script type="module">
import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js';
import {
  getAuth, onAuthStateChanged, signInWithEmailAndPassword,
  createUserWithEmailAndPassword, signInWithPopup, GoogleAuthProvider,
  signOut, updateProfile
} from 'https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js';
import {
  getFirestore, collection, doc, addDoc, setDoc, getDoc, getDocs,
  updateDoc, deleteDoc, query, where, orderBy, onSnapshot, serverTimestamp
} from 'https://www.gstatic.com/firebasejs/10.12.0/firebase-firestore.js';

/* ============================================
   CONFIGURAÇÃO DA LOJA  — edite aqui
   ============================================ */
const LOJA = {
  nome: "Sabor Tropical",
  cidade: "SAO PAULO",                          // Pix: sem acento, MAIÚSCULO, até 15 chars
  chavePix: "professorrodrigoneris@gmail.com",  // sua chave Pix (recebe os pagamentos)
  whatsapp: "5511999999999",                    // DDI+DDD+número, só dígitos
  taxaEntrega: 5.00,
};

// Quem pode acessar o painel admin (e-mails):
const ADMIN_EMAILS = ["professorrodrigoneris@gmail.com"];

/* ============================================
   FIREBASE CONFIG
   (já preenchido com o projeto DevSpace — troque
    se quiser um projeto Firebase só para a loja.
    Veja o passo a passo em COMO-CRIAR-BANCO.md)
   ============================================ */
const firebaseConfig = {
  apiKey: "AIzaSyAcoLvo0DEAxncvVgFW5zSXsWfgWJokoo8",
  authDomain: "devspace-88a0c.firebaseapp.com",
  projectId: "devspace-88a0c",
  storageBucket: "devspace-88a0c.firebasestorage.app",
  messagingSenderId: "1093629344759",
  appId: "1:1093629344759:web:ab4ba4ade64bd6ddc38cf2"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);
const googleProvider = new GoogleAuthProvider();

/* ============================================
   ESTADO
   ============================================ */
let currentUser = null;
let isAdmin = false;
let products = [];
let cart = JSON.parse(localStorage.getItem('pedido_cart') || '[]');
let activeCategory = 'todos';
let lastOrder = null;
let unsubProducts = null, unsubMyOrders = null, unsubAdminOrders = null;

/* ============================================
   NAVEGAÇÃO
   ============================================ */
function go(screen) {
  const authScreens = ['meus-pedidos','admin'];
  if (authScreens.includes(screen) && !currentUser) screen = 'login';
  if (screen === 'admin' && !isAdmin) { toast('Acesso restrito ao administrador','error'); screen = 'loja'; }

  document.querySelectorAll('.screen').forEach(s => s.classList.remove('active'));
  const el = document.getElementById('screen-' + screen);
  if (el) { el.classList.add('active'); window.scrollTo(0,0); }
  document.getElementById('nav').classList.remove('open');
  document.querySelectorAll('.nav .navlink').forEach(b =>
    b.classList.toggle('active', b.dataset.nav === screen));

  if (screen === 'carrinho') renderCart();
  if (screen === 'checkout') renderCheckout();
  if (screen === 'meus-pedidos') loadMyOrders();
  if (screen === 'admin') { loadAdminOrders(); loadClients(); }
  window.location.hash = screen;
}
window.go = go;
window.addEventListener('hashchange', () => {
  const h = window.location.hash.replace('#','');
  if (h && document.getElementById('screen-' + h)) go(h);
});

/* ============================================
   AUTH
   ============================================ */
onAuthStateChanged(auth, async (user) => {
  currentUser = user;
  isAdmin = !!user && ADMIN_EMAILS.includes((user.email||'').toLowerCase());
  updateAuthUI();
  if (user) {
    // garante doc do usuário
    try {
      const uref = doc(db,'clientes',user.uid);
      const snap = await getDoc(uref);
      if (!snap.exists()) {
        await setDoc(uref, {
          nome: user.displayName || (user.email||'').split('@')[0],
          email: user.email || '', telefone: '',
          role: isAdmin ? 'admin' : 'cliente', criadoEm: serverTimestamp()
        });
      }
    } catch(e){ console.warn(e); }
    const h = window.location.hash.replace('#','');
    if (!h || h==='login' || h==='cadastro') go('loja'); else go(h);
  } else {
    const h = window.location.hash.replace('#','');
    if (['meus-pedidos','admin'].includes(h)) go('loja');
  }
});

function updateAuthUI() {
  document.getElementById('auth-guest').classList.toggle('hidden', !!currentUser);
  document.getElementById('auth-user').classList.toggle('hidden', !currentUser);
  document.getElementById('nav-admin').classList.toggle('hidden', !isAdmin);
  if (currentUser) {
    const nm = currentUser.displayName || currentUser.email || '?';
    document.getElementById('avatar').textContent = nm.charAt(0).toUpperCase();
  }
}

window.handleEmailLogin = async (e) => {
  e.preventDefault();
  const err = document.getElementById('login-err'); err.style.display='none';
  try {
    await signInWithEmailAndPassword(auth,
      document.getElementById('login-email').value.trim(),
      document.getElementById('login-pass').value);
    toast('Bem-vindo de volta!');
  } catch(ex){ err.textContent = authMsg(ex); err.style.display='block'; }
};

window.handleEmailRegister = async (e) => {
  e.preventDefault();
  const err = document.getElementById('reg-err'); err.style.display='none';
  try {
    const cred = await createUserWithEmailAndPassword(auth,
      document.getElementById('reg-email').value.trim(),
      document.getElementById('reg-pass').value);
    const nome = document.getElementById('reg-name').value.trim();
    await updateProfile(cred.user, { displayName: nome });
    await setDoc(doc(db,'clientes',cred.user.uid), {
      nome, email: cred.user.email, telefone: document.getElementById('reg-phone').value.trim(),
      role: ADMIN_EMAILS.includes(cred.user.email.toLowerCase())?'admin':'cliente', criadoEm: serverTimestamp()
    });
    toast('Conta criada com sucesso!');
  } catch(ex){ err.textContent = authMsg(ex); err.style.display='block'; }
};

window.handleGoogle = async () => {
  try { await signInWithPopup(auth, googleProvider); toast('Login realizado!'); }
  catch(ex){ toast(authMsg(ex),'error'); }
};

window.handleLogout = async () => { await signOut(auth); toast('Você saiu.'); go('loja'); };

function authMsg(ex){
  const m = (ex && ex.code) || '';
  if (m.includes('invalid-credential')||m.includes('wrong-password')||m.includes('user-not-found')) return 'E-mail ou senha incorretos.';
  if (m.includes('email-already-in-use')) return 'Este e-mail já está cadastrado.';
  if (m.includes('weak-password')) return 'Senha muito fraca (mínimo 6 caracteres).';
  if (m.includes('invalid-email')) return 'E-mail inválido.';
  if (m.includes('popup-closed')) return 'Login cancelado.';
  return 'Erro: ' + (ex.message||m);
}

/* ============================================
   PRODUTOS (cardápio) — tempo real
   ============================================ */
function watchProducts(){
  if (unsubProducts) return;
  unsubProducts = onSnapshot(query(collection(db,'produtos'), orderBy('categoria')), (snap) => {
    products = snap.docs.map(d => ({ id:d.id, ...d.data() }));
    renderMenu();
    if (isAdmin) renderAdminProducts();
    fillCategorias();
  }, (e)=>{ document.getElementById('menu-content').innerHTML =
    `<div class="empty"><div class="ico">⚠️</div><h3>Não foi possível carregar o cardápio</h3><p>${escapeHtml(e.message)}</p></div>`; });
}

function categorias(){ return [...new Set(products.map(p=>p.categoria||'Outros'))]; }

function fillCategorias(){
  const bar = document.getElementById('cat-bar');
  const cats = categorias();
  bar.innerHTML = `<button class="cat-chip ${activeCategory==='todos'?'active':''}" onclick="filtrarCat('todos')">Tudo</button>` +
    cats.map(c=>`<button class="cat-chip ${activeCategory===c?'active':''}" onclick="filtrarCat('${escapeAttr(c)}')">${escapeHtml(c)}</button>`).join('');
  // datalist do modal
  document.getElementById('cat-list').innerHTML = cats.map(c=>`<option value="${escapeAttr(c)}">`).join('');
}
window.filtrarCat = (c)=>{ activeCategory=c; fillCategorias(); renderMenu(); };

function renderMenu(){
  const box = document.getElementById('menu-content');
  let list = products.filter(p => isAdmin ? true : p.disponivel !== false);
  if (activeCategory!=='todos') list = list.filter(p=>(p.categoria||'Outros')===activeCategory);
  if (!list.length){
    box.innerHTML = `<div class="empty"><div class="ico">🍽️</div><h3>Cardápio vazio</h3>
      <p>${isAdmin?'Adicione produtos no painel Admin → Cardápio.':'Volte em breve, estamos preparando novidades!'}</p></div>`;
    return;
  }
  const grupos = {};
  list.forEach(p=>{ const c=p.categoria||'Outros'; (grupos[c]=grupos[c]||[]).push(p); });
  box.innerHTML = Object.entries(grupos).map(([cat,items])=>`
    <div class="cat-group">
      <h2>${escapeHtml(cat)}</h2>
      <div class="menu-grid">
        ${items.map(p=>cardProduto(p)).join('')}
      </div>
    </div>`).join('');
}

function cardProduto(p){
  const indisp = p.disponivel===false;
  return `<div class="product ${indisp?'unavailable':''}">
    <div class="product-img">
      ${indisp?'<span class="product-tag">Indisponível</span>':''}
      ${p.imagem?`<img src="${escapeAttr(p.imagem)}" alt="${escapeAttr(p.nome)}" onerror="this.style.display='none';this.parentNode.innerHTML+='🍽️'">`:'🍽️'}
    </div>
    <div class="product-body">
      <h3>${escapeHtml(p.nome)}</h3>
      <p class="desc">${escapeHtml(p.descricao||'')}</p>
      <div class="product-foot">
        <span class="price">${money(p.preco)}</span>
        ${indisp?'<span class="muted" style="font-size:.82rem;">Esgotado</span>':
          `<button class="btn btn-primary btn-sm" onclick="addCart('${p.id}')">Adicionar +</button>`}
      </div>
    </div>
  </div>`;
}

/* ============================================
   CARRINHO
   ============================================ */
function saveCart(){ localStorage.setItem('pedido_cart', JSON.stringify(cart)); updateCartCount(); }
function updateCartCount(){
  const n = cart.reduce((s,i)=>s+i.qty,0);
  const el = document.getElementById('cart-count');
  el.textContent = n; el.classList.toggle('hidden', n===0);
}
window.addCart = (id)=>{
  const p = products.find(x=>x.id===id); if(!p) return;
  const ex = cart.find(i=>i.id===id);
  if (ex) ex.qty++; else cart.push({ id, nome:p.nome, preco:p.preco, imagem:p.imagem||'', qty:1 });
  saveCart(); toast(`${p.nome} adicionado 🛒`);
};
window.mudarQty = (id,d)=>{
  const it = cart.find(i=>i.id===id); if(!it) return;
  it.qty += d; if (it.qty<=0) cart = cart.filter(i=>i.id!==id);
  saveCart(); renderCart();
};
window.removerItem = (id)=>{ cart = cart.filter(i=>i.id!==id); saveCart(); renderCart(); };

function subtotal(){ return cart.reduce((s,i)=>s+i.preco*i.qty,0); }

function renderCart(){
  const box = document.getElementById('cart-items');
  const sum = document.getElementById('cart-summary');
  document.getElementById('btn-checkout').disabled = cart.length===0;
  if (!cart.length){
    box.innerHTML = `<div class="empty"><div class="ico">🛒</div><h3>Carrinho vazio</h3><p>Adicione itens do cardápio.</p></div>`;
    sum.innerHTML=''; return;
  }
  box.innerHTML = cart.map(i=>`
    <div class="cart-item">
      <div class="thumb">${i.imagem?`<img src="${escapeAttr(i.imagem)}" onerror="this.replaceWith('🍽️')">`:'🍽️'}</div>
      <div class="info">
        <h4>${escapeHtml(i.nome)}</h4>
        <div class="unit">${money(i.preco)} cada</div>
        <div class="qty" style="margin-top:6px;">
          <button onclick="mudarQty('${i.id}',-1)">−</button>
          <span>${i.qty}</span>
          <button onclick="mudarQty('${i.id}',1)">+</button>
          <button class="btn-ghost btn-sm" style="margin-left:6px;" onclick="removerItem('${i.id}')">Remover</button>
        </div>
      </div>
      <div style="font-weight:700;">${money(i.preco*i.qty)}</div>
    </div>`).join('');
  const sub = subtotal();
  sum.innerHTML = `
    <div class="summary-row"><span>Subtotal</span><span>${money(sub)}</span></div>
    <div class="summary-row"><span>Entrega</span><span>${money(LOJA.taxaEntrega)}</span></div>
    <div class="summary-row total"><span>Total</span><span>${money(sub+LOJA.taxaEntrega)}</span></div>`;
}

window.irCheckout = ()=>{ if(!cart.length){toast('Seu carrinho está vazio','warn');return;} go('checkout'); };

/* ============================================
   CHECKOUT
   ============================================ */
document.querySelectorAll('.pay-opt[data-pay]').forEach(opt=>{
  opt.addEventListener('click',()=>{
    document.querySelectorAll('.pay-opt[data-pay]').forEach(o=>o.classList.remove('selected'));
    opt.classList.add('selected'); opt.querySelector('input').checked=true;
  });
});

function renderCheckout(){
  if (!cart.length){ go('carrinho'); return; }
  if (currentUser){
    document.getElementById('co-name').value = document.getElementById('co-name').value || (currentUser.displayName||'');
  }
  const sub = subtotal();
  document.getElementById('checkout-summary').innerHTML =
    cart.map(i=>`<div class="summary-row"><span>${i.qty}× ${escapeHtml(i.nome)}</span><span>${money(i.preco*i.qty)}</span></div>`).join('') +
    `<div class="summary-row"><span>Entrega</span><span>${money(LOJA.taxaEntrega)}</span></div>
     <div class="summary-row total"><span>Total</span><span>${money(sub+LOJA.taxaEntrega)}</span></div>`;
}

window.confirmarPedido = async ()=>{
  if (!currentUser){ toast('Faça login para finalizar o pedido','warn'); go('login'); return; }
  const nome = document.getElementById('co-name').value.trim();
  const phone = document.getElementById('co-phone').value.trim();
  const address = document.getElementById('co-address').value.trim();
  const bairro = document.getElementById('co-bairro').value.trim();
  const notes = document.getElementById('co-notes').value.trim();
  const pay = document.querySelector('input[name="pay"]:checked').value;
  if (!nome || !phone || !address){ toast('Preencha nome, telefone e endereço','warn'); return; }

  const btn = document.getElementById('btn-confirm');
  btn.disabled=true; btn.innerHTML='<span class="loader"></span> Enviando...';
  const total = subtotal() + LOJA.taxaEntrega;
  const pedido = {
    userId: currentUser.uid,
    cliente: { nome, telefone: phone, endereco: address, bairro },
    itens: cart.map(i=>({ id:i.id, nome:i.nome, preco:i.preco, qty:i.qty })),
    subtotal: subtotal(), taxaEntrega: LOJA.taxaEntrega, total,
    pagamento: pay, observacoes: notes,
    status: 'novo', criadoEm: serverTimestamp()
  };
  try {
    const ref = await addDoc(collection(db,'pedidos'), pedido);
    lastOrder = { id: ref.id, ...pedido };
    cart = []; saveCart();
    mostrarSucesso();
    toast('Pedido enviado com sucesso! 🎉');
  } catch(ex){
    toast('Erro ao enviar: '+ex.message,'error');
  } finally {
    btn.disabled=false; btn.innerHTML='Confirmar pedido';
  }
};

function mostrarSucesso(){
  document.getElementById('sucesso-id').textContent = '#'+lastOrder.id.slice(-6).toUpperCase();
  const pixBox = document.getElementById('sucesso-pix');
  if (lastOrder.pagamento==='pix'){
    const txid = lastOrder.id.slice(-20).replace(/[^a-zA-Z0-9]/g,'');
    const code = gerarPix({ chave:LOJA.chavePix, nome:LOJA.nome, cidade:LOJA.cidade, valor:lastOrder.total, txid });
    pixBox.innerHTML = `
      <div class="pix-box" style="margin-top:18px;">
        <p style="font-weight:700;margin-bottom:6px;">Pague ${money(lastOrder.total)} via Pix</p>
        <p class="muted" style="font-size:.82rem;margin-bottom:12px;">Escaneie o QR ou copie o código</p>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${encodeURIComponent(code)}" width="200" height="200" alt="QR Pix">
        <div class="pix-code">
          <input id="pix-input" readonly value="${escapeAttr(code)}">
          <button class="btn btn-primary btn-sm" onclick="copiarPix()">Copiar</button>
        </div>
      </div>`;
  } else {
    const label = lastOrder.pagamento==='cartao_entrega' ? 'Cartão na entrega (maquininha)' : 'Dinheiro na entrega';
    pixBox.innerHTML = `<p class="muted" style="margin-top:14px;">Pagamento: <strong>${label}</strong> — ${money(lastOrder.total)}</p>`;
  }
  go('sucesso');
}
window.copiarPix = ()=>{
  const inp = document.getElementById('pix-input'); inp.select();
  navigator.clipboard.writeText(inp.value).then(()=>toast('Código Pix copiado!'));
};

window.enviarWhatsApp = ()=>{
  if(!lastOrder) return;
  const linhas = lastOrder.itens.map(i=>`• ${i.qty}× ${i.nome} — ${money(i.preco*i.qty)}`).join('%0A');
  const pag = {pix:'Pix',cartao_entrega:'Cartão na entrega',dinheiro:'Dinheiro'}[lastOrder.pagamento];
  const msg =
`*Novo pedido ${'#'+lastOrder.id.slice(-6).toUpperCase()}*%0A%0A`+
`*Cliente:* ${lastOrder.cliente.nome}%0A`+
`*Telefone:* ${lastOrder.cliente.telefone}%0A`+
`*Endereço:* ${lastOrder.cliente.endereco} - ${lastOrder.cliente.bairro}%0A%0A`+
`${linhas}%0A%0A`+
`*Total:* ${money(lastOrder.total)}%0A`+
`*Pagamento:* ${pag}`+
(lastOrder.observacoes?`%0A*Obs:* ${lastOrder.observacoes}`:'');
  window.open(`https://wa.me/${LOJA.whatsapp}?text=${msg}`,'_blank');
};

/* ============================================
   PIX — gerador de "copia e cola" (BR Code)
   ============================================ */
function tlv(id,v){ return id + String(v.length).padStart(2,'0') + v; }
function crc16(str){
  let crc=0xFFFF;
  for (let i=0;i<str.length;i++){
    crc ^= str.charCodeAt(i)<<8;
    for (let j=0;j<8;j++) crc = (crc&0x8000)?((crc<<1)^0x1021)&0xFFFF:(crc<<1)&0xFFFF;
  }
  return crc.toString(16).toUpperCase().padStart(4,'0');
}
function semAcento(s){ return (s||'').normalize('NFD').replace(/[̀-ͯ]/g,''); }
function gerarPix({chave,nome,cidade,valor,txid}){
  nome = semAcento(nome).substring(0,25);
  cidade = semAcento(cidade).substring(0,15);
  const mai = tlv('26', tlv('00','br.gov.bcb.pix') + tlv('01', chave));
  let p = tlv('00','01') + mai + tlv('52','0000') + tlv('53','986')
    + (valor?tlv('54', Number(valor).toFixed(2)):'') + tlv('58','BR')
    + tlv('59', nome) + tlv('60', cidade) + tlv('62', tlv('05', (txid||'***').substring(0,25)));
  p += '6304';
  return p + crc16(p);
}

/* ============================================
   MEUS PEDIDOS (cliente) — tempo real
   ============================================ */
function loadMyOrders(){
  if (!currentUser) return;
  if (unsubMyOrders) unsubMyOrders();
  const box = document.getElementById('my-orders');
  const q = query(collection(db,'pedidos'), where('userId','==',currentUser.uid), orderBy('criadoEm','desc'));
  unsubMyOrders = onSnapshot(q, (snap)=>{
    if (snap.empty){ box.innerHTML = `<div class="empty"><div class="ico">📦</div><h3>Nenhum pedido ainda</h3><p>Que tal fazer o primeiro?</p><button class="btn btn-primary" style="margin-top:12px;" onclick="go('loja')">Ver cardápio</button></div>`; return; }
    box.innerHTML = snap.docs.map(d=>orderCardCliente(d.id,d.data())).join('');
  }, (e)=>{ box.innerHTML = `<div class="empty"><div class="ico">⚠️</div><h3>Erro</h3><p>${escapeHtml(e.message)}</p></div>`; });
}
function orderCardCliente(id,o){
  return `<div class="order-card">
    <div class="order-head">
      <div><div class="order-id">#${id.slice(-6).toUpperCase()}</div><strong>${money(o.total)}</strong></div>
      ${statusBadge(o.status)}
    </div>
    <div class="order-items">${(o.itens||[]).map(i=>`${i.qty}× ${escapeHtml(i.nome)}`).join(' · ')}</div>
    <div class="muted" style="font-size:.8rem;">${fmtData(o.criadoEm)} · ${pagLabel(o.pagamento)}</div>
  </div>`;
}

/* ============================================
   ADMIN
   ============================================ */
window.adminTab = (tab)=>{
  document.querySelectorAll('.admin-tab').forEach(t=>t.classList.toggle('active',t.dataset.tab===tab));
  document.getElementById('admin-pedidos').classList.toggle('hidden',tab!=='pedidos');
  document.getElementById('admin-produtos').classList.toggle('hidden',tab!=='produtos');
  document.getElementById('admin-clientes').classList.toggle('hidden',tab!=='clientes');
};

function loadAdminOrders(){
  if (!isAdmin) return;
  if (unsubAdminOrders) return;
  const box = document.getElementById('admin-orders-list');
  const q = query(collection(db,'pedidos'), orderBy('criadoEm','desc'));
  unsubAdminOrders = onSnapshot(q, (snap)=>{
    const orders = snap.docs.map(d=>({id:d.id,...d.data()}));
    renderStats(orders);
    if (!orders.length){ box.innerHTML = `<div class="empty"><div class="ico">📥</div><h3>Nenhum pedido ainda</h3><p>Os pedidos aparecem aqui em tempo real.</p></div>`; return; }
    box.innerHTML = orders.map(o=>adminOrderCard(o)).join('');
  }, (e)=>{ box.innerHTML = `<div class="empty"><div class="ico">⚠️</div><h3>Erro ao carregar</h3><p>${escapeHtml(e.message)}</p></div>`; });
}

function renderStats(orders){
  const hoje = new Date(); hoje.setHours(0,0,0,0);
  const novos = orders.filter(o=>o.status==='novo').length;
  const doDia = orders.filter(o=>o.criadoEm && o.criadoEm.toDate && o.criadoEm.toDate()>=hoje);
  const fatDia = doDia.filter(o=>o.status!=='cancelado').reduce((s,o)=>s+(o.total||0),0);
  document.getElementById('admin-stats').innerHTML = `
    <div class="stat"><div class="n">${novos}</div><div class="l">Pedidos novos</div></div>
    <div class="stat"><div class="n">${doDia.length}</div><div class="l">Pedidos hoje</div></div>
    <div class="stat"><div class="n">${money(fatDia)}</div><div class="l">Faturamento hoje</div></div>
    <div class="stat"><div class="n">${orders.length}</div><div class="l">Total de pedidos</div></div>`;
}

const STATUS = ['novo','confirmado','preparando','saiu','entregue','cancelado'];
function adminOrderCard(o){
  return `<div class="admin-order ${o.status==='novo'?'st-new':''}">
    <div class="order-head">
      <div>
        <div class="order-id">#${o.id.slice(-6).toUpperCase()} · ${fmtData(o.criadoEm)}</div>
        <strong>${escapeHtml(o.cliente?.nome||'—')}</strong> · ${escapeHtml(o.cliente?.telefone||'')}
      </div>
      ${statusBadge(o.status)}
    </div>
    <div class="order-items">
      ${(o.itens||[]).map(i=>`${i.qty}× ${escapeHtml(i.nome)}`).join(' · ')}
    </div>
    <div class="muted" style="font-size:.83rem;margin-bottom:10px;">
      📍 ${escapeHtml(o.cliente?.endereco||'')} ${o.cliente?.bairro?'- '+escapeHtml(o.cliente.bairro):''}<br>
      💳 ${pagLabel(o.pagamento)} · <strong style="color:var(--primary)">${money(o.total)}</strong>
      ${o.observacoes?`<br>📝 ${escapeHtml(o.observacoes)}`:''}
    </div>
    <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;">
      <select class="field" style="width:auto;padding:8px 10px;margin:0;" onchange="mudarStatus('${o.id}',this.value)">
        ${STATUS.map(s=>`<option value="${s}" ${o.status===s?'selected':''}>${statusLabel(s)}</option>`).join('')}
      </select>
      <a class="btn btn-outline btn-sm" href="https://wa.me/${(o.cliente?.telefone||'').replace(/\D/g,'')}" target="_blank">💬 WhatsApp</a>
    </div>
  </div>`;
}
window.mudarStatus = async (id,status)=>{
  try{ await updateDoc(doc(db,'pedidos',id),{status}); toast('Status atualizado'); }
  catch(e){ toast('Erro: '+e.message,'error'); }
};

/* ---- Admin: produtos ---- */
function renderAdminProducts(){
  const box = document.getElementById('admin-products-list');
  if (!products.length){ box.innerHTML = `<div class="empty"><div class="ico">🍽️</div><h3>Sem produtos</h3><p>Clique em "Novo produto".</p></div>`; return; }
  box.innerHTML = `<table class="simple">
    <thead><tr><th></th><th>Produto</th><th>Categoria</th><th>Preço</th><th>Status</th><th></th></tr></thead>
    <tbody>${products.map(p=>`
      <tr>
        <td><div class="prod-admin-img">${p.imagem?`<img src="${escapeAttr(p.imagem)}" style="width:44px;height:44px;border-radius:9px;object-fit:cover;" onerror="this.replaceWith('🍽️')">`:'🍽️'}</div></td>
        <td><strong>${escapeHtml(p.nome)}</strong></td>
        <td>${escapeHtml(p.categoria||'—')}</td>
        <td>${money(p.preco)}</td>
        <td>${p.disponivel===false?'<span class="status st-cancelado">Indisponível</span>':'<span class="status st-entregue">Disponível</span>'}</td>
        <td style="white-space:nowrap;">
          <button class="btn btn-ghost btn-sm" onclick="editarProduto('${p.id}')">✏️</button>
          <button class="btn btn-danger btn-sm" onclick="excluirProduto('${p.id}')">🗑️</button>
        </td>
      </tr>`).join('')}</tbody></table>`;
}
window.abrirProdutoModal = ()=>{
  document.getElementById('produto-modal-title').textContent='Novo produto';
  ['prod-id','prod-name','prod-desc','prod-price','prod-cat','prod-img'].forEach(id=>document.getElementById(id).value='');
  document.getElementById('prod-avail').checked=true;
  document.getElementById('modal-produto').classList.add('active');
};
window.editarProduto = (id)=>{
  const p = products.find(x=>x.id===id); if(!p) return;
  document.getElementById('produto-modal-title').textContent='Editar produto';
  document.getElementById('prod-id').value=p.id;
  document.getElementById('prod-name').value=p.nome||'';
  document.getElementById('prod-desc').value=p.descricao||'';
  document.getElementById('prod-price').value=p.preco||'';
  document.getElementById('prod-cat').value=p.categoria||'';
  document.getElementById('prod-img').value=p.imagem||'';
  document.getElementById('prod-avail').checked=p.disponivel!==false;
  document.getElementById('modal-produto').classList.add('active');
};
window.salvarProduto = async ()=>{
  const nome=document.getElementById('prod-name').value.trim();
  const preco=parseFloat(document.getElementById('prod-price').value);
  const categoria=document.getElementById('prod-cat').value.trim()||'Outros';
  if(!nome||isNaN(preco)){ toast('Informe nome e preço','warn'); return; }
  const data={ nome, descricao:document.getElementById('prod-desc').value.trim(),
    preco, categoria, imagem:document.getElementById('prod-img').value.trim(),
    disponivel:document.getElementById('prod-avail').checked };
  const id=document.getElementById('prod-id').value;
  const btn=document.getElementById('btn-save-prod'); btn.disabled=true; btn.innerHTML='<span class="loader"></span> Salvando...';
  try{
    if(id) await updateDoc(doc(db,'produtos',id),data);
    else await addDoc(collection(db,'produtos'),{...data,criadoEm:serverTimestamp()});
    toast('Produto salvo!'); fecharModal('modal-produto');
  }catch(e){ toast('Erro: '+e.message,'error'); }
  finally{ btn.disabled=false; btn.innerHTML='Salvar produto'; }
};
window.excluirProduto = async (id)=>{
  if(!confirm('Excluir este produto?')) return;
  try{ await deleteDoc(doc(db,'produtos',id)); toast('Produto excluído'); }
  catch(e){ toast('Erro: '+e.message,'error'); }
};

/* ---- Admin: clientes ---- */
async function loadClients(){
  if(!isAdmin) return;
  const box=document.getElementById('admin-clients-list');
  try{
    const snap=await getDocs(query(collection(db,'clientes'), orderBy('criadoEm','desc')));
    if(snap.empty){ box.innerHTML=`<div class="empty"><div class="ico">👥</div><h3>Sem clientes</h3></div>`; return; }
    box.innerHTML=`<table class="simple">
      <thead><tr><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Tipo</th></tr></thead>
      <tbody>${snap.docs.map(d=>{const c=d.data();return `
        <tr><td><strong>${escapeHtml(c.nome||'—')}</strong></td><td>${escapeHtml(c.email||'')}</td>
        <td>${escapeHtml(c.telefone||'—')}</td>
        <td>${c.role==='admin'?'<span class="status st-confirmado">Admin</span>':'<span class="status st-entregue">Cliente</span>'}</td></tr>`;}).join('')}
      </tbody></table>`;
  }catch(e){ box.innerHTML=`<div class="empty"><div class="ico">⚠️</div><h3>Erro</h3><p>${escapeHtml(e.message)}</p></div>`; }
}

/* ============================================
   HELPERS
   ============================================ */
window.fecharModal = (id)=>document.getElementById(id).classList.remove('active');
document.querySelectorAll('.modal-bg').forEach(m=>m.addEventListener('click',e=>{ if(e.target===m) m.classList.remove('active'); }));

function money(v){ return 'R$ '+Number(v||0).toFixed(2).replace('.',','); }
function fmtData(ts){ if(!ts||!ts.toDate) return '—'; const d=ts.toDate();
  return d.toLocaleDateString('pt-BR')+' '+d.toLocaleTimeString('pt-BR',{hour:'2-digit',minute:'2-digit'}); }
function pagLabel(p){ return {pix:'Pix',cartao_entrega:'Cartão na entrega',dinheiro:'Dinheiro'}[p]||p; }
function statusLabel(s){ return {novo:'🆕 Novo',confirmado:'✅ Confirmado',preparando:'👨‍🍳 Preparando',saiu:'🛵 Saiu p/ entrega',entregue:'📦 Entregue',cancelado:'❌ Cancelado'}[s]||s; }
function statusBadge(s){ const cls={novo:'st-novo',confirmado:'st-confirmado',preparando:'st-preparando',saiu:'st-saiu',entregue:'st-entregue',cancelado:'st-cancelado'}[s]||'st-novo';
  return `<span class="status ${cls}">${statusLabel(s)}</span>`; }
function escapeHtml(s){ return String(s??'').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c])); }
function escapeAttr(s){ return escapeHtml(s).replace(/`/g,'&#96;'); }
function toast(msg,type=''){ const t=document.createElement('div'); t.className='toast '+type;
  t.textContent=(type==='error'?'⚠️ ':type==='warn'?'❗ ':'✅ ')+msg;
  document.getElementById('toasts').appendChild(t);
  setTimeout(()=>{ t.style.opacity='0'; t.style.transform='translateX(90px)'; setTimeout(()=>t.remove(),300); },3200); }

/* ============================================
   INIT
   ============================================ */
updateCartCount();
watchProducts();
const h0 = window.location.hash.replace('#','');
if (h0 && document.getElementById('screen-'+h0)) go(h0);
</script>
</body>
</html>
