const fieldsUpdatePassword = {
    'password': false,
    'password2': false
}

const formUpdatePasswordValidate = () => {
    const inputs = [...document.querySelectorAll('#form-update-password input')];
    const groups = [...document.querySelectorAll('#form-update-password > div')];
    const form = document.querySelector('#form-update-password');

    get(ROUTES.RESOURCES.EXP)
    .then(response => {
        inputs.forEach(input => {
            input.addEventListener('blur', (e) => {
                switch(e.target.name) {
                    case 'password':
                        validateRecovery(RegExp(response.datos.password), e.target.value, groups[0], fieldsUpdatePassword, 'password');
                        if(e.target.value !== undefined) {
                            passwordTwoValidate(groups[1]);
                        }
                        break;
                    case 'password2':
                        passwordRecoveryTwoValidate(groups[1], fieldsUpdatePassword);
                    break;
                }
            });
        });
    });

    form.addEventListener('submit', e => {
        e.preventDefault();

        if(!fieldsUpdatePassword['password'] || !fieldsUpdatePassword['password2']) {
            groups[2].previousElementSibling.style.cssText = 'display: block';
            groups[2].previousElementSibling.innerHTML = ROUTES.MESSAGES.WARNING[0];
        } else {
            groups[2].previousElementSibling.style.cssText = 'display: none';
            groups[2].previousElementSibling.innerHTML = '';

            post(ROUTES.FORMS.SENDPASSWORDRECOVERY, {
                'password' : getValues().password
            })
            .then(response => {
                let alerta = (response.codigo == -1) ? showAlert('alert-danger', response.mensaje) : showAlert('alert-success', response.mensaje);
                main.insertAdjacentElement('afterbegin', alerta);
                localStorage.setItem('view', 0);
                form.reset();
                setTimeout(() => {
                    location.reload();
                }, 1000);
            });
        }
    });
}