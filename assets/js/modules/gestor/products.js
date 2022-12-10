const listProducts = (products, list) => {
    let content = '';

    for(let i = 0; i < products.length; i++) {
        content += `<tr><td scope="row">${shortValue(products[i].nombre, 30)}</td>`+
                    `<td>${products[i].precio}</td>`+
                    `<td>${products[i].stock}</td>`+
                    `<td><a data-id="${products[i].id}" class="update-product link">Modificar</a></td></tr>`;
    }

    list.innerHTML = content;
}

const gestProducts = async () => {
    const list = document.querySelector('#list-products');
    const gestorMain = document.querySelector('#gestor-main');

    await get(ROUTES.VIEWS.PRODUCTS[0])
    .then(response => {
        if(response.codigo == -1) {
            products.innerHTML = '<h4 class="text-center my-3">No se encontraron productos</h4>';
        } else {
            listProducts(response.datos, list);
        }
    });

    const updates = [...document.querySelectorAll('.update-product')];

    updates.forEach(update => {
        update.addEventListener('click', () => {
            changeViewGestorPost(ROUTES.VIEWS.GESTOR.UPDATEPRODUCTS, {
                'id' : update.dataset.id
            })
            .then(response => {
                gestorMain.innerHTML = response;
                formProductUpdateValidate();
            });
        });
    });
}