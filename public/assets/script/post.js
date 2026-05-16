const reportMsg = document.getElementById('report_msg');

setTimeout(() => {
    reportMsg.textContent.includes('enregistré') ? globalThis.location.replace(`/`) : globalThis.history.back();
}, 3000);