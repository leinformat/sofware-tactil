import * as Order from './orderStore.js';

const formatMoney = (value) =>
  new Intl.NumberFormat("es-CO", {
    style: "currency",
    currency: "COP",
    minimumFractionDigits: 0
  }).format(value);

const renderTicket = ({ items = [], totals = {}, company = {}, order = {}, user = {}, table = {} } = {}) => {

  if (!items.length) return;

  const container = document.getElementById("printableTicket");
  if (!container) return;

  const { rowsHTML, subtotal } = items.reduce((acc, item) => {

    const price = Number(item.precio_unid);
    const qty = Number(item.cantidad);
    const totalItem = price * qty;

    acc.subtotal += totalItem;

    acc.rowsHTML += `
      <tr>
        <td class="qty">${qty}</td>
        <td class="name">${item.nombre_producto}</td>
        <td class="unit_price">${formatMoney(price)}</td>
        <td class="price">${formatMoney(totalItem)}</td>
      </tr>
    `;

    return acc;

  }, { rowsHTML: "", subtotal: 0 });

  const total = subtotal;

  // Company Data
  const empresa = company.nombre_empresa;
  const direccion = company.direccion_empresa;
  const email = company.email_empresa;
  const telefono = company.telefono_empresa;
  const mesa = table.name;
  const atendidoPor = user.nick;
  const numero_fact = order.id;
  const logo = company.logo_empresa;

  const now = new Date();
  const fecha = now.toLocaleDateString('es-CO');
  const hora = now.toLocaleTimeString('es-CO', {
    hour: '2-digit',
    minute: '2-digit'
  });

  container.innerHTML = `
  
    <div class="center">
      <img src="../imagenes/${logo}" style="max-width:140px;margin-bottom:5px;">
    </div>

    <div class="center bold">${empresa}</div>
    <div class="center small">${direccion}</div>
    <div class="center small">${telefono}</div>
    <div class="center small">${email}</div>

    <hr>

    <div class="center small">
      Ticket: #${numero_fact}<br>
      Mesa: ${mesa}<br>
      Atendido por: ${atendidoPor}<br>
      Fecha: ${fecha}<br>
      Hora: ${hora}
    </div>

    <hr>

    <table class="ticket-table">
      <thead>
        <tr>
          <th class="qty">Cant</th>
          <th class="name">Producto</th>
          <th class="unit_price">P.U</th>
          <th class="price">Total</th>
        </tr>
      </thead>
      <tbody>
        ${rowsHTML}
      </tbody>
    </table>

    <hr>

    <div class="right bold">
      TOTAL: ${formatMoney(total)}
    </div>

    <hr>

    <div class="center thank-you">Gracias por su compra</div>
    <div id="qrContainer" class="center"></div>
  `;

  const qrText = `FACT:${numero_fact}|FECHA:${fecha}|TOTAL:${total}`;

  const qrContainer = document.getElementById("qrContainer");
  qrContainer.innerHTML = "";

  new QRCode(qrContainer, {
    text: qrText,
    width: 90,
    height: 90
  });
};

export const printTicket = () => {

  const order = Order.orderData();
  const cart = order.items;

  if (!cart.length) return;

  renderTicket(order);

  console.log(order);

  const handleAfterPrint = () => {
    window.removeEventListener("afterprint", handleAfterPrint);
    window.location.href = `?mod=restaurant`;
  };

  window.addEventListener("afterprint", handleAfterPrint);

  const waitImages = () => {
    const images = document.querySelectorAll('#printableTicket img');

    const promises = [...images].map(img => {
      if (img.complete) return Promise.resolve();
      return new Promise(resolve => {
        img.onload = img.onerror = resolve;
      });
    });

    return Promise.all(promises);
  };

  waitImages().then(() => {
    requestAnimationFrame(() => window.print());
  });

};