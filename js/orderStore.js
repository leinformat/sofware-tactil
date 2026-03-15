import * as utils from './utils/utils.js';

const CART = [];
let ORDER = {};

let TABLE = {};
let COMPANY = {};
let USER = {};
let PAID = 0;
let CHANGE = 0;

export const items = {
  get() {
    return CART;
  },

  set(items) {
    CART.length = 0;
    CART.push(...items);
  },

  add(item) {
    CART.push(item);
  },

  clear() {
    CART.length = 0;
    PAID = 0;
    CHANGE = 0;
  }
};

export const table = {
  set(data) {
    if (!data) throw new Error('Data is required');
    TABLE = data;
  },

  get() {
    return { ...TABLE };
  },

  clear() {
    TABLE = {};
  }
};

export const company = {
  set(data) {
    if (!data) throw new Error('Data is required');
    COMPANY = data;
  },

  get() {
    return { ...COMPANY };
  },

  clear() {
    COMPANY = {};
  }
};

export const order = {
  set(data) {
    if (!data) throw new Error('Data is required');
    ORDER = data;
  },

  get() {
    return { ...ORDER };
  },

  clear() {
    ORDER = {};
  }
};

export const user = {
  set(data) {
    if (!data) throw new Error('Data is required');
    USER = data;
  },

  get() {
    return { ...USER };
  },

  clear() {
    USER = {};
  }
};

export const orderData = () => {
  return {
    user: user.get(),
    order: order.get(),
    company: company.get(),
    table: table.get(),
    items: items.get(),
    totals: utils.calculateCartTotals(items.get())
  };
};