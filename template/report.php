<main>
    <!-- Formulaire de signalement -->
    <form id="report_form" action="" method="post">
        <input type="hidden" id="report_type" name="report_type" value="<?= $data["report_type"] ?>"/>
        <!-- <img src="assets/media/dark_theme/img.webp" alt="Encart vide pour photo à ajouter"/> -->
        <input type="file" capture="environment" accept="image/*"/>
        <select id="pet_type" name="pet_type" required>
            <option disabled selected>Type d'animal *</option>
            <?php foreach ($data["types"] as $type): ?>
                <option value="<?= $type->getId() ?>"><?= $type->getType() ?></option>
            <?php endforeach ?>
        </select>
        <!-- <button type="button" id="geolocation" class="absolute onclick" name="geolocation">Lieu</button> -->
         <label for="report_date">Date du signalement :</label>
        <input type="date" id="report_date" name="report_date" placeholder="Date du signalement" required/>
        <input type="time" id="report_time" name="report_time" placeholder="Heure du signalement"/>
        <?php if($data["report_type"] == 0): ?>
            <input type="text" id="pet_name" name="pet_name" placeholder="Nom"/>
        <?php endif ?>
        <input type="text" id="pet_breed" name="pet_breed" placeholder="Race"/>
        <input type="text" id="pet_coat" name="pet_coat" placeholder="Robe"/>
        <?php if($data["report_type"] == 0): ?>
            <input type="number" id="pet_age" name="pet_age" placeholder="Age"/>
        <?php endif ?>
        <select id="pet_sex" name="pet_sex">
            <option disabled selected>Sexe</option>
            <option value="male">Mâle</option>
            <option value="female">Femelle</option>
        </select>
        <textarea id="comment" name="comment" placeholder="Texte de l'annonce"></textarea>
        <?php if($data["report_type"] == 1): ?>
            <input type="checkbox" id="isDeceased" name="isDeceased"/>
            <label for="isDeceased">Décédé</label>
        <?php endif ?>
        <button type="submit" id="report_submit" class="btn_confirm center" name="report_submit" value="submit">Soumettre</button>
        <!-- <geolocation id="report_location" name="report_location" placeholder="Lieu du signalement" required></geolocation> -->
    </form>
</main>