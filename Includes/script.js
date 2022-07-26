window.addEventListener("load", (event)=> {
    console.log("window is geladen, cookies zijn verwijderd.")
    localStorage.clear()
})


let bookButton = document.getElementById("bookSubmit")
bookButton.addEventListener("click", ()=>{
    localStorage.setItem("gereserveerd", true)
    console.log("you clicked the button, we saved a cookie")
})


