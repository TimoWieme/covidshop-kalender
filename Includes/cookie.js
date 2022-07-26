
window.addEventListener("load", (event)=>{
    console.log("window is geladen")
    let cookie = localStorage.getItem("gereserveerd")
    console.log(cookie)
    if(cookie === 'true'){
        console.log("er is gereserveerd")
        let textDiv = document.querySelector('#confirmText');
        textDiv.innerHTML = "<h3> Reservering opgeslagen! </h3>";
    } else {
        console.log("er is niet gereserveerd")
    }

});
