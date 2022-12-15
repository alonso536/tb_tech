(function() {
    const nav = document.querySelector('#nav');
    const views = [...document.querySelectorAll('.nav-link-log-out')];
    const viewsLogin = ([...document.querySelectorAll('.nav-link-log-in')] !== null) ? [...document.querySelectorAll('.nav-link-log-in')] : null;

    let view;

    const changeView = async (view) => {
        let request = await fetch(view);
        return await request.text();
    };

    document.addEventListener('DOMContentLoaded', async () => {
        view = main.dataset.view;

        await changeView(ROUTES.VIEWS[view])
        .then((response) => {
            main.innerHTML = '';
            main.innerHTML = `${response}`;
        });
        getProducts();

        if(view == 3) {
            product();
        }
    });

    for (let i = 0; i < views.length; i++) {
        views[i].addEventListener('click', () => {
            changeView(ROUTES.VIEWS[i])
            .then((response) => {
                main.innerHTML = '';
                main.innerHTML = `${response}`;

                main.dataset.view = i;

                switch(Number(main.dataset.view)) {
                    case 0:
                        getProducts();
                        break;
                    case 1:
                        formLoginValidate();
                        break;
                    case 2:
                        formRegisterValidate();
                        break;
                }
            });
        });
    }

    if(nav.dataset.user == 2) {
        const cart = document.querySelector('#cart');
        cart.style.display = 'none';
    }

    if(viewsLogin !== null) {
        for(let i = 0; i < viewsLogin.length; i++) {
            viewsLogin[i].addEventListener('click', () => {
                if(main.firstElementChild.tagName == 'DIV') {
                    main.firstElementChild.remove();
                }
                changeView(ROUTES.VIEWS.USERS[i])
                .then((response) => {
                    main.innerHTML = '';
                    main.innerHTML = `${response}`;
                    
                    if(i == 0) {
                        initGestor();
                    }

                    if(i == 1) {
                        initCart();
                    }

                    if(i == 2) {
                        location.reload();
                    }
                });
            });
        }
    }
})();
