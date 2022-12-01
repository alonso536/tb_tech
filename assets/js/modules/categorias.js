const showCategories = (categories) => {
    const category = document.querySelector('#accordionCategory');
    let contenido = '';

    for(let i = 0; i < categories.length; i++) {
        contenido += '<div class="accordion-item">' +
                    '<h2 class="accordion-header" id="panelsStayOpen-heading'+(i + 1)+'"> ' +
                    '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'+(i + 1)+'" aria-expanded="false" aria-controls="panelsStayOpen-collapse'+(i + 1)+'">' +
                    categories[i].nombre +
                    '</button>' +
                    '</h2>' +
                    '<div id="panelsStayOpen-collapse'+(i + 1)+'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading'+(i + 1)+'">' +
                    '<div class="accordion-body">' +
                    'Lorem ipsum' +
                    '</div>' +
                    '</div>' +
                    '</div>';
    }
    category.innerHTML = contenido;
}

const getCategories = () => {
    get(ROUTES.VIEWS.CATEGORIES[0])
    .then(response => {
        showCategories(response.datos);
    });
}