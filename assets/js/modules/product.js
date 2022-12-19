const imageProduct = () => {
    const form = (document.querySelector('#form-image-product') !== null) ? document.querySelector('#form-image-product') : null;

    if(form !== null) {
        linksImage('#form-image-product', ROUTES.FORMS.IMAGE.DELETEPRODUCT);
        formImage('#form-image-product', ROUTES.FORMS.IMAGE.PRODUCT); 
    } 
}

const renderVals = async (vals, container, min, max) => {
    let content = '';

    if(vals.length <= max) {
        max = vals.length;
    }

    for(let i = min; i < max; i++) {

        content += `<article class="my-4">
                    <div class="mx-3 px-2">
                    <b>${vals[i].nombre}</b>`
        if(vals[i].nivel == 1) {
            content += `<p>${vals[i].nivel} estrella</p>`;
        } else {
            content += `<p>${vals[i].nivel} estrellas</p>`;
        }
        
        content += `</div>
                    <div class="card-body border border-secondary border-opacity-50 rounded mx-3 p-3">`;
        if(vals[i].comentario.length >= 90) {
            content += `<p>${shortValue(vals[i].comentario, 90)}</p>
                        <a data-id="${i}" class="show-all-val link">Ver más</a>
                        <a data-id="${i}" class="hidden hidden-all-val link">Ver menos</a>`;
        } else {
            content += `<p>${vals[i].comentario}</p>`;
        }
        
        content += `</div>
                    <div class="mt-2 mx-3 px-2">
                    <small>${vals[i].fecha}</small>
                    </div>
                    </article>`;
    }

    container.insertAdjacentHTML('beforeend', content);

    const links = [...document.querySelectorAll('.show-all-val')];
    links.forEach(link => {
        link.addEventListener('click', () => {
            link.previousElementSibling.innerHTML = vals[link.dataset.id].comentario;
            link.classList.add('hidden');
            link.nextElementSibling.classList.remove('hidden');
        });
    });

    const unlinks = [...document.querySelectorAll('.hidden-all-val')];
    unlinks.forEach(unlink => {
        unlink.addEventListener('click', () => {
            unlink.parentElement.firstElementChild.innerHTML = shortValue(vals[unlink.dataset.id].comentario, 90);
            unlink.classList.add('hidden');
            unlink.previousElementSibling.classList.remove('hidden');
        });
    });
}

const showMoreVals = (vals, container, min, max, callback) => {
    const showMore = (document.querySelector('#show-more') !== null) ? document.querySelector('#show-more') : null;

    if(showMore !== null) {
        showMore.addEventListener('click', async () => {
            min += 3;
            max += 3;

            container.lastElementChild.remove();
            await renderVals(vals, container, min, max);

            if(vals.length > max) {
                container.insertAdjacentHTML('beforeend', `<a id="show-more" class="link">Mostrar más</a>`);
            }

            callback(vals, container, min, max, callback);
        });
    }
}

