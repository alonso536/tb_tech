(function() {
    const nav = document.querySelector('#nav');
    const views = [...document.querySelectorAll('.nav-link-log-out')];
    const viewsLogin = ([...document.querySelectorAll('.nav-link-log-in')] !== null) ? [...document.querySelectorAll('.nav-link-log-in')] : null;

    let view = (localStorage.getItem('view') !== null) ? localStorage.getItem('view') : 0;

    const changeView = async (view) => {
        let request = await fetch(view);
        return await request.text();
    };

    document.addEventListener('DOMContentLoaded', async () => {
        view = localStorage.getItem('view');

        if(view >= 5 && view < 10) {
            await changeView(ROUTES.VIEWS.USERS[view - 5])
            .then((response) => {
                main.innerHTML = '';
                main.innerHTML = `${response}`;

                switch(Number(view)) {
                    case 5:
                        initGestor();
                        break;
                    case 6:
                        initCart();
                        break;
                }
            });
        } else if(view == 4) {
            changeViewPost(ROUTES.VIEWS.PRODUCTS[2], {
                'id' : Number(localStorage.getItem('idProducto'))
            }).then((response) => {
                main.innerHTML = '';
                main.innerHTML = `${response}`;
                product();
            });
        } else if(view == 10) {
            await changeViewGestor(ROUTES.VIEWS.ORDER.CREATE)
            .then(response => {
                main.innerHTML = response;
            });
            await formCreateOrderValidate();
        } else if(view == 11) {
            await changeViewPost(ROUTES.VIEWS.ORDER.READ, {
                'id': Number(localStorage.getItem('idOrder'))
            })
            .then(response => {
                main.innerHTML = response;
            });
            getOrderDetail();
        } 
        else {
            await changeView(ROUTES.VIEWS[view])
            .then((response) => {
                main.innerHTML = '';
                main.innerHTML = `${response}`;

                switch(Number(view)) {
                    case 0:
                        getProducts();
                        break;
                    case 1: 
                        formLoginValidate();
                        break;
                    case 2: 
                        formRegisterValidate();
                        break;
                    case 3:
                        formPasswordRecoveryValidate();
                        break;
                }
            });
        }
    });

    for (let i = 0; i < views.length; i++) {
        views[i].addEventListener('click', () => {
            changeView(ROUTES.VIEWS[i])
            .then((response) => {
                main.innerHTML = '';
                main.innerHTML = `${response}`;

                main.dataset.view = i;
                localStorage.removeItem('idOrder');
                localStorage.removeItem('idProducto');
                localStorage.setItem('view', Number(main.dataset.view));

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

                    main.dataset.view = i + 5;
                    localStorage.removeItem('idOrder');
                    localStorage.removeItem('idProducto');
                    localStorage.setItem('view', Number(main.dataset.view));
                    
                    if(i == 0) {
                        initGestor();
                    }

                    if(i == 1) {
                        initCart();
                    }

                    if(i == 2) {
                        localStorage.setItem('view', 0);
                        location.reload();
                    }
                });
            });
        }
    }
})();
