



function miPiaceOver(id) {
    let classList = document.getElementById(id).classList;
    if(classList.contains("upBlue"))
        return;
    if (classList.contains("upGray")) {
        classList.remove("upGray");
        classList.add("upBlack");
    }
}
function miPiaceOut(id) {
    let classList = document.getElementById(id).classList;
    if(classList.contains("upBlue"))
        return;
    if (classList.contains("upBlack")){
        classList.remove("upBlack");
        classList.add("upGray")
    }
}
function miPiace(id) {
    let xhttp = new XMLHttpRequest();
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue")){
        classList.remove("upBlue");
        classList.add("upBlack");

        //rimuovo mi piace al database
        /* non funziona.... non so perchè
        xhttp.open("GET", "../php/like.php?add=false&id="+id, true)
        xhttp.send();

         */

    }
    else{
        classList.remove("upBlack");
        /*non funziona.... non so perchè
        console.log("inizio query");
        xhttp.open("GET", "../php/like.php?add=true&id="+id, true)
        xhttp.send();
        console.log("inviata query");*/
        classList.add("upBlue");
    }
}