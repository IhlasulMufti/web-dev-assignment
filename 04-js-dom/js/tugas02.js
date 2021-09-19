const btnAdd = document.getElementById("button-addon2");
const list = document.getElementById("list");
const addItem = document.getElementsByTagName("input")[0];
var i = 1;

btnAdd.addEventListener("click", () => {
    const listGroup = document.createElement("li"); //Membuat List
    listGroup.innerText = addItem.value;
    listGroup.setAttribute("class", "list" + i + " text-white fs-4");
    list.appendChild(listGroup);

    const del = document.getElementsByClassName("list" + i)[0]; //Membuat Tombol Delete di setiap List
    const delBtn = document.createElement("button");
    delBtn.innerText = "delete";
    delBtn.setAttribute("class", "delList mx-3 fs-6");
    del.appendChild(delBtn);

    //Menghapus List
    delBtn.addEventListener("click", () => list.removeChild(listGroup))

    i++;
})