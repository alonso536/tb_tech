const fields = {
    'nombre': false,
    'apellido': false,
    'email': false,
    'fono': false,
    'password': false,
    'password2': false
};

const insertMessageError = (input) => {
    values = getValues();

    if(input === 'nombre') {
        if(values.nombre.length < 2) return ROUTES.MESSAGES.NAME[0];
        else if(values.nombre.length > 25) return ROUTES.MESSAGES.NAME[1];
        else return ROUTES.MESSAGES.NAME[2];
    } else if(input === 'apellido') {
        if(values.apellido.length < 2) return ROUTES.MESSAGES.APELLIDO[0];
        else if(values.apellido.length > 25) return ROUTES.MESSAGES.APELLIDO[1];
        else return ROUTES.MESSAGES.APELLIDO[2];
    } else if(input === 'email') {
        if(!values.email.includes('@')) return ROUTES.MESSAGES.EMAIL[0];
        else return ROUTES.MESSAGES.EMAIL[1];
    } else if(input === 'fono') {
        if(isNaN(values.fono)) return ROUTES.MESSAGES.FONO[0];
        else if(values.fono.length < 7) return ROUTES.MESSAGES.FONO[1];
        else if(values.fono.length > 14) return ROUTES.MESSAGES.FONO[2];
        else return ROUTES.MESSAGES.FONO[0];
    } else if(input === 'password') {
        if(values.password.length < 8 || values.password.length > 16) return ROUTES.MESSAGES.PASSWORD[0];
        else return ROUTES.MESSAGES.PASSWORD[1];
    } else if(input === 'password2') {
        if(values.password !== values.password2) return ROUTES.MESSAGES.PASSWORD[2];
        else return ROUTES.MESSAGES.PASSWORD[1];
    } else if(input === 'nombreProducto') {
        if(values.nombreProducto.length < 2) return ROUTES.MESSAGES.NAME[0];
        else return ROUTES.MESSAGES.NAME[3];
    } else if(input === 'descripcion') {
        if(values.descripcion.length > 255) return ROUTES.MESSAGES.DESCRIPTION[0];
        else return ROUTES.MESSAGES.DESCRIPTION[1];
    }

    return '';
};

const passwordTwoValidate = (group) => {
    values = getValues();

    const compare = () => {
        if(values.password === values.password2) {
            return true;
        } 
        return false;
    }

    if(compare()) {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        fields['password2'] = true;
    } else {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = insertMessageError('password2');
        fields['password2'] = false;
    }
};

const validate = (exp, value, group, input) => {
    if(exp.test(value)) {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        fields[input] = true;
    } else {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = insertMessageError(input);
        fields[input] = false;
    }
};

const showAlert = (alert, mensaje) => {
    let alerta = document.createElement('div');
    alerta.classList.add('alert', alert);
    alerta.innerHTML = mensaje;

    return alerta;
}

const formRegisterValidate = () => {
    const inputs = [...document.querySelectorAll('#form-register input')];
    const groups = [...document.querySelectorAll('#form-register > div')];
    const form = document.querySelector('#form-register');
    const check = document.querySelector('#terminos');

    get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', (e) => {
                switch(e.target.name) {
                    case 'nombre':
                        validate(RegExp(response.datos.nombre), e.target.value, groups[0], 'nombre');
                        break;
                    case 'apellido':
                        validate(RegExp(response.datos.nombre), e.target.value, groups[1], 'apellido');
                        break;
                    case 'email':
                        validate(RegExp(response.datos.email), e.target.value, groups[2], 'email');
                        break;
                    case 'fono':
                            validate(RegExp(response.datos.fono), e.target.value, groups[3], 'fono');
                        break;
                    case 'password':
                        validate(RegExp(response.datos.password), e.target.value, groups[4], 'password');
                        if(e.target.value !== undefined) {
                            passwordTwoValidate(groups[5]);
                        }
                        break;
                    case 'password2':
                        passwordTwoValidate(groups[5]);
                    break;
                }
            });
        
            input.addEventListener('focus', () => {
                if(main.firstElementChild.classList.contains('alert')) {
                    main.firstElementChild.remove();
                }
            });
        });
    });
    

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(!fields['nombre'] || !fields['apellido'] || !fields['email'] || !fields['fono'] || !fields['password'] || !fields['password2']) {
            groups[6].nextElementSibling.style.cssText = 'display: block';
            groups[6].nextElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[0];
        } else if(!check.checked) {
            groups[6].nextElementSibling.style.cssText = 'display: block';
            groups[6].nextElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[1];
        } else {
            groups[6].nextElementSibling.style.cssText = 'display: none';
            groups[6].nextElementSibling.innerHTML = '';
            
            post(ROUTES.FORMS.REGISTER, {
                'nombre' : getValues().nombre,
                'apellido' : getValues().apellido,
                'email' : getValues().email,
                'fono' : getValues().fono,
                'password' : getValues().password
            })
            .then(response => {
                let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje);
                main.insertAdjacentElement('afterbegin', alerta);
                form.reset();
            })
            .catch(err => console.log(err));
        }
    });
};