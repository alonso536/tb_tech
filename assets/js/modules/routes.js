const ROUTES = {
    VIEWS: {
        0: 'inicio', 
        1: 'login', 
        2: 'registro',
        USERS : {
            0: 'usuarios/gestor',
            1: 'usuarios/logout'
        },
        CATEGORIES : {
            0: 'categorias'
        }
    },
    RESOURCES: {
        EXP: '/shop/resources/expresiones'
    },
    FORMS: {
        REGISTER: '/shop/forms/register',
        LOGIN: '/shop/forms/login'
    },
    MESSAGES: {
        NAME: {
            0: 'El nombre no puede tener menos de 2 caracteres',
            1: 'El nombre no puede tener mas de 25 caracteres',
            2: 'El nombre no puede contener números ni guiones'
        },
        APELLIDO: {
            0: 'El apellido no puede tener menos de 2 caracteres',
            1: 'El apellido no puede tener mas de 25 caracteres',
            2: 'El apellido no puede contener números ni guiones'
        },
        EMAIL: {
            0: 'El email debe contener un @',
            1: 'El email está incompleto',
            2: 'El email ya está en uso, escoja otro o inicie sesión'
        },
        FONO: {
            0: 'El fono solo puede contener números',
            1: 'El fono no puede tener menos de 7 digitos',
            2: 'El fono no puede tener mas de 14 digitos'
        },
        PASSWORD: {
            0: 'La contraseña debe tener entre 8 y 16 caracteres',
            1: 'La contraseña debe contener letras mayúsculas, minusculas, números y simbolos',
            2: 'Las contraseñas deben coincidir'
        },
        WARNING: {
            0: 'Todos los campos son obligatorios',
            1: 'Debe aceptar los términos y condiciones'
        }
    }
};