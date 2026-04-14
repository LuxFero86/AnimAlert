// Récupération des éléments page Home
const report_btn = document.getElementsByClassName("report_btn");
// const btn_lost = document.getElementById("btn_lost");
// const btn_found = document.getElementById("btn_found");
// const report_form = document.getElementById("report_form");
// let report_type = document.getElementById("report_type");

// Page Home
for (let i = 0; i < report_btn.length; i++) {
    report_btn[i].addEventListener("click", () => {
        window.location.replace(`/report?${report_btn[i].value}`);
    })
}