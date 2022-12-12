const enableLinks = () => {
    const links = [...document.querySelectorAll('.nav-link-login')];

    for(let i = 0; i < links.length; i++) {
        links[i].addEventListener('click', async () => {
            let request = await fetch(ROUTES.VIEWS[i + 2]);
            let response = await request.text();
    
            main.innerHTML = '';
            main.innerHTML = response;

            main.dataset.view = i + 2;

            switch(Number(main.dataset.view)) {
                case 2:
                    formRegisterValidate();
                    break;
                case 3:
                    formPasswordRecoveryValidate();
                    break;
            }
        });
    }
}

const formLoginValidate = () => {
    const form = document.querySelector('#form-login');
    let alerta = form.firstElementChild.nextElementSibling.nextElementSibling;

    enableLinks();

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        post(ROUTES.FORMS.LOGIN, {
            'email' : getValues().email,
            'password' : getValues().password
        })
        .then(response => {
            if(response.codigo == 1) {
                location.reload();
            } else {
                alerta.style.cssText = 'display: block';
                alerta.innerHTML = response.mensaje;
            }
        }).catch(err => console.log(err));
    });
}