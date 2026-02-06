function mezuaBidali() {

    var izena = document.getElementById("izena").value.trim();
    var email = document.getElementById("email").value.trim();
    var mezua = document.getElementById("mezua").value.trim();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (izena === "" || email === "" || mezua === "") {
        alert("Mesedez, bete formulario guztia.");
        return;
    } 
    if (!/^[a-zA-Z\s]+$/.test(izena)) {
        alert("Mesedez, sartu baliozko izen bat (letrak eta espazioak soilik).");
        return;
    }
    
    if (!emailRegex.test(email)) {
        alert("Mesedez, sartu baliozko email helbide bat.");
        return;
    }

    if (mezua.length < 10) {
        alert("Mezuak gutxienez 10 karaktere izan behar ditu.");
        return;
    }

    httpRequest = new XMLHttpRequest();

    httpRequest.open("POST", "index.php", true);
    httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === 4) {
            if (httpRequest.status === 200) {
                // Si la respuesta contiene "error", mostramos alert (opcional, pero mantenemos lógica de reemplazo)
                document.getElementById("mezua-edukia").innerHTML =  this.responseText;
            } else {
                alert("Errorea mezua bidaltzean." + httpRequest.statusText);
            }
        }
    };

    httpRequest.send("izena=" + encodeURIComponent(izena)
    + "&email=" + encodeURIComponent(email)
    + "&mezua=" + encodeURIComponent(mezua)
    + "&bidali=true");
}