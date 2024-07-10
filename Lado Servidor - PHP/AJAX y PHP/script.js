document.addEventListener("DOMContentLoaded", cargarProductos);

function cargarProductos() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "consultaBD.php", true);

    xhr.onload = function() {
        if (xhr.status == 200) {
            var productosContainer = document.getElementById("productos-container");
            productosContainer.innerHTML = xhr.responseText;

            // Agrega un evento de clic a cada checkbox
            var checkboxes = document.querySelectorAll("input[name='producto']");
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener("click", limitarSeleccion);
            });
        }
    };

    xhr.send();
}

function limitarSeleccion() {
    var checkboxes = document.querySelectorAll("input[name='producto']");
    var seleccionados = 0;

    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            seleccionados++;
        }
    });

    if (seleccionados >= 3) {
        checkboxes.forEach(function(checkbox) {
            if (!checkbox.checked) {
                checkbox.disabled = true;
            }
        });
    } else {
        checkboxes.forEach(function(checkbox) {
            checkbox.disabled = false;
        });
    }
}

function mostrarFormularioPedido() {
    document.getElementById("formulario-pedido").style.display = "block";
}

function guardarPedido() {
    var nombre = document.getElementById("nombre").value;
    var direccion = document.getElementById("direccion").value;
    var telefono = document.getElementById("telefono").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "guarda_pedido.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById("mensaje").innerHTML = xhr.responseText;
        }
    };

    xhr.send("nombre=" + nombre + "&direccion=" + direccion + "&telefono=" + telefono);
}