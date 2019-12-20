



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
    let classList = document.getElementById(id).classList;
    if (classList.contains("upBlue")){
        classList.remove("upBlue");
        classList.add("upBlack");

        $.ajax({
            type: "GET",
            url: "like.php?add=false&id="+id,
            success: function(response)
            {
                console.log('dati ricevuti : '+response);

                // qui viene gestita la risposta
            },
            error: function(errore)
            {
                alert('ERRORE : il server non risponde o lo ha fatto in modo anomalo '+errore);
            }
        })

    }
    else{
        classList.remove("upBlack");
        classList.add("upBlue");

        $.ajax({
            type: "GET",
            url: "like.php?add=true&id="+id,
            success: function(response)
            {
                console.log('dati ricevuti : '+response);

                // qui viene gestita la risposta
            },
            error: function(errore)
            {
                alert('ERRORE : il server non risponde o lo ha fatto in modo anomalo '+errore);
            }
        })
    }
}