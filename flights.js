// Amadeus : traval API

function onJson(json) {
    console.log('JSON ricevuto');
    const flightResult = document.querySelector('#flight-result'); 
    
    if(flightResult !== null)
        flightResult.innerHTML = '';

    if (!json.data) {
        const error = document.createElement('div');
        error.classList.add('flight');
        error.textContent = 'Flight not found!';
        flightResult.appendChild(error);
    } else {

        const flights = json.data;
        let number = flights.length;
        console.log('Numero di voli trovati: ' + number);

        if (number > 5) {
            number = 5;
        }


        if (number === 0) {
            const error = document.createElement('div');
            error.classList.add('flight');
            error.textContent = 'Sorry, we found nothing!';
            flightResult.appendChild(error);
        }


        for (let i = 0; i < number; i++) {

            const flightDiv = document.createElement('div');
            flightDiv.classList.add('flight');
            
            const flight = flights[i];
            
            const departure = flight.itineraries[0].segments[0].departure.iataCode;
            const departureTime = flight.itineraries[0].segments[0].departure.at;
            const dTime = departureTime.substring(11,16);

            const arrival = flight.itineraries[0].segments[0].arrival.iataCode;
            const arrivalTime = flight.itineraries[0].segments[0].arrival.at;
            const aTime = arrivalTime.substring(11,16);

            const flightNumber = flight.itineraries[0].segments[0].carrierCode + flight.itineraries[0].segments[0].number;

            const price = flight.price.total;

            const stopover = flight.itineraries[0].segments[0].numberOfStops;
            const stopoverText = stopover === 0 ? "Non-stop" : stopover + " stop(s)";


            // Result
            const index = i+1;

            const captionResult = document.createElement('div');
            captionResult.classList.add('flight-caption');
            captionResult.textContent = "Result: " + index ;
            flightDiv.appendChild(captionResult);

            // FROM 
            const captionFrom = document.createElement('div');
            captionFrom.classList.add('flight-caption');
            captionFrom.textContent = "From: " + departure + " at : " + dTime + 
                                       " To: " + arrival + " at : " + aTime;
            flightDiv.appendChild(captionFrom);

            // PRICE
            const captionPrice = document.createElement('div');
            captionPrice.classList.add('flight-caption');
            captionPrice.textContent = "Price: " + price + " €";
            flightDiv.appendChild(captionPrice); 

            // FLIGHT number
            const captionFlight = document.createElement('div');
            captionFlight.classList.add('flight-caption');
            captionFlight.textContent = " Stopovers: " + stopoverText;
            flightDiv.appendChild(captionFlight);

            // INTERA CAPTION
            flightResult.appendChild(flightDiv);

        }
    }
}

function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
}

function flightSearch(event) {

    event.preventDefault();

    const departureCity = document.querySelector('#departure-input');
    const encodedDepartureCity = encodeURIComponent(departureCity.value);

    const destinationCity = document.querySelector('#destination-input');
    const encodedDestinationCity = encodeURIComponent(destinationCity.value);

    const flightDate = document.querySelector('#date-input');

    console.log('Eseguo ricerca: ' + encodedDepartureCity + ' - ' + encodedDestinationCity);
    
    fetch('https://test.api.amadeus.com/v2/shopping/flight-offers?originLocationCode=' 
    + encodedDepartureCity + '&destinationLocationCode=' + encodedDestinationCity 
    + '&departureDate=' + flightDate.value + '&adults=1',
    {
        headers:
        {
            'Authorization': 'Bearer ' +  token
        }
    }
).then(onResponse).then(onJson)
}


// Richiesta del token
function onTokenJson(json)
{
  token = json.access_token;
  console.log('Token ricevuto:', token);
}


function onTokenResponse(response){
    return response.json();
}

const clientKey = 'clientId';
const clientSecret = 'clientSecret';
let token;

fetch('https://test.api.amadeus.com/v1/security/oauth2/token',
    {
        method: 'POST',
        body: 'grant_type=client_credentials',
        headers:
        {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': 'Basic ' + btoa(clientKey + ':' + clientSecret)
        }
    }
    )
    .then(onResponse)
    .then(onTokenJson)

const travelButton = document.querySelector('#flight-search-bar #submit');
travelButton.addEventListener('click', flightSearch);