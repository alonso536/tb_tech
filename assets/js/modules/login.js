const enableLinks = () => {
    const links = [...document.querySelectorAll('.link')];

    links[0].addEventListener('click', async () => {
        let request = await fetch(ROUTES.VIEWS[2]);
        let response = await request.text();

        main.setAttribute('data-view', 2);
        main.innerHTML = response;
    });
}

const formLoginValidate = () => {
    const form = document.querySelector('#form-login');
    let alerta = form.firstElementChild.nextElementSibling.nextElementSibling;

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