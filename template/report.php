<main class="report_btn_flex">
    <!-- Formulaire de signalement -->
    <form id="report_form" class="relative flex column" action="" method="post">
        <input type="hidden" id="report_type" name="report_type" value="<?= $data["report_type"] ?>">
        <select id="pet_type" name="pet_type" class="at_top" required>
            <option disabled selected>Type d'animal</option>
            <?php foreach ($data["types"] as $type): ?>
                <option value="<?= $type->getId() ?>"><?= $type->getType() ?></option>
            <?php endforeach ?>
        </select>
        <!-- <button type="button" id="geolocation" class="absolute onclick" name="geolocation">Lieu</button> -->
        <input type="date" id="report_date" name="report_date" placeholder="Date du signalement" required>
        <input type="time" id="report_time" name="report_time" placeholder="Heure du signalement">
        <input type="text" id="pet_name" name="pet_name" placeholder="Nom">
        <input type="text" id="pet_breed" name="pet_breed" placeholder="Race">
        <input type="text" id="pet_coat" name="pet_coat" placeholder="Robe">
        <input type="number" id="pet_age" name="pet_age" placeholder="Age">
        <select id="pet_sex" name="pet_sex">
            <option disabled selected>Sexe</option>
            <option value="male">Mâle</option>
            <option value="female">Femelle</option>
        </select>
        <textarea id="comment" name="comment" placeholder="Texte de l'annonce"></textarea>
        <button type="submit" id="report_submit" class="btn_confirm center" name="report_submit" value="submit">Soumettre</button>
        <!-- <geolocation id="report_location" name="report_location" placeholder="Lieu du signalement" required></geolocation> -->
    </form>
</main>