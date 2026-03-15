import * as utils from './utils/utils.js';
import {
    PRODUCTS_ENDPOINT,
    CART_ENDPOINT,
    TABLES_ENDPOINT,
    ORDERS_ENDPOINT,
    COMPANY_ENDPOINT,
    USER_ENDPOINT
} from './apiEndpoints.js';

import { initPayment } from './payment.js';
import * as Order from './orderStore.js';

const params = new URLSearchParams(window.location.search);
const tableId = params.get('id');
const tableName = params.get('name');
let ticketId;

// Set current table
Order.table.set({ id: tableId, name: tableName });

/* =========================
   RENDER CATEGORIES
========================= */
const tableInfo = async () => {
    try {
        const [table,company,user,order] = await Promise.all([
            fetch(`${TABLES_ENDPOINT}?table=${tableId}`).then(r => r.json()),
            fetch(`${COMPANY_ENDPOINT}?company=1`).then(r => r.json()),
            fetch(`${USER_ENDPOINT}?user=1`).then(r => r.json()),
            initOrder()
        ]);

        if (table.success && order.success) {
            Order.table.set(table.result);
            Order.order.set(order.result);
            Order.company.set(company.result);
            Order.user.set(user.result);
        }
        return [table, order];
    } catch (error) {
        console.error('Error cargando tabla:', error);
    }
};

const loadCategories = async () => {
    const res = await fetch(`${PRODUCTS_ENDPOINT}?all-categories`);
    const data = await res.json();

    const tabs = document.querySelector('.tabs');
    tabs.innerHTML = '';

    const colors = ['food', 'drink', 'dessert', 'promo'];

    data.forEach((cat, i) => {
        const btn = document.createElement('button');
        btn.textContent = cat.nombre_cat;
        btn.dataset.categoryId = cat.id_categoria;
        btn.className = colors[i] || 'default';
        btn.onclick = () => loadProducts({categoryId: cat.id_categoria, tabs, btn, query: 'products-by-category'});
        tabs.appendChild(btn);
    });
};

/* =========================
   RENDER PRODUCTS
========================= */
const loadProducts = async ({categoryId = null,tabs = null,btn = null,query = 'all-products', ...actions} = {}) => {
    if (tabs && btn) {
        tabs.querySelector('button.tab--active')?.classList?.remove('tab--active');
        btn.classList.add('tab--active');
    }

    let data = actions?.data;

    if (!data || !actions?.value) {
        const res = await fetch(`${PRODUCTS_ENDPOINT}?${query}=${categoryId || 1}`);
        data = await res.json();
    }

    const grid = document.querySelector('.grid');

    if (!data?.length) {
        grid.innerHTML = `
            <div class="empty-state">
                <div class="empty-icon">🔎</div>
                <div class="empty-title">No encontramos productos</div>
                <div class="empty-text">
                    No hay resultados para <b>"${actions.value}"</b>
                </div>
            </div>
        `;
        return;
    }

    grid.innerHTML = '';

    data.forEach(p => {
        const card = document.createElement('div');
        card.className = 'card';
        card.dataset.id = p.id_producto;
        card.dataset.price = p.precio_unid;
        card.dataset.vat = p.iva_producto;
        card.innerHTML = `<div class="qty-product-value"></div>
                          <div class="card-img">
                                <img src="${!!p.img ? p.img : "../imagenes/food-placeholder.png"}" alt="${p.nombre_producto}">
                          </div>
                          <div class="card-info">
                            <div class="card-name">${p.nombre_producto}</div>
                            <div class="card-price">$${utils.formatMoney(p.precio_unid)}</div>
                          </div>
                          <button class="card-add">
                            <span>+</span> Agregar
                          </button>`;
        card.onclick = () => addToCart({
            "action": "add-product",
            "productId": p.id_producto,
            "quantity": 1,
            "price": p.precio_unid,
            "tableId": tableId,
            "ticketId": Order.order.get().id
        });
        grid.appendChild(card);
    });
};

/* =========================
   ADD TO CART
========================= */
const addToCart = async payload => {
    const res = await fetch(`${CART_ENDPOINT}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    });
    
    const data = await res.json();

    if (data.success) {
        await renderCart();
    }
};

/* =========================
   DELETE PRODUCT FROM CART
========================= */
const deleteCartItem = async payload => {
    console.log(payload);
    const res = await fetch(`${CART_ENDPOINT}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    });

    const data = await res.json();

    if (data.success) {
        await renderCart();
    }
};

const editCartItem = (el,item) => {
    let quantity = item.cantidad;
    const popup = document.querySelector('.action-pad-container');
    popup.innerHTML = `<div id="action-pad" class="action-pad">
                        <button class="close-btn">✕</button>
                        <div class="item-info">
                            <div class="name">${ item.nombre_producto }</div>
                            <div class="price">$${ utils.formatMoney(item.precio_unid) }</div>
                        </div>

                        <div class="qty-section">
                            <button class="qty-btn minus">−</button>
                            <span class="qty-value">${ item.cantidad }</span>
                            <button class="qty-btn plus">+</button>
                        </div>

                        <button class="edit-btn">Editar</button>
                        <button class="delete-btn">Eliminar</button>
                        </div>`;

    popup.classList.remove('hidden');
    const closePopup = popup.querySelector('.close-btn');
    closePopup.onclick = () => popup.classList.add('hidden');
    const quantityValue = popup.querySelector('.qty-value');
    console.log(item);
    popup.onclick = async (e) => {
        e.target.classList.contains('plus') && (quantity++);
        e.target.classList.contains('minus') && (quantity--);
        e.target.classList.contains('delete-btn') && (quantity = 0);

        quantityValue.innerHTML = quantity;

        await deleteCartItem({
            "itemId": item.id_salida,
            "quantity": quantity
        });

        if (quantity === 0) {
            popup.classList.add('hidden');
        }
    };
};

