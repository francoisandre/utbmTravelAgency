<?php
include_once __DIR__.'/../db/dbConnection.php';
include_once __DIR__.'/common/session.php';
include_once __DIR__.'/common/header.php';
$currentActiveMenu = "add_trip";
include_once __DIR__.'/common/menu.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Trip</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Add a New Trip</h2>

    <!-- Formulaire pour ajouter un voyage -->
    <form action="../controller/process_add_trip.php" method="POST">
        <!-- Menu déroulant pour sélectionner la destination -->
        <div class="form-group">
            <label for="destination">Destination</label>
            <select class="form-control" id="destination" name="destination" required>
                <option value="" disabled selected>Select Destination</option>
            </select>
        </div>

        <!-- Sélection du type de package -->
        <div class="form-group">
            <label for="package_type">Package Type</label>
            <select class="form-control" id="package_type" name="package_type" required onchange="fetchOptionsByPackage()">
                <option value="" disabled selected>Select Package Type</option>
                <option value="vacation">Vacation</option>
                <option value="adventure">Adventure</option>
                <option value="business">Business</option>
                <option value="luxe">Luxury</option>
            </select>
        </div>

        <!-- Hébergement (dynamique) -->
        <div class="form-group">
            <label for="accommodation">Accommodation</label>
            <select class="form-control" id="accommodation" name="accommodation" required>
                <option value="" disabled selected>Select Accommodation</option>
            </select>
        </div>

        <!-- Transport (dynamique) -->
        <div class="form-group">
            <label for="transportation">Transport</label>
            <select class="form-control" id="transportation" name="transportation" required>
                <option value="" disabled selected>Select Transport</option>
            </select>
        </div>

        <!-- Date de début et date de fin -->
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <!-- Champ pour le nombre de voyageurs -->
        <div class="form-group">
            <label for="number_of_travelers">Number of Travelers</label>
            <input type="number" class="form-control" id="number_of_travelers" name="number_of_travelers" min="1" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save the Trip</button>
    </form>
</div>

<script>
    // Charger les destinations
    document.addEventListener('DOMContentLoaded', () => {
        const destinationSelect = document.getElementById("destination");

        fetch('../controller/get_destinations.php')
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                } else {
                    data.forEach(destination => {
                        const option = document.createElement("option");
                        option.value = destination;
                        option.textContent = destination;
                        destinationSelect.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error fetching destinations:', error));
    });

    // Charger les options d'hébergement et de transport en fonction du package
    function fetchOptionsByPackage() {
        const packageType = document.getElementById("package_type").value;
        const accommodationSelect = document.getElementById("accommodation");
        const transportationSelect = document.getElementById("transportation");

        accommodationSelect.innerHTML = '<option value="" disabled selected>Select Accommodation</option>';
        transportationSelect.innerHTML = '<option value="" disabled selected>Select Transport</option>';

        fetch('../controller/get_options_by_package.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'package_type=' + encodeURIComponent(packageType)
        })
            .then(response => response.json())
            .then(data => {
                if (data.accommodations && data.transportation) {
                    data.accommodations.forEach(accommodation => {
                        const option = document.createElement("option");
                        option.value = accommodation;
                        option.textContent = accommodation;
                        accommodationSelect.appendChild(option);
                    });
                    data.transportation.forEach(transport => {
                        const option = document.createElement("option");
                        option.value = transport;
                        option.textContent = transport;
                        transportationSelect.appendChild(option);
                    });
                } else {
                    console.error("Error: Missing accommodation or transport data");
                }
            })
            .catch(error => console.error('Error fetching options by package:', error));
    }
</script>

</body>
</html>
