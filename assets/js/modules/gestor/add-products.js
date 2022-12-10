const fieldsProducts = {
    'nombreProducto': false,
    'descripcion': false,
    'precio': false,
    'stock': false,
    'categorias': false,
    'subcategorias': false,
    'marcas': false
};

const prevForm = async () => {
    const cat = document.querySelector('#categorias');
    const sub = document.querySelector('#subcategorias');
    const brand = document.querySelector('#marcas');

    sub.style.display = 'none';

    let contentCat = '';

    await get(ROUTES.VIEWS.CATEGORIES[0])
    .then(response => {
        response.datos.forEach(dato => {
            contentCat += `<option value="${dato.id}">${dato.nombre}</option>`;
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

    let contentBrand = '';

    await get(ROUTES.VIEWS.BRANDS[0])
    .then(response => {
        response.datos.forEach(dato => {
            contentBrand += `<option value="${dato.id}">${dato.nombre}</option>`;
        });
    });

    brand.insertAdjacentHTML('beforeend', contentBrand);
}

const validateField = (exp, value, group, obj, input) => {
    if(exp.test(value)) {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        obj[input] = true;
    } else {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = insertMessageError(input);
        obj[input] = false;
    }
}

const validateNumber = (group, value, obj, input) => {
    if(isNaN(value)) {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = `El ${input} solo puede contener números`;
        obj[input] = false;
    } else if(value == '') {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = `El ${input} solo puede contener números`;
        obj[input] = false;
    } else {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        obj[input] = true;
    }
}

const validateSelect = (group, value, obj, input) => {
    if(value > 0) {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        obj[input] = true;
    } else {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = 'Por favor escoge una opción';
        obj[input] = false;
    }
}

const formProductValidate = async () => {
    const inputs = [...document.querySelectorAll('#form-product input, textarea, select')];
    const groups = [...document.querySelectorAll('#form-product > div')];
    const form = document.querySelector('#form-product');

    const cat = document.querySelector('#categorias');
    const sub = document.querySelector('#subcategorias');
    const brand = document.querySelector('#marcas');

    await prevForm();

    await get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', e => {
                switch(e.target.name) {
                    case 'nombre-producto':
                        validateField(RegExp(response.datos.nombreProducto), e.target.value, groups[0], fieldsProducts, 'nombreProducto');
                        break;
                    case 'descripcion':
                        validateField(RegExp(response.datos.descripcion), e.target.value, groups[3], fieldsProducts, 'descripcion');
                        break;
                    case 'precio':
                        validateNumber(groups[1], e.target.value, fieldsProducts, 'precio');
                        break;
                    case 'stock':
                        validateNumber(groups[2], e.target.value, fieldsProducts, 'stock'); 
                        break;
                    case 'categorias':
                        validateSelect(groups[4], e.target.value, fieldsProducts, 'categorias');
                        break;
                    case 'subcategorias':
                        validateSelect(groups[5], e.target.value, fieldsProducts, 'subcategorias');
                        break;
                    case 'marcas':
                        validateSelect(groups[6], e.target.value, fieldsProducts, 'marcas');
                        break;
                }
            });
        });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(getValues().descripcion == '') {
            fieldsProducts['descripcion'] = true;
        }

        if(!fieldsProducts['nombreProducto'] || !fieldsProducts['descripcion'] || !fieldsProducts['precio'] || !fieldsProducts['stock'] || 
            !fieldsProducts['categorias'] || !fieldsProducts['subcategorias'] || !fieldsProducts['marcas']) {
            groups[7].previousElementSibling.style.cssText = 'display: block';
            groups[7].previousElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[2];
        } else {
            groups[7].previousElementSibling.style.cssText = 'display: none';
            groups[7].previousElementSibling.innerHTML = '';
            
            post(ROUTES.FORMS.PRODUCTS, {
                'nombre' : getValues().nombreProducto,
                'descripcion' : getValues().descripcion,
                'precio' : getValues().precio,
                'stock' : getValues().stock,
                'categoria' : cat.value,
                'subcategoria' : sub.value,
                'marca' : brand.value
            })
            .then(response => {
                let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje);
                main.insertAdjacentElement('afterbegin', alerta);
                form.reset();
            })
            .catch(err => console.log(err));
        }
    });
}