/* =========================
   RENDER CART
========================= */
const renderCart = async () => {
    const container = document.querySelector('.items');
    const tableNameContainer = document.querySelector('.table-name');
    const ticket = document.querySelector('.ticket-id');
    tableNameContainer.innerHTML = `${tableName}`;
    ticket.innerHTML = `Ticket #${Order.order.get().id}`;
    container.innerHTML = '';

    const res = await fetch(`${CART_ENDPOINT}?cart=${tableId}`);
    const { cart } = await res.json();

    Order.items.set(cart);

    if (!cart.length) {
        container.innerHTML = '<div class="item"><span>Sin Items</span></div>';
        document.querySelector('.subtotal').textContent = `$${utils.formatMoney(0)}`;
        document.querySelector('.vat').textContent = `$${utils.formatMoney(0)}`;
        document.querySelector('.total').textContent = `$${utils.formatMoney(0)}`;
        return;
    }
    
    cart.forEach(item => {
        const qty = Number(item.cantidad);
        const price = Number(item.precio_unid);
        const monto = qty * price;

        const itemContainer = document.createElement('div');
        itemContainer.className = 'item';

        itemContainer.innerHTML += `<span>${qty}x ${item.nombre_producto}</span>
                           <span>$${utils.formatMoney(monto)}</span>`;

        itemContainer.onclick = () => editCartItem(itemContainer,item);

        container.appendChild(itemContainer);
    });

    const { subtotal, vatTotal, total } = utils.calculateCartTotals(cart);

    document.querySelector('.subtotal').textContent = `$${utils.formatMoney(subtotal)}`;
    document.querySelector('.vat').textContent = `$${utils.formatMoney(vatTotal)}`;
    document.querySelector('.total').textContent = `$${utils.formatMoney(total)}`;

    initPayment(total);
};

/* --- SEARCH --- */
const handleSearch = utils.debounce(async (value) => {
  const data = await utils.apiSearch({
    query: value,
    endpoint: `${PRODUCTS_ENDPOINT}`,
    param: "search"
  });

  await loadProducts({ value:value.trim(), data });
}, 400);

/* ORDERS */
const initOrder = async () => {
    const res = await fetch(`${ORDERS_ENDPOINT}?table=${tableId}`);
    const data = await res.json();
     if (data.success) {
        return data;
    }

    const order = await fetch(`${ORDERS_ENDPOINT}`,{
        method: 'POST',
        body: JSON.stringify({
            action: 'create-order',
            tableId: tableId
        })
    });

    return order.json();
};

// Click events
document.addEventListener('click', async (e) => {
    const pad = document.querySelector('.action-pad-container');
    // Empty cart
    if (e.target.classList.contains('empty-cart')) {
        if(Order.items.get().length === 0) return;
        utils.confirmAction({
            actionEndpoint: `${CART_ENDPOINT}`,
            payload: { action: 'empty-cart', table_id: tableId },
            confirmTitle: 'Vaciar mesa',
            confirmText: 'Se eliminarán todos los productos del pedido',
            successTitle: 'Pedido vaciado',
            successText: 'Todos los productos del pedido han sido eliminados',
            onSuccess: async () => renderCart()
        });
    }
    // cancel order
    else if (e.target.classList.contains('bottombar__cancel-order')) {
        const result = await utils.confirmAction({
            actionEndpoint: `${CART_ENDPOINT}`,
            payload: { action: 'empty-cart', table_id: Order.table.get().id },
            confirmTitle: 'Eliminar Pedido',
            confirmText: '¿Estás seguro de que quieres eliminar el pedido?',
            successTitle: 'Pedido eliminado',
            successText: 'El pedido ha sido eliminado',
            progressTimer: 1000,
            onSuccess: async () => {
                await utils.handlerTable({ id: Order.table.get().id, url: TABLES_ENDPOINT, action: 'closeTable' });
                await utils.http({
                    method: "POST",
                    url: `${ORDERS_ENDPOINT}`,
                    payload: {
                        action: 'update-order',
                        state: 'cancelled',
                        id: Order.order.get().id
                    }
                });
            }
        });
        if (!!result.success) {
            window.location.href = `?mod=restaurant`;
        }
    }
    else if (!pad.contains(e.target) && !e.target.classList.contains('item') && !e.target.closest('.item')) {
        pad.classList.add('hidden');
    }
});

/* --- SEARCH --- */
const searchInput = document.querySelector(".product-search input");
searchInput.addEventListener("input", (e) => {
  handleSearch(e.target.value);
});

/* =========================
INIT
========================= */
const init = async () => {
    try {
        await tableInfo();
        await Promise.all([loadCategories(), loadProducts()]);
        await renderCart();
    } catch (error) {
        console.error('Error cargando datos:', error);
    }
};

document.addEventListener('DOMContentLoaded', () => init());