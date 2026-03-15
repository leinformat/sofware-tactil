import Swal from './sweetalert2.esm.min.js';

export const formatMoney = value =>
    new Intl.NumberFormat('es-CO', {
        minimumFractionDigits: 0
    }).format(value);


export const getTicketId = async (API_URL) => {
    const res = await fetch(`${API_URL}/CartController.php?ticket-id`);
    const data = await res.json();

    return data.ticketId;
};

export const http = async ({ method = "GET", url, payload = null }) => {
    const options = {
        method,
        headers: {
            "Content-Type": "application/json"
        }
    };

    if (method !== "GET" && payload) {
        options.body = JSON.stringify(payload);
    }

    const response = await fetch(url, options);

    if (!response.ok) {
        throw new Error(`HTTP error ${response.status}`);
    }
    return response.json();
};

export const handlerTable = async ({ id, url, action }) => {
    const response = await fetch(`${url}`, {
        method: "POST",
        body: JSON.stringify({
            action: action,
            table_id: id
        })
    });

    return response.json();
};

export const calculateCartTotals = (cart = []) => {
    const subtotal = cart.reduce((acc, item) => {
        const qty = Number(item.cantidad);
        const price = Number(item.precio_unid);
        return acc + (qty * price);
    }, 0);

    const vatTotal = cart.reduce((acc, item) => {
        const qty = Number(item.cantidad);
        const price = Number(item.precio_unid);
        const iva = Number(item.iva_producto);
        const monto = qty * price;
        return acc + ((monto * iva) / 100);
    }, 0);

    const total = subtotal + vatTotal;

    return {
        subtotal,
        vatTotal,
        total
    };
}

export const confirmAction = async ({
    actionEndpoint,
    payload = {},
    confirmTitle = 'Confirmar acción',
    confirmText = '¿Estás seguro?',
    confirmButtonText = 'Sí',
    cancelButtonText = 'Cancelar',
    successTitle = '¡Hecho!',
    successText = 'La acción se completó',
    confirmButtonColor = '#ef4444',
    cancelButtonColor = '#9ca3af',
    progressTimer= 1000,
    onSuccess = async () => {}
}) => {
    const actionResult = await Swal.fire({
        title: confirmTitle,
        text: confirmText,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor,
        cancelButtonColor,
        confirmButtonText,
        cancelButtonText
    });

    if (actionResult.isConfirmed) {
        const response = await fetch(actionEndpoint, {
            method: 'POST',
            body: JSON.stringify(payload)
        });

        if (response.ok) {
            const result = await Swal.fire({
                title: successTitle,
                text: successText,
                icon: 'success',
                timer: progressTimer,
                showConfirmButton: false,
                timerProgressBar: true
            });

            if (result.dismiss === Swal.DismissReason.timer) {
                await onSuccess();
            }

            return {
                success: true,
                message: 'Action confirmed'
            };
        }
    }

    return {
        success: false,
        message: 'Action cancelled or has been denied'
    };
};

export const updateClock = () => {
  const now = new Date();

  const time = now.toLocaleTimeString('en-US', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: true
  });

  return time;
}

export async function apiSearch({
  query,
  endpoint,
  param = "search",
  signal = null
}) {

  if (!query || !query.trim()) return [];

  const url = `${endpoint}?${param}=${encodeURIComponent(query)}`;

  const res = await fetch(url, { signal });

  if (!res.ok) {
    throw new Error("API request failed");
  }

  return await res.json();
}

export function debounce(fn, delay = 300) {
  let timer;

  return function (...args) {
    const context = this;

    clearTimeout(timer);

    timer = setTimeout(() => {
      fn.apply(context, args);
    }, delay);
  };
}