<!--
  DEVELOPER: ING. LEONARDO MORALES
  EMAIL: LEINFORMAT@GMAIL.COM
  PHONE: +57 322 879 0912
 -->
<div class="content-wrapper">
  <div class="pos">
  
  <!-- TOP BAR -->
  <header class="topbar">
    <div class="left top-bar-icon__clock">00:00 PM</div>
    <div class="top-bar-icon__table">
      <a href="?mod=restaurant">
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 640 640"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M127.9 78.4C127.1 70.2 120.2 64 112 64C103.8 64 96.9 70.2 96 78.3L81.9 213.7C80.6 219.7 80 225.8 80 231.9C80 277.8 115.1 315.5 160 319.6L160 544C160 561.7 174.3 576 192 576C209.7 576 224 561.7 224 544L224 319.6C268.9 315.5 304 277.8 304 231.9C304 225.8 303.4 219.7 302.1 213.7L287.9 78.3C287.1 70.2 280.2 64 272 64C263.8 64 256.9 70.2 256.1 78.4L242.5 213.9C241.9 219.6 237.1 224 231.4 224C225.6 224 220.8 219.6 220.2 213.8L207.9 78.6C207.2 70.3 200.3 64 192 64C183.7 64 176.8 70.3 176.1 78.6L163.8 213.8C163.3 219.6 158.4 224 152.6 224C146.8 224 142 219.6 141.5 213.9L127.9 78.4zM512 64C496 64 384 96 384 240L384 352C384 387.3 412.7 416 448 416L480 416L480 544C480 561.7 494.3 576 512 576C529.7 576 544 561.7 544 544L544 96C544 78.3 529.7 64 512 64z"/></svg>
        Mesas
      </a>
    </div>

    <div class="center">
      <span class="table-name">Mesa 12</span>
      <span>Cliente: General</span>
      <span class="ticket-id">Ticket #0453</span>
    </div>
    <div class="right"></div>
  </header>

  <!-- MAIN -->
  <div class="main">

    <!-- LEFT -->
    <aside class="ticket">
      <div class="action-pad-container hidden"></div>
      <h3>Pedido Actual</h3>
      <div class="ticket-values"> 
        <div class="items">
          Sin Items
        </div>
        <div class="ticket-totals">
          <div class="notes">📝 Notas del Pedido</div>
          <div class="totals">
            <div><span>Subtotal:</span><span class="subtotal">$0</span></div>
            <div><span>IVA:</span><span class="vat">$0</span></div>
            <div><span>Total:</span><span class="total">$0</span></div>
          </div>
        </div>
      </div>
      <div class="actions">
        <button class="empty-cart">Vaciar Pedido</button>
        <button class="pay">Cobrar</button>
      </div>
    </aside>

    <!-- CENTER -->
    <main class="products">

      <!-- SEARCH -->
      <div class="product-toolbar">
        <div class="product-search">
          <span class="icon">🔍</span>
          <input
            type="text"
            id="searchInput"
            placeholder="Buscar producto..."
            autocomplete="off"
          />
        </div>
      </div>
      <!-- /SEARCH -->

      <div class="tabs">
      </div>
      <div class="grid">
        <div class="card">
        </div>
      </div>
    </main>

    <!-- RIGHT 
    <aside class="numpad">
      <div class="keys">
        <button>1</button><button>2</button><button>3</button>
        <button>4</button><button>5</button><button>6</button>
        <button>7</button><button>8</button><button>9</button>
        <button class="zero">0</button>
        <button class="clear">Borrar</button>
      </div>
    </aside>
    -->
  </div> 

  <!-- BOTTOM BAR -->
  <footer class="bottombar">
   <!--  <button>📄 Dividir Cuenta</button>
    <button>⏳ Cuenta Pendiente</button> -->
    <button class="bottombar__cancel-order">🗑 Eliminar</button>
    <!-- <button>% Descuento</button>
    <button>⋯ Más Opciones</button> -->
  </footer>

</div>
</div>

<div class="payment-panel" data-state="closed">
  <div class="payment-panel__modal">
    <div class="payment-panel__header">
      <span>Cobrar</span>
      <button class="payment-panel__close" data-action="close">✕</button>
    </div>
    <div class="payment-panel__container">
      <div class="col-1">
        <div class="payment-panel__summary">
          <div class="summary-total">
            <span>Total:</span>
            <span id="summary-total">$0</span>
          </div>
        </div>

        <div class="payment-panel__input">
          <label>Recibido</label>
          <input type="number" id="cash-input" placeholder="0.00" />
        </div>

        <div class="payment-panel__change-container">
          <div class="payment-panel__change">
            <span>Dar Vuelto</span>
            <span id="change-value">$0.00</span>
          </div>
        </div>
      </div>

      <div class="col-2">
        <div class="payment-panel__methods">
          <button class="payment-method is-active" data-method="cash">Efectivo</button>
          <button class="payment-method" data-method="card">Tarjeta</button>
          <button class="payment-method" data-method="nequi">Nequi</button>
          <button class="payment-method" data-method="other">Otro</button>
        </div>

        <div class="payment-panel__keypad">
          <button data-key="7">7</button>
          <button data-key="8">8</button>
          <button data-key="9">9</button>
          <button data-key="4">4</button>
          <button data-key="5">5</button>
          <button data-key="6">6</button>
          <button data-key="1">1</button>
          <button data-key="2">2</button>
          <button data-key="3">3</button>
          <button data-key="0" class="wide">0</button>
          <button data-key="clear">Clear</button>
        </div>
      </div>

    </div>
    <div class="payment-panel__actions">
      <button class="btn btn-cancel" data-action="cancel">Cancelar</button>
      <button class="btn btn-confirm" data-action="confirm">Cobrar</button>
    </div>
  </div>

  <div id="printableTicket" class="payment-panel__ticket"></div>
</div>

<link rel="stylesheet" href="../css/touch-card.css">
<link rel="stylesheet" href="../css/payment.css">
<link rel="stylesheet" href="../css/invoice.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script type="module" src="../js/cardTouch.js"></script>