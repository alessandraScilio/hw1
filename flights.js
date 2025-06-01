function handleError(error) {
    const output = document.getElementById('flight-result');
    output.textContent = "Errore";
    console.error('Errore fetch:', error);
}


function handleResult(flights) {
    const flightResult = document.getElementById('flight-result');
    flightResult.classList.add('show');
    flightResult.innerHTML = '';

    if (flights.error) {
        flightResult.textContent = '<p style="color: red;">Errore: ' + flights.error + '</p>';
        return;
    }

    for (let i = 0; i < flights.length; i++) {
        const flightDiv = document.createElement('div');
        flightDiv.classList.add('flight');
        const flight = flights[i];

        const segment = flight.itineraries[0].segments[0];
        
        const departure = segment.departure.iataCode;
        const departureTime = segment.departure.at;
        const dTime = departureTime.substring(11, 16);

        const arrival = segment.arrival.iataCode;
        const arrivalTime = segment.arrival.at;
        const aTime = arrivalTime.substring(11, 16);

        const flightNumber = segment.carrierCode + segment.number;
        const price = flight.price.total;

        const stopover = segment.numberOfStops;
        const stopoverText = stopover === 0 ? "Non-stop" : stopover + " stop(s)";

        const index = i + 1;

        const captionResult = document.createElement('div');
        captionResult.classList.add('flight-caption');
        captionResult.textContent = "Result: " + index;
        flightDiv.appendChild(captionResult);

        const captionFrom = document.createElement('div');
        captionFrom.classList.add('flight-caption');
        captionFrom.textContent = "From: " + departure + " at: " + dTime + 
                                  " → To: " + arrival + " at: " + aTime;
        flightDiv.appendChild(captionFrom);

        const captionPrice = document.createElement('div');
        captionPrice.classList.add('flight-caption');
        captionPrice.textContent = "Price: " + price + " €";
        flightDiv.appendChild(captionPrice);

        const captionFlight = document.createElement('div');
        captionFlight.classList.add('flight-caption');
        captionFlight.textContent = "Flight: " + flightNumber + " — Stopovers: " + stopoverText;
        flightDiv.appendChild(captionFlight);

        flightResult.appendChild(flightDiv);
    }
}

function handleResponse(response) {
    if (!response.ok) {
        throw new Error('Errore nella risposta del server');
    }
    return response.json();
}

function handleFlightSearch(event) {
    event.preventDefault();    
    const form = document.getElementById('flight-search-form');
    const formData = new FormData(form);

    fetch('getFlight.php', {
        method: 'POST',
        body: formData
    })
    .then(handleResponse)
    .then(handleResult)
    .catch(handleError);
}


const submitBtn = document.getElementById('submit');
submitBtn.addEventListener('click', handleFlightSearch);