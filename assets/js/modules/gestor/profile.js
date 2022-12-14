const linksImage = (formImage, route) => {
    const addImage = (document.querySelector('#add-image') !== null) ? document.querySelector('#add-image') : null;
    const updateImage = (document.querySelector('#update-image') !== null) ? document.querySelector('#update-image') : null;
    const deleteImage = (document.querySelector('#delete-image') !== null) ? document.querySelector('#delete-image') : null;

    const form = (document.querySelector(formImage) !== null) ? document.querySelector(formImage) : null;

    if(addImage != null) {
        addImage.addEventListener('click', () => {
            form.classList.toggle('hidden');
        });
    }

    if(updateImage != null) {
        updateImage.addEventListener('click', () => {
            form.classList.toggle('hidden');
        });
    }

    if(deleteImage != null) {
        deleteImage.addEventListener('click', () => {
            post(route, {
                'image' : deleteImage.dataset.image
            })
            .then(response => {
                if(response.codigo == -1) {
                    img.nextElementSibling.style.display = 'block';
                    img.nextElementSibling.innerHTML = response.mensaje;
                } else {
                    location.reload();
                }
            });
        });
    }
}

const formImage = (formImage, route) => {
    const form = (document.querySelector(formImage) !== null) ? document.querySelector(formImage) : null;
    const img = (document.querySelector('#img') !== null) ? document.querySelector('#img') : null;

    form.addEventListener('submit', e => {
        e.preventDefault();
        img.nextElementSibling.style.display = 'none';

        if(img.value == '') {
            img.nextElementSibling.style.display = 'block';
            img.nextElementSibling.innerHTML = 'Debes seleccionar un archivo';
        } else {
            let data = new FormData(form);

            postImg(route, data)
            .then(response => {
                if(response.codigo == -1) {
                    img.nextElementSibling.style.display = 'block';
                    img.nextElementSibling.innerHTML = response.mensaje;
                } else {
                    location.reload();
                }
            });
        }
    });
}

const profile = () => {
    linksImage('#form-image-profile', ROUTES.FORMS.IMAGE.DELETEUSER);
    formImage('#form-image-profile', ROUTES.FORMS.IMAGE.USER);    
}