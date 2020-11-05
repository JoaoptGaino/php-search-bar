const texto = 'joao}';

const retorno = texto.charAt(texto.length - 1).includes(';');
let novaString = "";
if (retorno === false) {
    if (texto.charAt(texto.length - 1).includes('{') || texto.charAt(texto.length - 1).includes('}')) {
        console.log(texto);
    } else {
        console.log("Esqueceu do ponto de virgula");
        novaString = texto + ";";
        console.log(`Nova string: ${novaString}`);
    }


} else {
    console.log(texto);
    console.log(texto.charAt(texto.length - 1));
}
//console.log(retorno);