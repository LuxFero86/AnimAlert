<main>

    <!-- Formulaire principal -->
    <form id="report_form" action="/post" method="post" enctype="multipart/form-data">
        
        <p id="info">* Champs obligatoires</p>
        <input type="hidden" id="report_type" name="report_type" value="<?= $data["report_type"] ?>"/>

        <div id="upload_wrapper">
            <input type="file" id="file_input" name="file_input" accept="image/*" <?= $data["report_type"] == 1 ? 'capture="environment"' : '' ?> hidden/>
            <p id="upload_error" class="error at_top"></p>
            <button type="button" id="upload_btn" class="btn addInfo_btn at_top onclick">Ajouter une photo</button>
            <div id="upload_preview">
                <div id="upload_area">
                    <img id="image_preview" src="" alt="Photo du signalement" />
                    <p id="file_name"></p>
                </div>
                <button type="button" id="remove_btn" class="btn onclick">Supprimer</button>
            </div>
        </div>

        <input type="text" id="report_location" class="btn addInfo_btn at_top onclick" name="report_location" value="" placeholder="Ajouter un lieu *" required>
        <button id="location_btn" class="btn addInfo_btn at_top onclick" type="button">Modifier le lieu</button>
        
        <div class="field_flex">
            <select id="pet_type" name="pet_type" aria-label="Type d'animal" required>
                <option value="" disabled selected>Type d'animal *</option>
                <?php foreach ($data["pet_types"] as $type): ?>
                    <option value="<?= $type->getId() ?>"><?= $type->getType() ?></option>
                <?php endforeach ?>
            </select>
            <select id="pet_sex" name="pet_sex" aria-label="Sexe">
                <option disabled selected>Sexe</option>
                <option value="1">Mâle</option>
                <option value="0">Femelle</option>
            </select>
        </div>

         <label for="report_datetime"><?= $data["report_type"] == 0 ? "Perdu" : "Trouvé" ?> le : *</label>
        <input type="datetime-local" id="report_datetime" name="report_datetime" required/>

        <?php if($data["report_type"] == 0): ?>
            <div class="field_flex">
                <input type="text" id="pet_name" name="pet_name" placeholder="Nom"/>
                <input type="number" id="pet_age" name="pet_age" placeholder="Age" min="1"/>
            </div>
        <?php endif ?>

        <div class="field_flex">
            <input type="text" id="pet_breed" name="pet_breed" placeholder="Race"/>
            <input type="text" id="pet_coat" name="pet_coat" placeholder="Robe"/>
        </div>

        <textarea id="report_comment" name="comment" placeholder="Remplissez et fournissez le plus d'informations utiles possibles"></textarea>

        <?php if($data["report_type"] == 1): ?>
            <div id="deceased_check" class="inline_flex">
                <input type="checkbox" id="is_deceased" name="is_deceased"/>
                <label for="is_deceased">Décédé</label>
            </div>
        <?php endif ?>

        <button type="submit" id="report_submit" class="btn confirm_btn" name="submit" value="submit">Soumettre</button>

    </form>

    <!-- Formulaire localisation -->
     <form id="location_form">
        <p id="geo_msg"></p>
        <button type="button" id="geo_btn" class="btn addInfo_btn at_top onclick">Me localiser</button>
        <p class="separator"">ou</p>
        <input type="number" id="street_number" name="street_number" placeholder="N°" min="1"/>
        <input type="text" id="street_name" name="street_name" placeholder="Nom de la voie" required/>
        <input type="number" id="zip_code" name="zip_code" placeholder="Code Postal" min="00001" max="99999" required/>
        <input type="text" id="city" name="city" placeholder="Ville" required/>
        <button type="button" id="manual_btn" class="btn addInfo_btn onclick">Valider</button>
     </form>

</main>
