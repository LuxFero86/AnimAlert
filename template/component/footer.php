<footer>
    <nav>
        <!-- Icônes de navigation -->
         <?php if (isset($_SESSION['connected'])) : ?>
            <a href="/profile"><img class="icon profile" src="assets/media/dark_theme/profile.webp" alt="Profile icon"></a>
        <?php else : ?>
            <a href="/login"><img class="icon profile" src="assets/media/dark_theme/addUser.webp" alt="Profile icon"></a>
        <?php endif; ?>
        <a href="/"><img class="icon home" src="assets/media/dark_theme/home.webp" alt="Home icon"></a>
        <a href="/search"><img class="icon search" src="assets/media/dark_theme/search.webp" alt="Search icon"></a>
    </nav>
</footer>