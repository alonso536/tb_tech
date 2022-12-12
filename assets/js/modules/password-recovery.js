const fieldsRecovery = {
    'email': false,
    'password': false,
    'password2': false
}

const hiddenGroups = (...args) => {
    args.forEach(arg => {
        arg.style.display = 'none';
    });
}

const showGroups = (...args) => {
    args.forEach(arg => {
        arg.style.display = 'block';
    });
}

const validateRecovery = (exp, value, group, obj, input) => {
    if(RegExp(exp).test(value)) {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        obj[input] = true;
    } else {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = insertMessageError(input);
        obj[input] = false;
    }
}

const passwordRecoveryTwoValidate = (group, obj) => {
    const compare = () => {
        if(getValues().password === getValues().password2) {
            return true;
        } 
        return false;
    }

    if(compare()) {
        group.nextElementSibling.style.cssText = 'display: none';
        group.nextElementSibling.innerHTML = '';
        obj['password2'] = true;
    } else {
        group.nextElementSibling.style.cssText = 'display: block';
        group.nextElementSibling.innerHTML = insertMessageError('password2');
        obj['password2'] = false;
    }
}

const formPasswordRecoveryValidate = () => {
    const inputs1 = [...document.querySelectorAll('#form-password-recovery input')];
    const inputs2 = [...document.querySelectorAll('#form-send-password input')];
    const groups1 = [...document.querySelectorAll('#form-password-recovery > div')];
    const groups2 = [...document.querySelectorAll('#form-send-password > div')];
    const form1 = document.querySelector('#form-password-recovery');
    const form2 = document.querySelector('#form-send-password');
    const paragraph = document.querySelector('#paragraph');

    form2.style.display = 'none';

    get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs1[0].addEventListener('blur', e => {
            validateRecovery(RegExp(response.datos.email), e.target.value, groups1[0], fieldsRecovery, 'email');
        });

        form1.addEventListener('submit', e => {
            e.preventDefault();
            if(!fieldsRecovery['email']) {
                groups1[1].previousElementSibling.style.cssText = 'display: block';
                groups1[1].previousElementSibling.innerHTML = 'El email es obligatorio';
            } else {
                groups1[1].previousElementSibling.style.cssText = 'display: none';
                groups1[1].previousElementSibling.innerHTML = '';
                
                post(ROUTES.FORMS.PASSWORDRECOVERY, {
                    'email' : getValues().email
                })
                .then(response => {
                    if(response.codigo == -1) {
                        groups1[1].previousElementSibling.style.cssText = 'display: block';
                        groups1[1].previousElementSibling.innerHTML = response.mensaje;
                    } else {
                        form1.remove();
                        form2.style.display = 'block';
                        paragraph.innerHTML = 'Escoge una nueva contraseña, asegurate de que tenga letras mayúsculas, minúsculas, números y símbolos';
                    }
                    
                    form1.reset();
                })
                .catch(err => console.log(err));
            }
        });

        inputs2[0].addEventListener('blur', e => {
            validateRecovery(RegExp(response.datos.password), e.target.value, groups2[0], fieldsRecovery, 'password');
            if(e.target.value !== undefined) {
                passwordRecoveryTwoValidate(groups2[1], fieldsRecovery);
            }
        });

        inputs2[1].addEventListener('blur', e => {
            passwordRecoveryTwoValidate(groups2[1], fieldsRecovery);
        });

        form2.addEventListener('submit', e => {
            e.preventDefault();

            if(!fieldsRecovery['password'] || !fieldsRecovery['password2']) {
                groups2[2].previousElementSibling.style.cssText = 'display: block';
                groups2[2].previousElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[0];
            } else {
                groups2[2].previousElementSibling.style.cssText = 'display: none';
                groups2[2].previousElementSibling.innerHTML = '';

                post(ROUTES.FORMS.SENDPASSWORDRECOVERY, {
                    'password' : getValues().password
                })
                .then(response => {
                    let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje);
                    main.insertAdjacentElement('afterbegin', alerta);
                    console.log(response);
                    form2.reset();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                });
            }
        });
    });
}