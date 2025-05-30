<?php 
require_once 'auth.php';
require_once 'amadeus_functions.php';


if (!checkAuth()) exit;

header('Content-Type: application/json');

$client_id = "";
$client_secret = "";

$accessToken = get_amadeus_token($client_id, $client_secret);
if (!$accessToken) {
    echo json_encode(['error' => 'Impossibile ottenere token da Amadeus']);
    exit;
}


$departureCity = $_POST['departure_city'];
$destinationCity = $_POST['destination_city'];
$date = $_POST['date'];



$departureIATA = get_IATA_code($departureCity, $accessToken);
$destinationIATA = get_IATA_code($destinationCity, $accessToken);

if (!$departureIATA || !$destinationIATA) {
    die("Errore: impossibile trovare i codici IATA");
}

$flights = searchFlights($departureIATA, $destinationIATA, $date, $accessToken);
echo json_encode($flights);
?>



