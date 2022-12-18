const changeViewGestor = async (view) => {
    let request = await fetch(view);
    return await request.text();
};

const changeViewPost = async (view, datos) => {
    let request = await fetch(view, {
        method: 'POST',
        body: 'datos=' + JSON.stringify(datos),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    });
    return await request.text();
};

const initGestor = async () => {
    const gestorMain = document.querySelector('#gestor-main');
    const links = [...document.querySelectorAll('.gestor-link')];
    const asideContent = document.querySelector('#aside-content');

    if(asideContent.dataset.active == 1) {
        await changeViewGestor(ROUTES.VIEWS.GESTOR.PROFILE)
        .then(response => {
            gestorMain.innerHTML = '';
            gestorMain.innerHTML = `${response}`;
            profile();
        });
    } else {
        await changeViewGestor(ROUTES.VIEWS.GESTOR.ACTIVE)
        .then(response => {
            gestorMain.innerHTML = '';
            gestorMain.innerHTML = `${response}`;
            activeAccount();
        });
    }


    links.forEach(link => {
        link.addEventListener('click', async () => {

            if(main.firstElementChild.tagName == 'DIV') {
                main.firstElementChild.remove();
            }

            switch(Number(link.dataset.id)) {
                case 1:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.PROFILE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    profile();
                    break;
                case 2:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.UPDATEPROFILE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    formUpdateProfile();
                    break;
                case 3:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.PRODUCTS)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    gestProducts();
                    break;
                case 4:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.ADDPRODUCTS)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    formProductValidate();
                    break;
                case 5:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.ORDERS)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    gestOrders();
                    break;
                case 6:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.VALS)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    break;
                case 7:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.DELETE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    desactAccount();
                    break;
                case 8: 
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.ACTIVE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    activeAccount();
                    break;
            }
        });
    });
}