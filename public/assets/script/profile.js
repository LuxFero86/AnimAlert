// Page profile

const logout_btn = document.getElementById('logout_btn');

logout_btn.addEventListener("click", () => {
    globalThis.location.replace(`/logout`);
})