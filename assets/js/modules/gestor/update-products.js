const fieldsProductsUpdate = {
    'nombreProducto': true,
    'descripcion': true,
    'precio': true,
    'stock': true
};

const formProductUpdateValidate = async () => {
    const inputs = [...document.querySelectorAll('#form-update-product input, textarea')];
    const groups = [...document.querySelectorAll('#form-update-product > div')];
    const form = document.querySelector('#form-update-product');

    await get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', e => {
                switch(e.target.name) {
                    case 'nombre-producto':
                        validateField(RegExp(response.datos.nombreProducto), e.target.value, groups[0], fieldsProductsUpdate, 'nombreProducto');
                        break;
                    case 'descripcion':
                        validateField(RegExp(response.datos.descripcion), e.target.value, groups[3], fieldsProductsUpdate, 'descripcion');
                        break;
                    case 'precio':
                        validateNumber(groups[1], e.target.value, fieldsProductsUpdate, 'precio');
                        break;
                    case 'stock':
                        validateNumber(groups[2], e.target.value, fieldsProductsUpdate, 'stock'); 
                        break;
                }
            });
        });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(getValues().descripcion == '') {
            fieldsProductsUpdate['descripcion'] = true;
        }

        if(!fieldsProductsUpdate['nombreProducto'] || !fieldsProductsUpdate['descripcion'] || 
            !fieldsProductsUpdate['precio'] || !fieldsProductsUpdate['stock']) {
            groups[4].previousElementSibling.style.cssText = 'display: block';
            groups[4].previousElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[2];
        } else {
            groups[4].previousElementSibling.style.cssText = 'display: none';
            groups[4].previousElementSibling.innerHTML = '';
            
            post(ROUTES.FORMS.UPDATEPRODUCTS, {
                'nombre' : getValues().nombreProducto,
                'descripcion' : getValues().descripcion,
                'precio' : getValues().precio,
                'stock' : getValues().stock
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