class Validar {

    constructor(formulario) {

        this.formulario = formulario;
        formulario.addEventListener('submit', (e) => {
            // e.preventDefault();
            this.comprobar(e);
        });
        // this.envio.disabled;
        this.errorAyuda();
        // this.validarCampos()
        this.formulario.querySelector('input[type="checkbox"]').addEventListener('change', (e) => this.validarCondiciones(e));
    }

    validarCampos() {
        var campos = document.querySelectorAll('input');
        var soloLetras = /^([a-zA-Z])*$/;
        var email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
        var errores = 0;

        for (var i = 0; i < campos.length; i++) {

            if (campos[i].type.toLowerCase != 'password' && campos[i].type.toLowerCase != 'submit' && campos[i].type.toLowerCase != 'checkbox') {

                for (var i = 0; i < campos.length; i++) {

                    var tipo = campos[i].dataset.tipo;
                    var minimolength = campos[i].dataset.minimolength;
                    var maximolength = campos[i].dataset.maximolength;

                    switch (tipo) {
                        case 'alfabetico':
                            if (soloLetras.test(campos[i].value)) {
                                campos[i].nextElementSibling.innerText = " * ";
                            }
                            else {
                                errores++;
                                campos[i].nextElementSibling.innerText = " * Sólo caracteres alfabéticos.";
                            }
                            break;

                        case 'email':
                            if (email.test(campos[i].value)) {
                                campos[i].nextElementSibling.innerText = " * ";
                            }
                            else {
                                errores++;
                                campos[i].nextElementSibling.innerText = " * Formato email inválido.";
                            }
                            break;
                    }

                    if (campos[i].value.length < minimolength || campos[i].value.length > maximolength) {
                        errores++;
                        campos[i].nextElementSibling.innerText = " * Longitud entre " + minimolength + " y " + maximolength + " caracteres. ";
                    }
                    else if (campos[i].type.toLowerCase === 'text' || campos[i].type.toLowerCase === 'email') {
                        campos[i].nextElementSibling.innerText = " * ";
                    }
                }
            }
        }
        return errores;
    }

    validarPass() {
        var pass = document.querySelector('input[name="password"]');
        var minimolength = pass.dataset.minimolength;
        var maximolength = pass.dataset.maximolength;
        var rPass = new RegExp(`^(?=\\w*\\d)(?=\\w*[A-Z])(?=\\w*[a-z])\\S{${minimolength},${maximolength}}$`);
        var errores = 0;

        if (rPass.test(pass.value.trim())) {
            pass.nextElementSibling.textContent = " * ";
        }
        else {
            errores++;
            pass.nextElementSibling.innerText = " * Longitud entre " + minimolength + " y " + maximolength + " caracteres además de incluir mayúsculas y minúsculas ";
        }
        return errores;

    }

    insertAfter(newNode, referenceNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }

    errorAyuda() {

        var campos = document.querySelectorAll('input');

        for (var i = 0; i < campos.length; i++) {
            if (campos[i].required) {
                var span = document.createElement('span');
                span.setAttribute('class', 'sos');
                span.innerText = " * ";
                this.insertAfter(span, campos[i]);
            }
        }
    }

    validarCondiciones(e) {
        if (e.currentTarget.checked) {
            // this.envio.enabled;
            this.formulario.querySelector('input[type="submit"]').removeAttribute('disabled');
        }
    }

    comprobar(e) {
        e.preventDefault();

        var erroresCampos = this.validarCampos();
        var erroresPass = this.validarPass();

        if (erroresCampos === 0 && erroresPass === 0) {
            this.formulario.submit();
            alert('Enviado correctamente');
        }
    }
}
