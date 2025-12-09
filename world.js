window.addEventListener('DOMContentLoaded', function() {

    const lookupBtn = document.getElementById('lookup');
    const lookupCitiesBtn = document.getElementById('lookup-cities');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    // --- COUNTRY LOOKUP ---
    lookupBtn.addEventListener('click', function() {
        const country = countryInput.value.trim();
        const url = `world.php?country=${encodeURIComponent(country)}`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                resultDiv.innerHTML = "Error: " + error;
            });
    });

    // --- CITIES LOOKUP ---
    lookupCitiesBtn.addEventListener('click', function() {
        const country = countryInput.value.trim();
        const url = `world.php?country=${encodeURIComponent(country)}&lookup=cities`;

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                resultDiv.innerHTML = "Error: " + error;
            });
    });

});
