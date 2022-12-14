const imageProduct = () => {
    const form = (document.querySelector('#form-image-product') !== null) ? document.querySelector('#form-image-product') : null;

    if(form !== null) {
        linksImage('#form-image-product', ROUTES.FORMS.IMAGE.DELETEPRODUCT);
        formImage('#form-image-product', ROUTES.FORMS.IMAGE.PRODUCT); 
    } 
}

const showContent = () => {
    const radios = document.getElementsByName('btnradio');
    const content = document.querySelector('#content');

    radios[0].addEventListener('click', () => {
        content.firstElementChild.classList.remove('hidden');
        content.lastElementChild.classList.add('hidden');
    });

    radios[1].addEventListener('click', () => {
        content.lastElementChild.classList.remove('hidden');
        content.firstElementChild.classList.add('hidden');
    });

}

const renderProducts = async (products, container) => {
    products.sort(() => {
        return 0.5 - Math.random();
    });
    let limit = (products.length >= 3) ? 3 : products.length;

    let content = '';
    for(let i = 0; i < limit; i++) {
        if(products[i].image == null) {
            products[i].image = 'product-default.png';
        }

        content += `<article class="col-sm-12 col-md-4 g-3">
                    <div class="card shadow-sm">
                    <div class="card-header bg-primary bg-gradient bg-opacity-10">
                    <h5 class="card-title text-primary mt-2">${products[i].nombre}</h5>
                    </div>
                    <img src="../shop/uploads/images/products/${products[i].image}" class="card-img-top" alt="${products[i].nombre}" />
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Precio Oferta:</b> ${products[i].precio}</li>
                    <li class="list-group-item"><b>Precio Normal:</b> ${products[i].precio}</li>
                    <li class="list-group-item"><b>Stock:</b> ${products[i].stock}</li>
                    </ul>
                    <div class="card-body d-flex flex-md-column flex-lg-row justify-content-between">
                    <a data-id="${products[i].id}" class="btn btn-primary bg-gradient mb-sm-0 mb-md-2 mb-lg-0 show-more">Ver más</a>
                    <a class="btn btn-primary bg-gradient">Añadir al carrito</a>
                    </div>
                    </div>
                    </article>`;
    }
    container.innerHTML += content;
}

const showRandomProducts = () => {
    const content = document.querySelector('#contenido-producto');
    const randomProducts = document.querySelector('#random-products');

    post(ROUTES.VIEWS.PRODUCTS[1], {
        'categoria': content.dataset.category
    })
    .then(async response => {
        if(response.codigo == -1) {
            randomProducts.innerHTML += '<p>No se encontraron productos</p>';
        } else {
            let products = response.datos.filter(res => res.stock != 0 && res.id != content.dataset.id);
            
            if(products.length == 0) {
                randomProducts.innerHTML += '<p>No se encontraron productos</p>';
            } else {
                await renderProducts(products, randomProducts);
                await goToProduct();
            }
        }
    });
}

const product = () => {
    imageProduct();
    showContent();

    const can = document.querySelector('#inp-cantidad');
    let cantidad = can.firstElementChild.nextElementSibling.value;

    can.firstElementChild.addEventListener('click', () => {
        if(cantidad != 1) {
            cantidad--;
            can.firstElementChild.nextElementSibling.value = cantidad;
        }
    });

    can.lastElementChild.addEventListener('click', () => {
        if(cantidad != can.dataset.stock) {
            cantidad++;
            can.firstElementChild.nextElementSibling.value = cantidad;
        }
    });

    showRandomProducts();
}