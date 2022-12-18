const showDetail = async (details) => {
    const filas = [...document.querySelectorAll('.detail')];
    const productsDetail = document.querySelector('#products-detail');

    let i = 0;

    for(let detail in details[0][0]) {
        filas[i].firstElementChild.innerHTML = `<b>${detail}</b>`;
        filas[i].lastElementChild.innerHTML = details[0][0][detail];
        i++;
    }

    let contentHead = '<tr>';
    let contentBody = '';

    for(let product in details[1][0]) {
        contentHead += `<td><b>${product}</b></td>`;
    }
    contentHead += '</tr>';

    for(let i = 0; i < details[1].length; i++) {
        contentBody += `<tr><td>${details[1][i]['Nombre del producto']}</td>`;
        contentBody += `<td>${details[1][i].Cantidad}</td></tr>`;
    }

    productsDetail.firstElementChild.innerHTML = contentHead;
    productsDetail.lastElementChild.innerHTML = contentBody;
}

const getOrderDetail = async () => {
    const orderDetail = document.querySelector('#order-detail');

    get(ROUTES.VIEWS.ORDER.GET)
    .then(async response => {
        if(response.codigo == -1) {
            orderDetail.firstElementChild.nextElementSibling.remove();
            orderDetail.insertAdjacentHTML('beforeend', '<p class="text-center">Ocurrió un error al mostrar tu pedido. Intentalo de nuevo más tarde.</p>');
        } else {
            await showDetail(response.datos);
        }
    });
}