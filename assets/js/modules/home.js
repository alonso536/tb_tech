const showCategories = (categories) => {
    const category = document.querySelector('#accordionCategory');
    let contenido = '';

    for(let i = 0; i < categories.length; i++) {
        contenido += '<div class="accordion-item">' +
                    '<h2 class="accordion-header" id="panelsStayOpen-heading'+(i + 1)+'"> ' +
                    '<button data-id="'+(i + 1)+'" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'+(i + 1)+'" aria-expanded="false" aria-controls="panelsStayOpen-collapse'+(i + 1)+'">' +
                    categories[i].nombre +
                    '</button>' +
                    '</h2>' +
                    '<div id="panelsStayOpen-collapse'+(i + 1)+'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading'+(i + 1)+'">' +
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
            content += `<a data-cat="${i + 1}" data-subcat="${subCat}" class="cat-button">${sc.nombre}</a><br>`;
            subCat++;
        });

        content += `<a data-cat="${i + 1}" class="cat-button">Ver todos</a><br>`;
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

const showProduct = (products, container) => {
    let content = '';
    container.innerHTML = '';

    for(let i = 0; i < products.length; i++) {
        content += '<article class="col-sm-12 col-lg-6 g-3">' +
                '<div class="card shadow-sm">' +
                '<div class="card-header bg-primary bg-gradient bg-opacity-10">' +
                '<h5 class="card-title text-primary mt-2">'+products[i].nombre+'</h5>' +
                '</div>' +
                '<img src="..." class="card-img-top" alt="..." />' +
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
    container.innerHTML = content;
}

const showProducts = async () => {
    const container = document.querySelector('#productos');

    await get(ROUTES.VIEWS.PRODUCTS[0])
    .then(response => {
        showProduct(response.datos, container);
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
                    container.innerHTML = '<h2 class="text-center my-3">No se encontraron productos</h2>';
                } else {
                    showProduct(response.datos, container);
                }
            });
        });
    });
}

const getProducts = async () => {
    await getCategories();
    await showProducts();
}