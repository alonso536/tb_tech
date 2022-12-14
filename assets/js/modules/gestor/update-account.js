const activeAccount = () => {
    const active = document.querySelector('#active-account');

    active.addEventListener('click', () => {
        post(ROUTES.FORMS.ACCOUNT, {
            'activo': false
        })
        .then(response => {
            if(response.codigo == -1) {
                console.log(response);
            } else {
                location.reload();
            }
        });
    });
}

const desactAccount = () => {
    const desact = document.querySelector('#desact-account');

    desact.addEventListener('click', () => {
        post(ROUTES.FORMS.ACCOUNT, {
            'activo': true
        })
        .then(response => {
            if(response.codigo == -1) {
                console.log(response);
            } else {
                location.reload();
            }
        });
    });
}