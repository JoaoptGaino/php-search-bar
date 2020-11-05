function checaPonto(str) {
    const retorno = str.charAt(str.length - 1).includes(';');
    if (retorno === false) {
        if (str.includes("const joao")) {
            console.log(str+";");
        } else {
            console.log("asdsadsad");
        }
    }else{
        console.log(str);
    }
}
checaPonto("const joao");