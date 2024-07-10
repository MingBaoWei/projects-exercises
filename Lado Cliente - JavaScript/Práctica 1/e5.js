const text = "por cien cañones por banda poema Espronceda";

function contarPalabras(text){
    const palabras = text.split(" ");
    return palabras.length;
}
let palabras = contarPalabras(text);
alert(palabras);

function cambiarP(text){
    return text.replace(/p(?=[aeiou])/g, "P");
}
let cambiado = cambiarP(text);
alert(cambiado);