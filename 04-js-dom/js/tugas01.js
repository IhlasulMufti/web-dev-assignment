const button = document.getElementsByClassName("tema")[0];
const temaBackground = document.querySelectorAll("#ubahTema");
const warnaText = document.querySelectorAll("#ubahColor");

button.addEventListener("click", () => {
    for(var i = 0; i<temaBackground.length; i++ ){
        temaBackground[i].setAttribute("id", "tema-bg");
    }
    for(var i = 0; i<warnaText.length; i++ ){
        warnaText[i].setAttribute("id", "warna-txt");
    }
    document.getElementsByTagName("body")[0].style.backgroundColor = "black";
    document.getElementsByClassName("bg-color-transparant")[0].style.backgroundColor = "rgba(0,0,0,0.8)";
    document.getElementById("abt-pdd").style.backgroundColor = "#606060";
})
