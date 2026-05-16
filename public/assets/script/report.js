// Page Report

const report_form = document.getElementById('report_form');
const location_form = document.getElementById('location_form');


// upload_wrapper
const f_input = document.getElementById('file_input');
const upload_btn = document.getElementById('upload_btn');
const preview = document.getElementById('upload_preview');
const img = document.getElementById('image_preview');
const file_name = document.getElementById('file_name');
const error = document.getElementById('upload_error');
const remove = document.getElementById('remove_btn');

const ALLOWED_TYPES = new Set(['image/jpeg', 'image/png', 'image/webp']);

upload_btn.addEventListener('click', () => f_input.click());

f_input.addEventListener('change', () => {
    const file = f_input.files[0];

    if (error.textContent) {
        error.textContent = '';
        error.style.display = 'none';
    }

    if (!file) return;

    if (!ALLOWED_TYPES.has(file.type)) {
        console.log("erreur format!");
        error.textContent = "Format invalide (jpg, png, webp)";
        error.style.display = 'block';
        return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        upload_btn.style.display = 'none';
        img.src = e.target.result;
        preview.style.display = 'flex';
        file_name.textContent = file.name;
    };

    reader.readAsDataURL(file);
});

remove.addEventListener('click', () => {
    f_input.value = '';
    preview.style.display = 'none';
    img.src = '';
    file_name.textContent = '';
    upload_btn.style.display = 'block';
});

// Location form

const report_location = document.getElementById('report_location');
const location_btn = document.getElementById('location_btn');

[report_location, location_btn].forEach(event => {
    event.addEventListener('click', () => {
        report_form.style.display = 'none';
        location_form.style.display = 'grid';
    })
});

// Géolocalisation

const geo_msg = document.getElementById('geo_msg');
const geo_btn = document.getElementById('geo_btn');

geo_btn.addEventListener('click', () => {

    if (!navigator.geolocation) {
        geo_msg.textContent = "Géolocalisation non supportée";
        return;
    }
    geo_msg.textContent = "Localisation en cours...";

    navigator.geolocation.getCurrentPosition(
        (position) => {
            const lat = position.coords.latitude.toFixed(6);
            const lon = position.coords.longitude.toFixed(6);
            report_location.value = `Lat. ${lat}, Lon. ${lon}`;
            report_location.className = '';
            report_location.style.marginBottom = '0';
            report_location.style.pointerEvents = 'none';
            report_location.style.backgroundColor = 'var(--bg-color-primary)';
            location_form.style.display = 'none';
            report_form.style.display = 'grid';
            location_btn.style.display = 'block';
            geo_msg.textContent = "";
            return
        },
        (error) => {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                geo_msg.textContent = "Permission refusée";
                break;
                case error.POSITION_UNAVAILABLE:
                geo_msg.textContent = "Position indisponible";
                break;
                case error.TIMEOUT:
                geo_msg.textContent = "Délai d'attente dépassé";
                break;
                default:
                geo_msg.textContent = "Erreur inconnue";
            }
        },
        {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0
        }
    );
});

// Localisation manuelle

const manual_btn = document.getElementById('manual_btn');

manual_btn.addEventListener('click', async () => {

    const number = document.getElementById('street_number').value.trim();
    const street = document.getElementById('street_name').value.trim();
    const zipCode = document.getElementById('zip_code').value.trim();
    const city = document.getElementById('city').value.trim();

    // Validation minimale
    if (!street || !zipCode || !city) {
        alert('Veuillez renseigner voie, code postal et ville.');
        return;
    }

    // Construction intelligente de l'adresse
    let address = [];

    if (number) {
        address.push(number);
    }

    address.push(street, zipCode, city);
    
    const fullAddress = address.join(' ');

    try {

        const url = `https://data.geopf.fr/geocodage/search?q=${encodeURIComponent(fullAddress)}&limit=1`;

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error('Erreur API');
        }

        const data = await response.json();

        if (!data.features || !data.features.length) {
            alert('Adresse introuvable.');
            return;
        }

        // API GEO PF => [longitude, latitude]
        const coordinates = data.features[0].geometry.coordinates;

        const lon = Number(coordinates[0]).toFixed(6);
        const lat = Number(coordinates[1]).toFixed(6);

        // Stockage dans le hidden
        report_location.value = `Lat. ${lat}, Lon. ${lon}`;
        report_location.className = '';
        report_location.style.marginBottom = '0';
        report_location.style.pointerEvents = 'none';
        report_location.style.backgroundColor = 'var(--bg-color-primary)';
        location_form.style.display = 'none';
        report_form.style.display = 'grid';
        location_btn.style.display = 'block';

    } catch (error) {

        console.error(error);
        alert('Erreur lors du géocodage.');

    }

});

// Soumission du formulaire