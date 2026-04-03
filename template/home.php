<main class="report_btn_flex">
    <!-- Boutons de signalement -->
    <button class="btn_report onclick" id="btn_lost" type="button">PERDU</button>
    <button class="btn_report onclick" id="btn_found" type="button">TROUVÉ</button>

    <!-- Formulaire de signalement -->
    <dialog id="report_form" class="report_form">
        <form action="" method="post">
            <input type="hidden" id="report_type" name="report_type" value="">
            <!-- <div class="flex_fields"> -->
            <select id="pet_type" name="pet_type" class="at_top" required>
                <option disabled selected>Type d'animal</option>
                <option value="dog">Chien</option>
                <option value="cat">Chat</option>
                <option value="other">Autre</option>
            </select>
            <button type="button" id="geolocation" class="absolute" name="geolocation">Lieu</button>
            <!-- </div> -->
            <div class="flex_fields">
                <input type="date" id="report_date" name="report_date" placeholder="Date du signalement" required>
                <input type="time" id="report_time" name="report_time" placeholder="Heure du signalement">
            </div>
            <input type="text" id="pet_name" name="pet_name" placeholder="Nom">
            <div class="flex_fields">
                <input type="text" id="pet_breed" name="pet_breed" placeholder="Race">
                <input type="text" id="pet_coat" name="pet_coat" placeholder="Robe">
            </div>
            <div class="flex_fields">
                <input type="number" id="pet_age" name="pet_age" placeholder="Age">
                <select id="pet_sex" name="pet_sex">
                    <option disabled selected>Sexe</option>
                    <option value="male">Mâle</option>
                    <option value="female">Femelle</option>
                </select>
            </div>
            <textarea id="comment" name="comment" placeholder="Texte de l'annonce"></textarea>
            <button type="submit" id="report_submit" class="btn_confirm" name="report_submit" value="submit">Soumettre</button>
            <!-- <geolocation id="report_location" name="report_location" placeholder="Lieu du signalement" required></geolocation> -->
        </form>
    </dialog>
</main>