function enviarFormulario() {
    const nombre = document.getElementById('nombre').value;
    const apellido = document.getElementById('apellido').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const comentarios = document.getElementById('comentarios').value;
    const acepto = document.getElementById('acepto').checked;

    //Campos obligatorios
    if (!nombre || !apellido || !email || !password || !comentarios || !acepto) {
        alert('Todos los campos son obligatorios');
        return;
    }

    //Email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Ingrese una dirección de correo electrónico válida');
        return;
    }

    //Contraseña
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
    if (!passwordRegex.test(password)) {
        alert('La contraseña debe tener al menos 6 caracteres, una letra minúscula, una letra mayúscula y un dígito');
        return;
    }

    //Comentarios
    if (comentarios.length > 50) {
        alert('Los comentarios no deben exceder los 50 caracteres');
        return;
    }


    alert('Formulario enviado con éxito!');
}
