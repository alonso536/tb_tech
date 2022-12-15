const showProductsCart = (products, container) => {
    let content = `<h2 class="text-center">Carrito</h2>
                    <table class="table table-bordered my-4">
                    <thead class="table-secondary">
                    <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Opciones</th>
                    </tr>
                    </thead>
                    <tbody id="list-products">`;

    for(let i = 0; i < products.length; i++) {
        content += `<tr><td scope="row">${shortValue(products[i].nombre, 30)}</td>
                    <td>${products[i].precio}</td>
                    <td>${products[i].cantidad}</td>
                    <td><a data-id="${products[i].id}" class="link">Remover</a></td></tr>`;
    }
                    
    content += `</tbody></table>`;
    container.innerHTML = content;
}

const getDataCart = () => {
    const cart = document.querySelector('#cart-body');

    get(ROUTES.CART.GET)
    .then(response => {
        if(response.codigo == -1) {
            cart.innerHTML = '<h2 class="text-center">No hay productos en el carrito</h2>';
        } else {
            showProductsCart(response.datos, cart);
        }
    });
}

const deleteCart = () => {
    const deleteCart = document.querySelector('#delete-cart');

    deleteCart.addEventListener('click', () => {
        get(ROUTES.CART.DELETE)
        .then(response => {
            if(response.codigo == -1) {
                console.log(response);
            } else {
                console.log(response);
                getDataCart();
            }
        });
    });
}

const initCart = async () => {
    await getDataCart();
    await deleteCart();
}