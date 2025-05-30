<?php


function get_amadeus_token($client_id, $client_secret) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://test.api.amadeus.com/v1/security/oauth2/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    
    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        error_log('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);
    $decoded = json_decode($response, true);
    return $decoded['access_token'] ?? null;
}


function get_IATA_code($cityName, $accessToken) {
    $url = 'https://test.api.amadeus.com/v1/reference-data/locations?subType=CITY&keyword=' . urlencode($cityName) . '&page[limit]=1';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);

    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response, true);
    
    if (!empty($decoded['data'][0]['iataCode'])) {
        return $decoded['data'][0]['iataCode'];
    }
    return null;
}

function searchFlights($originIATA, $destinationIATA, $date, $accessToken, $adults = 1) {
    $queryString = 
        'originLocationCode=' . urlencode($originIATA) .
        '&destinationLocationCode=' . urlencode($destinationIATA) .
        '&departureDate=' . urlencode($date) .
        '&adults=' . intval($adults) .
        '&max=5';

    $url = 'https://test.api.amadeus.com/v2/shopping/flight-offers?' . $queryString;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);

    $response = curl_exec($ch);
    curl_close($ch);
    $decoded = json_decode($response, true);

    if (!empty($decoded['data'])) {
        return $decoded['data'];
    } elseif (!empty($decoded['errors'])) {
        return ['error' => $decoded['errors'][0]['detail'] ?? 'General error'];
    }
    return ['error' => 'No answer from API'];
}


?>