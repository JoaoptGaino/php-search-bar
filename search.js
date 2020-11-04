var nome;

function handleChange() {
    var x = document.getElementById("inp");
    nome = document.getElementById("nome");
    if (x.value == '') {
        getAll();
        return;
    }
    procura(x.value);
}

function getAll() {
    startAjax();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != '') {
                document.getElementById("nome").innerHTML = this.responseText;
            }
        }
    }
    xmlhttp.open("GET", "searchDAO.php");
    xmlhttp.send();
}

function procura(proc) {
    startAjax();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != '') {
                console.log(this.responseText);
                document.getElementById("nome").innerHTML = this.responseText;
            } else {
                console.log("Sem resposta.");
            }
        }
    };
    xmlhttp.open("GET", `searchDAO.php?q=${proc}`);
    xmlhttp.send();
}

function startAjax() {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
    }
}