//-----------Sezione commenti--------------------

var number = null;

function commentoVuoto() {
    let commentText = document.getElementById("textarea").value.trim();
    if (commentText.length === 0) {
        alert("Il commento non può essere vuoto");
        return false;
    }
    return true;
}

function updateNum() {
    let textarea = document.getElementById("textarea").value.trim();
    let node = document.getElementById("MaxChar");
    let textnode = node.firstChild;
    node.removeChild(textnode);
    node.appendChild(document.createTextNode((300 - textarea.length).toString()));
}

function miPiaceOver(id) {
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue"))
        return;
    if (classList.contains("upGray")) {
        classList.remove("upGray");
        classList.add("upBlack");
    }
}

function miPiaceOut(id) {
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue"))
        return;
    if (classList.contains("upBlack")) {
        classList.remove("upBlack");
        classList.add("upGray");
    }
}

function miPiace(idstring) {
    let classList = document.getElementById(idstring).classList;
    let likeNode = document.getElementById(idstring).parentNode.children[7].firstChild;
    let id = idstring.replace("Label", "");
    if (classList.contains("upBlue")) { //rimozione like
        classList.remove("upBlue");
        classList.add("upBlack");
        let numLike = document.createTextNode((Number(likeNode.textContent)-1).toString());
        let p = likeNode.parentNode;
        p.removeChild(likeNode);
        p.appendChild(numLike);
        $.ajax({
            type: "GET",
            url: "like.php?add=false&id=" + id
        })

    } else { //aggiunta like
        classList.remove("upBlack");
        classList.add("upBlue");
        let numLike = document.createTextNode((Number(likeNode.textContent)+1).toString());
        let p = likeNode.parentNode;
        p.removeChild(likeNode);
        p.appendChild(numLike);
        $.ajax({
            type: "GET",
            url: "like.php?add=true&id=" + id
        })
    }
}

function eliminaCommento(idstring) {
    let id = idstring.replace("commento_", "");
    if (confirm('Sei sicuro di voler rimuovere il commento?')) {
        $.ajax({
            type: "GET",
            url: "delete.php?id=" + id,
            success: function () {
                let commento = document.getElementById(idstring);
                let nodes = commento.parentNode.childNodes;
                if (nodes.length === 1) {
                    let listacommenti = commento.parentNode.parentNode;
                    listacommenti.removeChild(commento.parentNode);
                    let p = document.createElement("P");
                    p.appendChild(document.createTextNode("Non ci sono commenti al momento"));
                    listacommenti.appendChild(p);
                } else {
                    commento.parentNode.removeChild(commento);
                }
            },
            error: function () {
                alert("Non è stato possibile rimuovere il commento");
            }
        })
    }
}

//-----------Fine sezione commenti--------------------

// ------------------- REGISTRAZIONE-----------------------

function mostraErrore(input, testoErrore) {

    var fieldset = input.parentNode;
    var element = document.createElement("P");
    element.className="messErroriReg";
    element.appendChild(document.createTextNode(testoErrore));
    insertAfter(element,fieldset);
    //fieldset.appendChild(element);

}

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function togliErrore(input) {
    var p = input.parentNode.nextSibling;
    var pSup = p.parentNode;
    var name = p.tagName;
    if(name=="P") {
        pSup.removeChild(p);
    }

    /*if (p.childElementCount>2) {
        p.removeChild(p.children[2]);
    }*/
}

function checkNome(nomeinput) {
    var nome = new RegExp('^([a-zA-Z]{3,15})$');
    console.log(nome);
    if (nome.test(nomeinput.value)) {
        togliErrore(nomeinput);
        return true;
    } else {
        togliErrore(nomeinput);
        mostraErrore(nomeinput,
            "Il nome che è stato inserito non è conforme");
        return false;
    }
}

function checkCognome(cognomeInput) {
    var cognome = new RegExp('^([A-Za-z]{2,15})$');
    if (cognome.test(cognomeInput.value)) {
        togliErrore(cognomeInput);
        return true;
    } else {
        togliErrore(cognomeInput);
        mostraErrore(cognomeInput,
            "Il Cognome che è stato inserito non è conforme");
        return false;
    }
}

function checkNickname(nicknameInput) {
    var nickname = new RegExp('^([a-zA-Z1-9]{3,15})$');
    if (nickname.test(nicknameInput.value)) {
        togliErrore(nicknameInput);
        return true;
    } else {
        togliErrore(nicknameInput);
        mostraErrore(nicknameInput,
            "Il nickname che è stato inserito non è conforme");
        return false;
    }
}

function checkEmail(emailInput) {
    var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (re.test(emailInput.value)) {
        togliErrore(emailInput);
        return true;
    } else {
        togliErrore(emailInput);
        mostraErrore(emailInput,
            "L'email che è stato inserita non è conforme");
        return false;
    }
}

function checkPassword(passwordInput) {
    var password = passwordInput.value.length;
    if (password >= 3) {
        togliErrore(passwordInput);
        return true;
    } else {
        togliErrore(passwordInput);
        mostraErrore(passwordInput,
            "La password che è stato inserita non è conforme");
        return false;
    }
}

function validazioneReg() {
    var nome = document.getElementById("nomeReg");
    var cognome = document.getElementById("cognomeReg");
    var nickname = document.getElementById("nicknameReg");
    var email = document.getElementById("emailReg");
    var password = document.getElementById("passwordReg");

    var risultatoNome = checkNome(nome);
    var risultatoCognome = checkCognome(cognome);
    var risultatoNickname = checkNickname(nickname);
    var risultatoEmail = checkEmail(email);
    var risultatoPassword = checkPassword(password);


    return risultatoNome && risultatoCognome && risultatoNickname && risultatoEmail && risultatoPassword;

}

//-------------- FINE REGISTRAZIONE ---------------------


/*----------------------HEADER MOBILE----------------------------*/
function mobileMenu () {
    var openButton = document.getElementById("openButton");
    var menu = document.getElementById("menu");
    var closeButton = document.getElementById("closeButton");
    var openSearch = document.getElementById("mobileButton");
    var mobileBar = document.getElementById("searchBar");
    var exitButton = document.getElementById("closeSearch");
    var jsmenu = document.getElementById("mobileMenu");
    var searchBar = document.getElementById("searchBar");

    menu.classList.add('js-hidden');
    jsmenu.classList.add('js-show');
    searchBar.classList.add('js-hidden');
    openSearch.classList.add('js-show');


    openButton.addEventListener("click", function () {
        openButton.classList.add('openButton-js-hidden');
        menu.classList.add('js-opened');
        closeButton.classList.add('js-opened');

    });
    closeButton.addEventListener("click", function () {
        openButton.classList.remove('openButton-js-hidden');
        menu.classList.remove('js-opened');
        closeButton.classList.remove('js-opened');

    });
    openSearch.addEventListener("click", function () {

        openSearch.classList.add('js-opened');
        mobileBar.classList.add('js-opened');
        exitButton.classList.add('js-opened');
    });

    exitButton.addEventListener("click", function () {

        openSearch.classList.remove('js-opened');
        mobileBar.classList.remove('js-opened');
        exitButton.classList.remove('js-opened');
    });
}

//--------------------Area Utente--------------
function confermaRimozione() {
    return confirm("Sei sicuro di voler rimuovere il tuo account?");
}
