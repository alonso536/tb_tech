const main = document.querySelector('main');

const get = async (route) => {
    let request = await fetch(route);
    return await request.json();
}

const post = async (route, datos) => {

    let peticion = await fetch(route, {
        method: 'POST',
        body: 'datos=' + JSON.stringify(datos),
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    });

    return await peticion.json();
}

const getValues = () => {
    values = {
        nombre : (document.querySelector('#nombre') !== null) ? document.querySelector('#nombre').value : null,
        apellido : (document.querySelector('#apellido') !== null) ? document.querySelector('#apellido').value : null,
        email : (document.querySelector('#email') !== null) ? document.querySelector('#email').value : null,
        fono : (document.querySelector('#fono') !== null) ? document.querySelector('#fono').value : null,
        password : (document.querySelector('#password') !== null) ? document.querySelector('#password').value : null,
        password2 : (document.querySelector('#password2') !== null) ? document.querySelector('#password2').value : null,
        nombreProducto : (document.querySelector('#nombre-producto') !== null) ? document.querySelector('#nombre-producto').value : null,
        descripcion : (document.querySelector('#descripcion') !== null) ? document.querySelector('#descripcion').value : null,
        precio : (document.querySelector('#precio') !== null) ? document.querySelector('#precio').value : null,
        stock : (document.querySelector('#stock') !== null) ? document.querySelector('#stock').value : null,
    }

    return values;
}