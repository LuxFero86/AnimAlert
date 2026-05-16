// Page Home

const report_btn = document.getElementsByClassName("report_btn");

for (const btn of report_btn) {
    btn.addEventListener("click", () => {
        globalThis.location.replace(`/report?${btn.value}`);
    })
}
