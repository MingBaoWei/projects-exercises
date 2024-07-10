// Función para encontrar el valor máximo en un array
function encontrarMaximo(arr) {
    let max = arr[0];
    for (let i = 1; i < arr.length; i++) {
        if (arr[i] > max) {
            max = arr[i];
        }
    }
    return max;
}

// Función para ordenar un array de manera que los números impares ocupen las primeras posiciones
function ordenarImparesPrimero(arr) {
    for (let i = 0; i < arr.length; i++) {
        for (let j = i + 1; j < arr.length; j++) {
            if (arr[i] % 2 == 0 && arr[j] % 2 != 0) {
                let temp = arr[i];
                arr[i] = arr[j];
                arr[j] = temp;
            }
        }
    }
}

let arr = [232, 56, 33, 876, 32,985,56, 729, 36,33, 183];
ordenarImparesPrimero(arr);

alert("Valor max: "+encontrarMaximo(arr));
alert("Impares al principio: " +arr.join(" - "));
