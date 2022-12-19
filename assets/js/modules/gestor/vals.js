const listVals = (vals, list) => {
    let content = '';

    vals = vals.reverse();

    for(let i = 0; i < vals.length; i++) {
        content += `<tr><td scope="row">${vals[i].id}</td>`+
                    `<td><a data-id="${vals[i].producto_id}" class="show-more link">${vals[i].producto_id}</a></td>`+
                    `<td>${vals[i].nivel}</td>`+
                    `<td>${shortValue(vals[i].comentario, 30)}</td>`+
                    `<td><a data-id="${vals[i].id}" class="delete-val link">Borrar</a></td></tr>`;
    }

    list.innerHTML = content;
}

const gestVals = async () => {
    const list = document.querySelector('#list-vals');
    const gestorMain = document.querySelector('#gestor-main');

    await post(ROUTES.VIEWS.VALS[1], {
        'id' : list.dataset.id
    })
    .then(response => {
        if(response.codigo == -1) {
            gestorMain.lastElementChild.remove();
            gestorMain.innerHTML += '<h4 class="text-center my-3">No has hecho ninguna valoración</h4>';
        } else {
            listVals(response.datos, list);
        }
    });

    const deletes = [...document.querySelectorAll('.delete-val')];

    deletes.forEach(del => {
        del.addEventListener('click', () => {
            post(ROUTES.VIEWS.VALS[2], {
                'id' : del.dataset.id
            })
            .then(response => {
                console.log(response);
                gestVals();
            });
        });
    });

    await goToProduct();
}