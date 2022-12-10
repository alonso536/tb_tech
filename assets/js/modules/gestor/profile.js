const linksImage = (formImage) => {
    const addImage = (document.querySelector('#add-image') !== null) ? document.querySelector('#add-image') : null;
    const updateImage = (document.querySelector('#update-image') !== null) ? document.querySelector('#update-image') : null;
    const deleteImage = (document.querySelector('#delete-image') !== null) ? document.querySelector('#delete-image') : null;

    const form = document.querySelector(formImage);

    if(addImage != null) {
        addImage.addEventListener('click', () => {
            form.classList.toggle('form-hidden');
        });
    }

    if(updateImage != null) {
        updateImage.addEventListener('click', () => {
            form.classList.toggle('form-hidden');
        });
    }

    if(deleteImage != null) {
        deleteImage.addEventListener('click', () => {
            post(ROUTES.FORMS.IMAGE.DELETEUSER, {
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

const formImage = (formImage) => {
    const form = document.querySelector(formImage);
    const img = document.querySelector('#img');

    form.addEventListener('submit', e => {
        e.preventDefault();
        img.nextElementSibling.style.display = 'none';

        if(img.value == '') {
            img.nextElementSibling.style.display = 'block';
            img.nextElementSibling.innerHTML = 'Debes seleccionar un archivo';
        } else {
            let data = new FormData(form);

            postImg(ROUTES.FORMS.IMAGE.USER, data)
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
    linksImage('#form-image-profile');
    formImage('#form-image-profile');    
}