<main>
    <!-- Formulaire de connexion -->
    <form action="" method="post">
        <h2 class="at_top">Connexion</h2>
        <label for="usermail">Adresse e-mail:</label>
        <input type="email" id="usermail" name="usermail" pattern="/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/gi" placeholder="exemple@gmail.com" required>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" minlength="8" maxlength="20" placeholder="8 à 20 caractères" required>
        <button type="submit" id="connection_btn" class="btn confirm_btn onclick" name="submit" value="login">Se connecter</button>
        <?php if(isset($data["msg"])) : ?>
            <p><?= $data["msg"] ?></p>
        <?php endif; ?>
        <a id="create_account" class="link" href="/register">Créer un compte</a>
    </form>
</main>