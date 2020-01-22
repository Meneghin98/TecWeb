
function trimText(id) {
    let element = document.getElementById(id);
    element.innerHTML = element.textContent.trim();
}

//-----------Sezione commenti--------------------
function commentoVuoto() {
    let commentText = document.getElementById("textarea").value.trim();
    if (commentText.length === 0) {
        alert("Il commento non può essere vuoto");
        return false;
    }
    return true;
}

function updateNum() {
    let textarea = document.getElementById("textarea").value;
    document.getElementById("MaxChar").innerHTML = (300 - textarea.length).toString();
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
    let id = idstring.replace("Label", "");
    if (classList.contains("upBlue")) {
        classList.remove("upBlue");
        classList.add("upBlack");

        $.ajax({
            type: "GET",
            url: "like.php?add=false&id=" + id
        })

    } else {
        classList.remove("upBlack");
        classList.add("upBlue");

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


// ------------------------- LOGIN --------------------------

/*
function mostraErrore(input, testoErrore) {

    togliErrore(input);

    var p = input.parentNode;
    if (p.children.length == 2) {
        var strong = document.createElement("strong");
        //strong.className="corsivo";
        strong.appendChild(document.createTextElement(testoErrore)); //span.innerHTML=testoErrore;
        p.appendChild
        p.appendChild(strong);
    }
}

function togliErrore(input) {
    var p = input.parentNode;

    if (p.children.length > 2) {
        p.removeChild(p.children[2]); //rimuovo il terzo figlio di p
    }

    /*var span = p.lastChild;
    p.removeChild(span);
}

*/
function checkInput(NicknameInput, PasswordInput) {

    var value = 1;
    $.ajax({
        type: 'GET',
        url: 'file.php?n=' + NicknameInput + '&p=' + PasswordInput,
        dataType: 'text',
        success: function (response) {
            value=response;
        }
    })
    return value;
}

function validazioneForm() {
    let nickname = document.getElementById("emailLogin").value;
    let password = document.getElementById("passwordLogin").value;

    let resultCheck = checkInput(nickname,password);

    if(resultCheck==0) {
        window.location.href = '../index.php';
    }
    else if(resultCheck==2) {
        let padre = nickname.parentNode.parentNode;
        padre.createElement("div");
        let scritta = document.createElement("P");
        scritta.appendChild(document.createTextNode("Verifica che il nickname inserito sia valido"));
        padre.appendChild(scritta);
    }
    else {
        let padre = nickname.parentNode.parentNode;
        padre.createElement("div");
        let scritta = document.createElement("P");
        let scritta2 = document.createElement("P");
        padre.appendChild(scritta);
        padre.appendChild(scritta2);
        scritta.appendChild(document.createTextNode("Verifica che il nickname inserito sia valido"));
        scritta2.appendChild(document.createTextNode("Verifica che il nickname e la password inserite siano valide"));
    }
    return false;
}

// --------------------- FINE LOGIN ---------------------------

// ------------------- REGISTRAZIONE-----------------------

function mostraErrore(input, testoErrore) {

    togliErrore(input);

    var fieldset = input.parentNode.parentNode.parentNode;
    var element = document.createElement("P");
    //strong.className="corsivo";
    element.appendChild(document.createTextElement(testoErrore));
    fieldset.appendChild(element);

}

function togliErrore(input) {
    var p = input.parentNode;

    if (input=="nome") {
        p.removeChild(input);
    }
    else if (input=="cognome") {
        p.removeChild(input);
    }
    else if (input=="nickname") {
        p.removeChild(input);
    }
    else if (input=="email") {
        p.removeChild(input);
    }
    else if (input=="password") {
        p.removeChild(input);
    }
}

function checkNome(nomeinput) {
    var nome = new RegExp('/^([a-zA-Z1-9]{3,15})$/');
    if (nome.test(nomeinput.value)) {  //mi mostra il valore contenuto in input
        togliErrore(nomeinput);
        return true;
    } else {
        mostraErrore(nomeinput,
            "Il nome che è stato inserito non è conforme");
        return false;
    }
}

function checkCognome(cognomeInput) {
    var cognome = new RegExp('/^([A-Za-z]{2,15})$/');
    if (cognome.test(cognomeInput.value)) {
        togliErrore(cognomeInput);
        return true;
    } else {
        mostraErrore(cognomeInput,
            "Il Cognome che è stato inserito non è conforme");
        return false;
    }
}

function checkNickname(nicknameInput) {
    var nickname = new RegExp('/^([a-zA-Z1-9]{3,15})$/');
    if (nickname.test(nicknameInput.value)) {
        togliErrore(nicknameInput);
        return true;
    } else {
        mostraErrore(nicknameInput,
            "Il nickname che è stato inserito non è conforme");
        return false;
    }
}

function checkEmail(emailInput) {
    var email = new RegExp('/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i');
    if (email.test(emailInput.value)) {
        togliErrore(emailInput);
        return true;
    } else {
        mostraErrore(emailInput,
            "L'email che è stato inserita non è conforme");
        return false;
    }
}

function checkPassword(passwordInput) {
    var password = passwordInput.value.length;
    if (password>=3) {
        togliErrore(passwordInput);
        return true;
    } else {
        mostraErrore(passwordInput,
            "La password che è stato inserita non è conforme");
        return false;
    }
}

function validazioneReg() {
    var nome = document.getElementById("nome");
    var cognome = document.getElementById("cognome");
    var nickname = document.getElementById("nickname");
    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var risultatoNome = checkNome(nome);
    var risultatoCognome = checkCognome(cognome);
    var risultatoNickname = checkNickname(nickname);
    var risultatoEmail = checkEmail(email);
    var risultatoPassword = checkPassword(password);


    return risultatoNome && risultatoCognome && risultatoNickname && risultatoEmail && risultatoPassword;

}

//-------------- FINE REGISTRAZIONE ---------------------


/*----------------------HEADER MOBILE----------------------------*/

function openMenu() {
    var openButton = document.getElementById("openButton");
    var menu = document.getElementById("menu");

    openButton.classList.add('openButton-js-hidden');
    menu.setAttribute('id', 'menu--offcanvas-1-js-opened');
}

function closeMenu() {
    var openButton = document.getElementById("openButton");
    var menu = document.getElementById("menu--offcanvas-1-js-opened");
    openButton.classList.remove('openButton-js-hidden');
    menu.setAttribute('id', 'menu');

}

function openSearch() {
    var openSearch = document.getElementById("mobileButton");
    var mobileBar = document.getElementById("searchBar");
    var exitButton = document.getElementById("closeSearch");

    openSearch.setAttribute('id', 'mobileButtonHidden');
    mobileBar.setAttribute('id', 'searchBarMobile');
    exitButton.setAttribute('id', 'closeSearchBar');
}

function closeSearch() {
    var mobileButton = document.getElementById("mobileButtonHidden");
    var mobileBarHiden = document.getElementById("searchBarMobile");
    var closeSearchHidden = document.getElementById("closeSearchBar");

    mobileButton.setAttribute('id', 'mobileButton');
    mobileBarHiden.setAttribute('id', 'searchBar');
    closeSearchHidden.setAttribute('id', 'closeSearch');
}