const hideSelect = (select) => {
    select.style.display = 'none';
}

const formProductValidate = async () => {
    const cat = document.querySelector('#categorias');
    const sub = document.querySelector('#subcategorias');

    hideSelect(sub);

    let contentCat = '';

    await get(ROUTES.VIEWS.CATEGORIES[0])
    .then(response => {
        response.datos.forEach(dato => {
            contentCat += `<option value="${dato.id}">${dato.nombre}</option>`
        });
    });

    cat.insertAdjacentHTML('beforeend', contentCat);

    cat.addEventListener('change', async () => {
        let contentSub = '';

        if(cat.selectedIndex > 0) {
            sub.style.display = 'block';

            await post(ROUTES.VIEWS.CATEGORIES[2], {
                'categoria' : cat.selectedIndex
            })
            .then(response => {
                response.datos.forEach(dato => {
                    sub.innerHTML = '<option disabled selected>Sub-Categorías</option>';
                    contentSub += `<option value="${dato.id}">${dato.nombre}</option>`;
                });
            });
            sub.insertAdjacentHTML('beforeend', contentSub);
        }
    });
}