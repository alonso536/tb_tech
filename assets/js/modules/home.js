const showCategories = (categories) => {
    const category = document.querySelector('#accordionCategory');
    let contenido = '';

    for(let i = 0; i < categories.length; i++) {
        contenido += '<div class="accordion-item">' +
                    '<h2 class="accordion-header" id="flush-heading'+(i + 1)+'"> ' +
                    '<button data-id="'+(i + 1)+'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse'+(i + 1)+'" aria-expanded="false" aria-controls="flush-collapse'+(i + 1)+'">' +
                    categories[i].nombre +
                    '</button>' +
                    '</h2>' +
                    '<div id="flush-collapse'+(i + 1)+'" class="accordion-collapse collapse" aria-labelledby="flush-heading'+(i + 1)+'" data-bs-parent="#accordionCategory">' +
                    '<div class="accordion-body">' +
                    '</div>' +
                    '</div>' +
                    '</div>';
    }
    category.innerHTML = contenido;
}

const showSubcategories = (subCats) => {
    const buttons = [...document.querySelectorAll('.accordion-button')];
    const sc = [...document.querySelectorAll('.accordion-body')]; 
    let subCat = 1;

    for(let i = 0; i < 10; i++){
        let subCategories = subCats.filter(sc => sc.categoria_id == buttons[i].dataset.id);
        let content = '';
        subCategories.forEach(sc => {
            content += `<a data-cat="${i + 1}" data-subcat="${subCat}" class="cat-button">${sc.nombre}</a>`;
            subCat++;
        });

        content += `<a data-cat="${i + 1}" class="cat-button">Ver todos</a>`;
        sc[i].innerHTML = content;
    }
}

const getCategories = async () => {
    await get(ROUTES.VIEWS.CATEGORIES[0])
    .then(response => {
        showCategories(response.datos);
    });

    await get(ROUTES.VIEWS.CATEGORIES[1])
    .then(response => {
        showSubcategories(response.datos);
    });
}

const shortValue = (value, length) => {
    return (value.length > length) ? value.substring(0, length)+'...' : value;
}

const showProduct = (products, container, limit = 0) => {
    let content = '';
    let max = (products.length >= 6) ? (limit + 6) : products.length;
    let diferencia = products.length - limit;

    if(diferencia < 6) {
        max = limit + diferencia;
    }

    container.innerHTML = '';
    if(container.dataset.user == 2) {
        for(let i = limit; i < max; i++) {
            if(products[i].image == null) {
                products[i].image = 'product-default.png';
            }

            content += '<article class="col-sm-12 col-lg-6 g-3">' +
                    '<div class="card shadow-sm">' +
                    '<div class="card-header bg-primary bg-gradient bg-opacity-10">' +
                    '<h5 class="card-title text-primary mt-2">'+shortValue(products[i].nombre, 25)+'</h5>' +
                    '</div>' +
                    '<img src="../shop/uploads/images/products/'+products[i].image+'" class="card-img-top" alt="'+products[i].nombre+'" />' +
                    '<ul class="list-group list-group-flush">' +
                    '<li class="list-group-item"><b>Precio Oferta:</b> '+products[i].precio+'</li>' +
                    '<li class="list-group-item"><b>Precio Normal:</b> '+products[i].precio+'</li>' +
                    '<li class="list-group-item"><b>Stock:</b> '+products[i].stock+'</li>' +
                    '</ul>' +
                    '<div class="card-body d-flex justify-content-between">' +
                    '<a href="#" class="btn btn-primary bg-gradient">Ver más</a>' +
                    '</div>' +
                    '</div>' +
                    '</article>';
        }
    } else {
        for(let i = limit; i < max; i++) {
            if(products[i].image == null) {
                products[i].image = 'product-default.png';
            }

            content += '<article class="col-sm-12 col-lg-6 g-3">' +
                    '<div class="card shadow-sm">' +
                    '<div class="card-header bg-primary bg-gradient bg-opacity-10">' +
                    '<h5 class="card-title text-primary mt-2">'+shortValue(products[i].nombre, 25)+'</h5>' +
                    '</div>' +
                    '<img src="../shop/uploads/images/products/'+products[i].image+'" class="card-img-top" alt="'+products[i].nombre+'" />' +
                    '<ul class="list-group list-group-flush">' +
                    '<li class="list-group-item"><b>Precio Oferta:</b> '+products[i].precio+'</li>' +
                    '<li class="list-group-item"><b>Precio Normal:</b> '+products[i].precio+'</li>' +
                    '<li class="list-group-item"><b>Stock:</b> '+products[i].stock+'</li>' +
                    '</ul>' +
                    '<div class="card-body d-flex justify-content-between">' +
                    '<a href="#" class="btn btn-primary bg-gradient">Ver más</a>' +
                    '<a href="#" class="btn btn-primary bg-gradient">Añadir al carrito</a>' +
                    '</div>' +
                    '</div>' +
                    '</article>';
        }
    }

    container.innerHTML = content;
}

