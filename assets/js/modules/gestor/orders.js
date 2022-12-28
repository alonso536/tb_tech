const listOrders = (orders, list) => {
    orders = orders.reverse();

    let content = '';

    for(let i = 0; i < orders.length; i++) {
        if(orders[i].estado_id == 3) {
            continue;
        }
        content += `<tr><td scope="row">${orders[i].id}</td>`+
                    `<td>${orders[i].direccion}</td>`+
                    `<td>${orders[i].monto}</td>`+
                    `<td><a data-id="${orders[i].id}" class="show-order link">Ver detalle</a>`;

        if(orders[i].estado_id == 1) {
            content += `<a data-id="${orders[i].id}" class="delete-order link"> | Descartar</a>`;
        }
        content += `</td></tr>`;
    }

    list.innerHTML = content;
}

const gestOrders = async () => {
    const list = document.querySelector('#list-orders');
    const gestorMain = document.querySelector('#gestor-main');

    if(list.dataset.id <= 0) {
        location.reload();
    }

    await post(ROUTES.VIEWS.ORDER.ALL, {
        'id' : list.dataset.id
    })
    .then(response => {
        if(response.codigo == -1) {
            gestorMain.lastElementChild.remove();
            gestorMain.innerHTML += '<h4 class="text-center my-3">No has realizado ningún pedido</h4>';
        } else {
            listOrders(response.datos, list);
        }
    });

    const showOrders = [...document.querySelectorAll('.show-order')];
    const deleteOrders = [...document.querySelectorAll('.delete-order')];

    showOrders.forEach(showOrder => {
        showOrder.addEventListener('click', async () => {
            await changeViewPost(ROUTES.VIEWS.ORDER.READ, {
                'id' : showOrder.dataset.id
            })
            .then(response => {
                localStorage.setItem('idOrder', showOrder.dataset.id);
                localStorage.setItem('view', 11);
                main.innerHTML = response;
            });
            await getOrderDetail();
        });
    });

    deleteOrders.forEach(deleteOrder => {
        deleteOrder.addEventListener('click', () => {
            post(ROUTES.VIEWS.ORDER.DELETE,  {
                'id' : deleteOrder.dataset.id
            })
            .then(async response => {
                if(response.codigo == -1) {
                    let alerta = showAlert('alert-danger', response.mensaje);
                    main.insertAdjacentElement('afterbegin', alerta);
                } else {
                    if(main.firstElementChild.tagName == 'DIV') {
                        main.firstElementChild.remove();
                    }
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.ORDERS)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    gestOrders();
                }
            });
        })
    });
}