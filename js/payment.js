import * as utils from './utils/utils.js';
import * as Order from './orderStore.js';
import { printTicket } from './printService.js';
import { CART_ENDPOINT, TABLES_ENDPOINT, ORDERS_ENDPOINT } from './apiEndpoints.js';

// ---- State Handling ----
function schichtPayment(state) {
  if(Order.items.get().length === 0) return;
  document.querySelector(".payment-panel").dataset.state = state;
}

// ---- Logic ----
function calcChange(cashInput, changeOutput, total = 0) {
  const cash = parseFloat(cashInput.value || 0);
  const change = cash - total;
  changeOutput.textContent = `$${utils.formatMoney(change)}`;
}

// ---- Initialization ----
export function initPayment(total = 0) {
  const summaryTotal = document.querySelector("#summary-total");
  const cashInput = document.getElementById("cash-input");
  const changeOutput = document.getElementById("change-value");

  summaryTotal.textContent = `$${utils.formatMoney(total)}`;

  const handleKeyPress = (e) => {
    const key = e.currentTarget.dataset.key;

    if (key === "clear") {
      cashInput.value = "";
      changeOutput.textContent = "$0.00";
      return;
    }

    cashInput.value += key;
    calcChange(cashInput, changeOutput, total);
  };

  // register keyboard without duplication
  document.querySelectorAll("[data-key]").forEach(btn => {
    btn.onmousedown = null;
    btn.onclick = handleKeyPress;
  });

  cashInput.addEventListener("input", () => {
    calcChange(cashInput, changeOutput, total);
  });
}

// ---- Open/Close ----
document.querySelector('button.pay').onclick = () => schichtPayment('open');

document.querySelector("[data-action='close']").onclick = () => schichtPayment('closed');
document.querySelector("[data-action='cancel']").onclick = () => schichtPayment('closed');

// Payment Methods
document.querySelectorAll(".payment-panel__methods button").forEach(btn => btn.onclick = () => {
  document.querySelector(".payment-method.is-active").classList.remove("is-active");
  btn.classList.add("is-active");

  Order.order.set({
    ...Order.order.get(),
    payment_method: btn.dataset.method
  });
  console.log(Order.orderData());

});

// Confirm Payment
document.querySelector("[data-action='confirm']").onclick = async() =>{

  const result = await utils.confirmAction({
    actionEndpoint: `${CART_ENDPOINT}`,
    payload: { action: 'save-cart', table_id: Order.table.get().id },
    confirmTitle: 'Cerrar venta',
    confirmText: '¿Estás seguro de que quieres cerrar venta?',
    successTitle: 'Venta cerrada',
    successText: 'La venta ha sido cerrada',
    progressTimer: 1,
    onSuccess: async () => {
      await utils.handlerTable({ id: Order.table.get().id, url: TABLES_ENDPOINT, action: 'closeTable' });

      const { subTotal, vatTotal, total } = Order.orderData().totals;
      const paymentMethod = Order.orderData().order.payment_method;
      await utils.http({
        method: "POST",
        url: `${ORDERS_ENDPOINT}`,
        payload: {
          action: 'update-order',
          state: 'paid',
          subTotal: subTotal,
          vatTotal: vatTotal,
          total: total,
          paymentMethod: paymentMethod,
          id: Order.order.get().id
        }
      });
    }
  });

  if(!!result.success){
    setTimeout(() => printTicket(), 300);
  }
}