const detectPags = (element) => {
    return element.dataset.id;
}

const createPags = (products) => {
    const paginador = document.querySelector('#paginador');
    let pags = Math.ceil(products.length / 6);
    let actualPag = 1;
    let content = '';

    if(pags == 1) {
        paginador.style.opacity = '0';
    } else {
        paginador.style.opacity = '1';
    }

    for(let i = 0; i < pags; i++) {
        content += `<a data-id="${i + 1}" class="link pag-link px-2">${i + 1}</a>`;
    }

    paginador.firstElementChild.nextElementSibling.innerHTML = content;
    let pagLinks = [...document.querySelectorAll('.pag-link')];
    pagLinks[0].classList.add('pag-link-show');
    paginador.firstElementChild.firstElementChild.style.cssText = 'display: none';

    showProduct(products, paginador.previousElementSibling);

    const changePag = (indice, actualPag) => {
        window.scrollTo(0, 200);

        for(let j = 0; j < pagLinks.length; j++) {
            if(pagLinks[j].classList.contains('pag-link-show')) {
                pagLinks[j].classList.remove('pag-link-show');
                break;
            }
        }
        pagLinks[indice].classList.add('pag-link-show');

        showProduct(products, paginador.previousElementSibling, ((actualPag - 1) * 6));
        (actualPag == 1) ? paginador.firstElementChild.firstElementChild.style.cssText = 'display: none' : paginador.firstElementChild.firstElementChild.style.cssText = 'display: block';
        (actualPag == pags) ? paginador.lastElementChild.firstElementChild.style.cssText = 'display: none' : paginador.lastElementChild.firstElementChild.style.cssText = 'display: block';
    }

    for(let i = 0; i < pagLinks.length; i++) {
        pagLinks[i].addEventListener('click', () => {
            actualPag = detectPags(pagLinks[i]);    
            changePag(i, actualPag);
        });
    }

    paginador.firstElementChild.firstElementChild.addEventListener('click', () => {
        actualPag--;
        changePag(actualPag - 1, actualPag);
    });

    paginador.lastElementChild.firstElementChild.addEventListener('click', () => {
        actualPag++;
        changePag(actualPag - 1, actualPag);
    });
}

const paginator = (response) => {
    let products = [];
    products = products.concat(response);

    createPags(products);
}

const showProducts = async () => {
    const container = document.querySelector('#productos');

    await get(ROUTES.VIEWS.PRODUCTS[0])
    .then(response => {
        if(response.codigo == -1) {
            container.innerHTML = '<h2 class="text-center my-3">No se encontraron productos</h2>';
            container.nextElementSibling.style.opacity = '0';
        } else {
            container.nextElementSibling.style.opacity = '1';
            paginator(response.datos);
        }
    });

    const buttons = [...document.querySelectorAll('.cat-button')];
    
    buttons.forEach(button => {
        button.addEventListener('click', async () => {
            await post(ROUTES.VIEWS.PRODUCTS[1], {
                'categoria' : button.dataset.cat,
                'subcategoria' : (button.dataset.subcat !== undefined) ? button.dataset.subcat : null
            })
            .then(response => {
                if(response.codigo == -1) {
                    window.scrollTo(0, 200);
                    container.innerHTML = '<h2 class="text-center my-3">No se encontraron productos</h2>';
                    container.nextElementSibling.style.opacity = '0';
                } else {
                    window.scrollTo(0, 200);
                    container.nextElementSibling.style.opacity = '1';
                    paginator(response.datos);
                }
            });
        });
    });
}

const getProducts = async () => {
    await getCategories();
    await showProducts();
}