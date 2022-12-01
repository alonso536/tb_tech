(function() {
    const views = [...document.querySelectorAll('.nav-link-log-out')];
    const viewsLogin = ([...document.querySelectorAll('.nav-link-log-in')] !== null) ? [...document.querySelectorAll('.nav-link-log-in')] : null;

    let view;

    const changeView = async (view) => {
        let request = await fetch(view);
        return await request.text();
    };

    document.addEventListener('DOMContentLoaded', () => {
        view = (main.getAttribute('data-view') === '') ? 0 : main.getAttribute('data-view');

        if(view == 0) {
            getCategories();
        }

        changeView(ROUTES.VIEWS[view])
        .then((response) => {
            main.innerHTML = '';
            main.innerHTML = `${response}`;
        });
    });

    for (let i = 0; i < views.length; i++) {
        views[i].addEventListener('click', () => {
            changeView(ROUTES.VIEWS[i])
            .then((response) => {
                main.innerHTML = '';
                main.innerHTML = `${response}`;

                main.setAttribute('data-view', i);

                switch(Number(main.getAttribute('data-view'))) {
                    case 0:
                        getCategories();
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

    if(viewsLogin !== null) {
        for(let i = 0; i < viewsLogin.length; i++) {
            viewsLogin[i].addEventListener('click', () => {
                changeView(ROUTES.VIEWS.USERS[i])
                .then((response) => {
                    main.innerHTML = '';
                    main.innerHTML = `${response}`;

                    if(i == 1) {
                        location.reload();
                    }
                });
            });
        }
    }
})();
