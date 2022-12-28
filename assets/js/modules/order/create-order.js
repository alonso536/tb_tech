const fieldsOrders = {
    'regiones': false,
    'direccion': false
}

const getRegiones = async () => {
    const reg = document.querySelector('#regiones');

    let content = '';

    await get(ROUTES.VIEWS.REGS[0])
    .then(response => {
        response.datos.forEach(dato => {
            content += `<option value="${dato.id}">${dato.nombre}</option>`;
        });
    });

    reg.innerHTML += content;
}

const formCreateOrderValidate = async () => {
    const inputs = [...document.querySelectorAll('#form-order, input, select')];
    const groups = [...document.querySelectorAll('#form-order > div')];
    const form = document.querySelector('#form-order');
    
    const reg = document.querySelector('#regiones');

    await getTotalCart();
    await getRegiones();

    await get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', e => {
                switch(e.target.name) {
                    case 'regiones':
                        validateSelect(groups[0], e.target.value, fieldsOrders, 'regiones');
                        break;
                    case 'direccion':
                        validateField(RegExp(response.datos.direccion), e.target.value, groups[1], fieldsOrders, 'direccion');
                        break;
                }
            });
        });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(!fieldsOrders['regiones'] || !fieldsOrders['direccion']) {
            groups[2].previousElementSibling.style.cssText = 'display: block';
            groups[2].previousElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[2];
        } else {
            groups[2].previousElementSibling.style.cssText = 'display: none';
            groups[2].previousElementSibling.innerHTML = '';
            
            post(ROUTES.FORMS.ORDERS, {
                'region' : reg.value,
                'direccion' : getValues().direccion
            })
            .then(response => {
                if(main.firstElementChild.tagName == 'DIV') {
                    main.firstElementChild.remove();
                }
                window.scrollTo(0, 0);
                let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje + '. ' + '<a id="go-to-order" data-id="'+response.datos+'" class="link">Ver pedido</a>');
                main.insertAdjacentElement('afterbegin', alerta);
                form.reset();

                const goToOrder = (document.querySelector('#go-to-order') !== null) ? document.querySelector('#go-to-order') : null;

                if(goToOrder !== null) {
                    goToOrder.addEventListener('click', async () => {
                        await changeViewPost(ROUTES.VIEWS.ORDER.READ, {
                            'id': goToOrder.dataset.id
                        })
                        .then(response => {
                            localStorage.setItem('idOrder', goToOrder.dataset.id);
                            localStorage.setItem('view', 11);
                            main.innerHTML = response;
                        });
                        getOrderDetail();
                    });
                }
            })
            .catch(err => console.log(err));
        }
    });
};