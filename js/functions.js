function trimText(id) {
    let element = document.getElementById(id);
    element.innerHTML = element.textContent.trim();
}

function commentoVuoto() {
    let commentText = document.getElementById("textarea").textContent.toString();
    if (commentText.length === 0) {
        alert("Il commento non può essere vuoto");
        return false;
    }
    return true;
}

function updateNum() {//funziona su edge ma non su chrome, WTF?!?!?!?
    let numChar = document.getElementById("textarea").textContent.length;
    document.getElementById("MaxChar").innerHTML = (300 - numChar).toString();
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
        classList.add("upGray")
    }
}

function miPiace(id) {
    let classList = document.getElementById(id).classList;
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