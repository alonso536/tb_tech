const showProductsCart = (products) => {
    let content = `<table class="table table-bordered my-4">
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
        if(products[i] == null) {
            continue;
        }
        content += `<tr><td scope="row">${shortValue(products[i].nombre, 20)}</td>
                    <td>${products[i].precio}</td>
                    <td>${products[i].cantidad}</td>
                    <td><a data-id="${products[i].id}" class="link remove-cart">Remover</a></td></tr>`;
    }
                    
    content += `</tbody></table>`;
    return content;
}

const getDataCart = async () => {
    const cart = document.querySelector('#cart-body');

    await get(ROUTES.CART.GET)
    .then(response => {
        if(response.codigo == -1) {
            cart.innerHTML = '<h2 class="text-center">No hay productos en el carrito</h2>';
            cart.nextElementSibling.classList.add('hidden');
        } else {
            cart.innerHTML = '<h2 class="text-center">Carrito</h2>';
            cart.insertAdjacentHTML('beforeend', showProductsCart(response.datos));
            cart.nextElementSibling.classList.remove('hidden');
        }
    });
}

const getTotalCart = async () => {
    const total = document.querySelector('#totalCart');

    get(ROUTES.CART.TOTAL)
    .then(response => {
        if(response.codigo == -1) {
            total.innerHTML = 0;
        } else {
            total.innerHTML = response.datos;
        }
    });
}

const removeCart = async () => {
    const removeCart = [...document.querySelectorAll('.remove-cart')];

    removeCart.forEach(link => {
        link.addEventListener('click', () => {
            post(ROUTES.CART.REMOVE, {
                'id': link.dataset.id
            })
            .then(async response => {
                if(response.codigo == -1) {
                    console.log(response);
                } else {
                    initCart();
                }
            });
        });
    });
}

const deleteCart = () => {
    const deleteCart = document.querySelector('#delete-cart');

    deleteCart.addEventListener('click', () => {
        get(ROUTES.CART.DELETE)
        .then(async response => {
            if(response.codigo == -1) {
                console.log(response);
            } else {
                //console.log(response);
                initCart();
            }
        });
    });
}

const initCart = async () => {
    await getDataCart();
    await getTotalCart();
    await removeCart();
    deleteCart();
}