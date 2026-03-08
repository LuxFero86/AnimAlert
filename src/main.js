// Récupération des éléments page profil
const connexion = document.getElementById("connexion");
const btn_connexion = document.getElementById("btn_connexion");
const create_account = document.getElementById("create_account");
const account_creation = document.getElementById("account_creation");
const validation = document.getElementById("btn_create_account");
const cancel_creation =document.getElementById("cancel_creation");

// Page profil
connexion.show();

create_account.addEventListener("click", () => {
    connexion.close();
    account_creation.show();
})

cancel_creation.addEventListener("click", () => {
    account_creation.close();
    connexion.show();
})