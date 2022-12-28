const fieldsUpdateProfile = {
    'nombre': true,
    'apellido': true,
    'fono': true
};


const formUpdateProfile = () => {
    const inputs = [...document.querySelectorAll('#form-update-profile input')];
    const groups = [...document.querySelectorAll('#form-update-profile > div')];
    const form = document.querySelector('#form-update-profile');
    const check = document.querySelector('#terminos');

    get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', (e) => {
                switch(e.target.name) {
                    case 'nombre':
                        validateField(RegExp(response.datos.nombre), e.target.value, groups[0], fieldsUpdateProfile, 'nombre');
                        break;
                    case 'apellido':
                        validateField(RegExp(response.datos.nombre), e.target.value, groups[1], fieldsUpdateProfile, 'apellido');
                        break;
                    case 'fono':
                            validateField(RegExp(response.datos.fono), e.target.value, groups[2], fieldsUpdateProfile, 'fono');
                        break;
                }
            });
        });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(!fieldsUpdateProfile['nombre'] || !fieldsUpdateProfile['apellido'] || !fieldsUpdateProfile['fono']) {
            groups[3].nextElementSibling.style.cssText = 'display: block';
            groups[3].nextElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[0];
        } else if(!check.checked) {
            groups[3].nextElementSibling.style.cssText = 'display: block';
            groups[3].nextElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[1];
        } else {
            groups[3].nextElementSibling.style.cssText = 'display: none';
            groups[3].nextElementSibling.innerHTML = '';
            
            post(ROUTES.FORMS.UPDATEPROFILE, {
                'nombre' : getValues().nombre,
                'apellido' : getValues().apellido,
                'fono' : getValues().fono
            })
            .then(response => {
                let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje);
                main.insertAdjacentElement('afterbegin', alerta);
                form.reset();
                localStorage.setItem('view', 0);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            })
            .catch(err => console.log(err));
        }
    });

    const gestorMain = document.querySelector('#gestor-main');
    const updatePassword = document.querySelector('#update-password');

    updatePassword.addEventListener('click', () => {
        changeViewGestor(ROUTES.VIEWS.GESTOR.UPDATEPASSWORD)
        .then(response => {
            gestorMain.innerHTML = response;
            formUpdatePasswordValidate();
        });
    });
}