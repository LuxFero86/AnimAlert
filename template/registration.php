<main class="report_btn_flex">
    <!-- Formulaire de création de compte -->
    <form class="relative flex column" action="" method="post">
        <h1 class="center">Créer un compte</h1>
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" minlength="3" maxlength="20" placeholder="3 à 20 caractères" required>
        <label for="usermail">Adresse e-mail:</label>
        <input type="email" id="usermail" name="usermail" pattern="/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/gi" placeholder="exemple@gmail.com" required>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" minlength="8" maxlength="20" placeholder="8 à 20 caractères" required>
        <label for="password">Confirmer le mot de passe:</label>
        <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="20" placeholder="8 à 20 caractères" required>
        <button type="submit" id="btn_registration" class="btn_confirm onclick center" name="submit" value="register">Valider</button>
        <?php if(isset($data["msg"])) : ?>
            <p><?= $data["msg"] ?></p>
        <?php endif; ?>
        <a id="cancel_creation" class="link" href="/login">Annuler</a>
    </form>
</main>