const getVals = () => {
    const vals = document.querySelector('#vals');
    let min = 0;
    let max = 3;

    get(ROUTES.VIEWS.VALS[0])
    .then(async response => {
        if(response.codigo == -1) {
            vals.insertAdjacentHTML('beforeend', `<h4 class="mx-3 mt-4">No hay valoraciones en este producto</h4>`);
        } else {
            response.datos = response.datos.reverse();

            await renderVals(response.datos, vals, min, max);
            if(response.datos.length > max) {
                vals.insertAdjacentHTML('beforeend', `<a id="show-more" class="link">Mostrar más</a>`);
            }

            showMoreVals(response.datos, vals, min, max, showMoreVals);
        }
    });
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

const formValValidate = async (form) => {
    const fieldsVal = {
        'estrellas' : false,
        'comentario' : false
    }

    const inputs = [...document.querySelectorAll('#form-val, select, textarea')];
    const groups = [...document.querySelectorAll('#form-val > div')];
    
    const estrellas = document.querySelector('#estrellas');

    await get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', e => {
                switch(e.target.name) {
                    case 'estrellas':
                        validateSelect(groups[0], e.target.value, fieldsVal, 'estrellas');
                        break;
                    case 'comentario':
                        validateField(RegExp(response.datos.descripcion), e.target.value, groups[1], fieldsVal, 'comentario');
                        break;
                }
            });
        });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(getValues().comentario == '') {
            fieldsVal['comentario'] = true;
        }

        if(!fieldsVal['estrellas'] || !fieldsVal['comentario']) {
            groups[2].previousElementSibling.style.cssText = 'display: block';
            groups[2].previousElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[2];
        } else {
            groups[2].previousElementSibling.style.cssText = 'display: none';
            groups[2].previousElementSibling.innerHTML = '';
            
            post(ROUTES.FORMS.VALS, {
                'estrellas' : estrellas.value,
                'comentario' : getValues().comentario
            })
            .then(response => {
                if(response.codigo == -1) {
                    let alerta = showAlert('alert-danger', response.mensaje);
                    main.insertAdjacentElement('afterbegin', alerta);
                } else {
                    if(main.firstElementChild.tagName == 'DIV') {
                        main.firstElementChild.remove();
                    }
                    const vals = [...document.querySelectorAll('#vals > article, h4')];
                    vals.forEach(v => v.remove());

                    getVals();
                }

                form.reset();
            })
            .catch(err => console.log(err));
        }
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
                    <h5 class="card-title text-primary mt-2">${shortValue(products[i].nombre, 20)}</h5>
                    </div>
                    <img src="../shop/uploads/images/products/${products[i].image}" class="card-image card-img-top" alt="${products[i].nombre}" />
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Precio Oferta:</b> ${products[i].precio}</li>
                    <li class="list-group-item"><b>Precio Normal:</b> ${products[i].precio}</li>
                    <li class="list-group-item"><b>Stock:</b> ${products[i].stock}</li>
                    </ul>
                    <div class="card-body d-flex flex-md-column flex-lg-row justify-content-between">
                    <a data-id="${products[i].id}" class="btn btn-primary bg-gradient mb-sm-0 mb-md-2 mb-lg-0 show-more">Ver más</a>
                    <a data-id="${products[i].id}" class="btn btn-primary bg-gradient add-to-cart">Añadir al carrito</a>
                    </div>
                    </div>
                    </article>`;
    }
    container.innerHTML += content;
}

const showRandomProducts = async () => {
    const content = document.querySelector('#contenido-producto');
    const randomProducts = document.querySelector('#random-products');

    await post(ROUTES.VIEWS.PRODUCTS[1], {
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

    const containerBody = [...document.querySelectorAll('#random-products .card-body')];

    if(randomProducts.dataset.user == 2) {
        containerBody.forEach(cb => {
            cb.lastElementChild.remove();
        });
    }
}

const product = async () => {
    imageProduct();
    showContent();

    const form = (document.querySelector('#form-val') !== null) ? document.querySelector('#form-val') : null;

    if(form !== null) {
        await formValValidate(form);
    }

    getVals();

    const rp = document.querySelector('#random-products');

    if(rp.dataset.user != 2) {
        const can = (document.querySelector('#inp-cantidad') !== null) ? document.querySelector('#inp-cantidad') : null;

        if(can != null) {
            let cantidad = can.firstElementChild.nextElementSibling.value;

            can.firstElementChild.addEventListener('click', () => {
                if(cantidad != 1) {
                    cantidad--;
                    can.firstElementChild.nextElementSibling.setAttribute('value', cantidad);
                    buy(Number(can.firstElementChild.nextElementSibling.value - (can.firstElementChild.nextElementSibling.value) - 1));
                }
            });
    
            can.lastElementChild.addEventListener('click', () => {
                if(cantidad != can.dataset.stock) {
                    cantidad++;
                    can.firstElementChild.nextElementSibling.setAttribute('value', cantidad);
                    buy(1);
                }
            });
        }
        await showRandomProducts();
        buy(Number(can.firstElementChild.nextElementSibling.value));
        await addToCart('#random-products');
    } else {
        await showRandomProducts();
    }
}