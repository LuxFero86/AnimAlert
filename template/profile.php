<main class="report_btn_flex">
    <!-- Formulaire de profil -->
    <form class="relative flex column" action="" method="post">
        <h1 class="center">Profil</h1>
        <h3 class="center">Nom d'utilisateur :</h3>
        <p class="center"><?= $_SESSION['username'] ?></p>
        <h3 class="center">Adresse e-mail :</h3>
        <p class="center"><?= $_SESSION['usermail'] ?></p>
    </form>
</main>