import * as utils from './utils/utils.js';
import { TABLES_ENDPOINT } from './apiEndpoints.js';

/* =========================
   RENDER Tables
========================= */
const loadTables = async (query = 'all-tables') => {
    const res = await fetch(`${TABLES_ENDPOINT}?${query}`);
    const { results } = await res.json();
    console.log(results);

    const grid = document.querySelector('.grid');
    grid.innerHTML = '';

    for (const item of results) {
        const card = document.createElement('div');

        const { id, name, state, is_free, total } = item;

        card.className = 'card';
        card.dataset.id = id;
        card.dataset.state = state;
        card.dataset.isFree = is_free;
        card.classList.add(is_free ? 'free-table' : 'busy-table');
        card.innerHTML = `${!is_free ? `<div class="card-total">$${utils.formatMoney(total)}</div>` : ''}
                          <div class="card-img">
                                <img src="../imagenes/${id===0?'barra.png':'mesa.png'}" alt="${name}">
                          </div>
                          <div class="card-info">
                            <div class="card-name">${name}</div>
                          </div>
                          <div class="card-status">
                            <span>${is_free ? 'Libre' : 'Ocupada'}</span>
                          </div>`;
        card.onclick = async () => {
            console.log('click');
            const action = await utils.handlerTable({ id, url: TABLES_ENDPOINT, action: 'openTable' });
            console.log(action);
            if (action.success) {
                window.location.href = `?mod=table&id=${id}&name=${name}`;
            }
        };
        grid.appendChild(card);
    }
};

/* =========================
   INIT
========================= */
const init = async () => {
    await loadTables();
};

document.addEventListener('DOMContentLoaded', () => init());