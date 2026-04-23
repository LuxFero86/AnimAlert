// Page Home

const report_btn = document.getElementsByClassName("report_btn");

for (let i = 0; i < report_btn.length; i++) {
    report_btn[i].addEventListener("click", () => {
        window.location.replace(`/report?${report_btn[i].value}`);
    })
}