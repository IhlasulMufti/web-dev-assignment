const btnAdd = document.getElementById("button-addon2");
const listContainer = document.getElementById("list");
const inputItem = document.getElementsByTagName("input")[0];

const database = new Map();

btnAdd.addEventListener("click", () => {
    const ITEM_KEY = inputItem.value.toUpperCase();
    const ITEM_VALUE = inputItem.value;

    // NOTE: Create element
    const listItem = document.createElement('li');
    const btnDelete = document.createElement('button');
    const counter = document.createElement('button');

    // NOTE: Make Counter for Count How Many Item We Have
    var i = 1;
    counter.textContent = i;

    // WARN: Handle error, empty input
    if (ITEM_VALUE === '') {
        alert("Item Name can't be blank");
        inputItem.focus();
        return;
    }

    // WARN: Check for duplication
    if (database.has(ITEM_KEY)) {
        const duplicateConfirm = confirm('Anda Sudah Memiliki "' + ITEM_VALUE + '". Apakah Ingin Menambahkan Lagi?');

        if (duplicateConfirm) {
            const getCounter = document.getElementById(ITEM_KEY);
            i = Number(getCounter.textContent)
            getCounter.textContent = (i + 1);
        }
        inputItem.value = '';
        inputItem.focus();
        return;
    }

    // NOTE: Add the new item to database
    database.set(ITEM_KEY, ITEM_VALUE);

    // NOTE: Add attribute
    listItem.setAttribute("class", "list-item text-white fs-4"); // NOTE: Add Class
    btnDelete.setAttribute("class", "px-2 fs-6"); //NOTE: Add ID for button
    counter.setAttribute("class", "mx-2 px-2 fs-6"); //NOTE: Add ID for Counter
    counter.setAttribute("id", ITEM_KEY); //NOTE: Add ID for Counter

    // NOTE: Add value
    listItem.textContent = ITEM_VALUE;
    btnDelete.textContent = 'Delete';

    // NOTE: Combine elements
    listItem.append(counter, btnDelete);
    listContainer.appendChild(listItem);

    // NOTE: Handle click event for delete button
    btnDelete.addEventListener('click', () => {
        const delConfirm = confirm("Apakah Anda Yakin Menghapus Item Ini?")
        if (delConfirm) {
            const getCounter = document.getElementById(ITEM_KEY);

            if (getCounter.textContent === "1") {
                listContainer.removeChild(listItem);
            } else {
                i = Number(getCounter.textContent);
                getCounter.textContent = i - 1;
            }
        }
        inputItem.focus();
        return;
    });

    inputItem.value = '';
    inputItem.focus();

})