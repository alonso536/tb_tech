const showDetail = async (details) => {
    const filas = [...document.querySelectorAll('.detail')];
    const productsDetail = document.querySelector('#products-detail');

    let i = 0;

    for(let detail in details[0][0]) {
        filas[i].firstElementChild.innerHTML = `<b>${detail}</b>`;
        filas[i].lastElementChild.innerHTML = details[0][0][detail];
        i++;
    }

    let content = '';

    for(let i = 0; i < details[1].length; i++) {
        content += `<tr><td>${details[1][i].producto_id}</td>`;
        content += `<td>${details[1][i].producto}</td>`;
        content += `<td>${details[1][i].cantidad}</td></tr>`;
    }
    productsDetail.lastElementChild.innerHTML = content;
}

const payOrder = () => {
    const payOrder = (document.querySelector('#pay-order') !== null) ? document.querySelector('#pay-order') : null;

    if(payOrder !== null) {
        payOrder.addEventListener('click', () => {
            get(ROUTES.VIEWS.ORDER.PAY)
            .then(response => {
                window.scrollTo(0, 0);
                let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje);
                main.insertAdjacentElement('afterbegin', alerta);
                setTimeout(() => {
                    location.reload();
                }, 4000)
            });
        });
    }
}

const getOrderDetail = async () => {
    const orderDetail = document.querySelector('#order-detail');

    get(ROUTES.VIEWS.ORDER.GET)
    .then(async response => {
        if(response.codigo == -1) {
            orderDetail.firstElementChild.nextElementSibling.remove();
            orderDetail.insertAdjacentHTML('beforeend', '<p class="text-center">Ocurrió un error al mostrar tu pedido. Intentalo de nuevo más tarde.</p>');
        } else {
            orderDetail.dataset.status = response.datos[1][0].estado;

            await showDetail(response.datos);
            if(orderDetail.dataset.status == 2) {
                orderDetail.lastElementChild.remove();
            }
        }
    });

    payOrder();
}