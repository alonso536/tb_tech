const ROUTES = {
    VIEWS: {
        0: 'inicio', 
        1: 'login', 
        2: 'registro',
        3: 'password-recovery',
        USERS : {
            0: 'usuarios/gestor',
            1: 'usuarios/cart',
            2: 'usuarios/logout'
        },
        CATEGORIES : {
            0: 'categorias',
            1: 'subcategorias',
            2: 'subcategorias/categorias'
        },
        PRODUCTS : {
            0: 'productos',
            1: 'productos/categorias',
            2: 'producto'
        }, 
        BRANDS : {
            0: 'marcas'
        },
        GESTOR : {
            PROFILE : 'gestor/perfil',
            UPDATEPROFILE: 'gestor/actualizar-perfil',
            UPDATEPASSWORD: 'gestor/actualizar-password',
            PRODUCTS : 'gestor/productos',
            ADDPRODUCTS : 'gestor/agregar-productos',
            ORDERS : 'gestor/pedidos',
            VALS : 'gestor/valoraciones',
            DELETE : 'gestor/eliminar-cuenta',
            ACTIVE : 'gestor/activar-cuenta',
            UPDATEPRODUCTS : 'gestor/actualizar-productos'
        }
    },
    RESOURCES: {
        EXP: '/shop/resources/expresiones'
    },
    FORMS: {
        REGISTER: '/shop/forms/register',
        LOGIN: '/shop/forms/login',
        PASSWORDRECOVERY: '/shop/forms/password-recovery',
        SENDPASSWORDRECOVERY: '/shop/forms/send-password-recovery',
        UPDATEPROFILE: '/shop/forms/update-profile',
        ACCOUNT: '/shop/forms/update-account',
        PRODUCTS: '/shop/forms/products',
        UPDATEPRODUCTS: '/shop/forms/update-product',
        IMAGE: {
            USER: '/shop/forms/img-user',
            DELETEUSER: '/shop/forms/delete-img-user',
            PRODUCT: '/shop/forms/img-product',
            DELETEPRODUCT: '/shop/forms/delete-img-product'
        }
    },
    CART: {
        ADD: 'cart/agregar',
        GET: 'cart/obtener',
        TOTAL: 'cart/total',
        REMOVE: 'cart/remover',
        DELETE: 'cart/borrar'
    },
    MESSAGES: {
        NAME: {
            0: 'El nombre no puede tener menos de 2 caracteres',
            1: 'El nombre no puede tener mas de 25 caracteres',
            2: 'El nombre no puede contener números ni guiones',
            3: 'El nombre no puede tener mas de 40 caracteres',
            4: 'El nombre no puede contener simbolos'
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
        DESCRIPTION: {
            0: 'La descripción no puede tener más de 255 caracteres',
            1: 'La descripción no puede contener símbolos'
        },
        WARNING: {
            0: 'Todos los campos son obligatorios',
            1: 'Debe aceptar los términos y condiciones',
            2: 'Los campos son obligatorios'
        }
    }
};