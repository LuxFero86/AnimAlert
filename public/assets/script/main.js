// Récupération des éléments page accueil
const btn_report = document.getElementsByClassName("btn_report");
const btn_lost = document.getElementById("btn_lost");
const btn_found = document.getElementById("btn_found");
const report_form = document.getElementById("report_form");
let report_type = document.getElementById("report_type");

// Page accueil
for (let i = 0; i < btn_report.length; i++) {
    btn_report[i].addEventListener("click", () => {
        for (let i = 0; i < btn_report.length; i++) {
            btn_report[i].style.display = "none";
        }
        if (i == 0){report_type.value="lost"};
        if (i == 1){report_type.value="found"};
        // report_form.show();
    })
}
// btn_lost.addEventListener("click", () =>{report_type.value="lost";})
// btn_found.addEventListener("click", () =>{report_type.value="found";})

// Récupération des éléments page profil
// const connection = document.getElementById("connection");
// const btn_connection = document.getElementById("btn_connection");
// const create_account = document.getElementById("create_account");
// const account_creation = document.getElementById("account_creation");
// const btn_registration = document.getElementById("btn_registration");
// const cancel_creation = document.getElementById("cancel_creation");