const changeViewGestor = async (view) => {
    let request = await fetch(view);
    return await request.text();
};

const initGestor = () => {
    const gestorMain = document.querySelector('#gestor-main');
    const links = [...document.querySelectorAll('.gestor-link')];

    changeViewGestor(ROUTES.VIEWS.GESTOR.PROFILE)
    .then(response => {
        gestorMain.innerHTML = '';
        gestorMain.innerHTML = `${response}`;
    });

    links.forEach(link => {
        link.addEventListener('click', async () => {

            switch(Number(link.dataset.id)) {
                case 1:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.PROFILE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    break;
                case 2:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.UPDATEPROFILE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    break;
                case 3:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.PRODUCTS)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
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
                    break;
                case 6:
                    await changeViewGestor(ROUTES.VIEWS.GESTOR.DELETE)
                    .then(response => {
                        gestorMain.innerHTML = '';
                        gestorMain.innerHTML = `${response}`;
                    });
                    break;
            }
        });
    });
}