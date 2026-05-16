<main>
    <!-- Formulaire de profil -->
    <form id="profile" action="" method="post">
        <h2 class="at_top">Profil</h2>
        <h3>Nom d'utilisateur :</h3>
        <p><?= $_SESSION['username'] ?></p>
        <h3>Adresse e-mail :</h3>
        <p><?= $_SESSION['usermail'] ?></p>
        <button type="button" id="logout_btn" class="btn addInfo_btn onclick">Se déconnecter</button>
    </form>
</main>
