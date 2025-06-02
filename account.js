function getData() {
    fetch('getPosts.php')
        .then(response => response.json())
        .then(posts => {
            if (posts.error) {
                throw new Error(posts.error);
            }

            posts.forEach(post => {
                const container = document.getElementById('liked-posts-container');
                if (container) {
                    const postElement = document.createElement('div');
                    postElement.className = 'liked-post';

                    const postImg = document.createElement('img');
                    postImg.src = post.image_url || 'default.jpg';
                    postElement.appendChild(postImg);

                    const postTitle = document.createElement('h3');
                    postTitle.textContent = post.title;
                    postTitle.className = 'liked-post-title';
                    postElement.appendChild(postTitle);

                    container.appendChild(postElement);
                }
            });
        })
        .catch(error => {
            console.error('Error loading liked posts:', error);
            const container = document.getElementById('liked-posts-container');
            if (container) {
                container.innerHTML = `<p class="error">Error: ${error.message}</p>`;
            }
        });


        fetch('getBookings.php')
        .then(response => response.json())
        .then(bookings => {
            if (bookings.error) {
                throw new Error(bookings.error);
            }

            const bookingsContainer = document.getElementById('bookings-container');
            let totalPrice = 0;

             bookings.forEach(booking => {
                if (bookingsContainer) {
                    const bookedFlight = document.createElement('div');
                    bookedFlight.classList.add('booked-flight');
                    bookedFlight.textContent = "Flight ID: " + booking.flight_id + "- Price: " + booking.price;
                    bookingsContainer.appendChild(bookedFlight);
                }
                totalPrice += parseFloat(booking.price);
                });

                if (bookingsContainer) {
                const totalDiv = document.createElement('div');
                totalDiv.classList.add('total-price');
                totalDiv.textContent = "Total price: " + totalPrice.toFixed(2) + " €";
                bookingsContainer.appendChild(totalDiv);
                }

        })
        .catch(error => {
            console.error('Error loading liked posts:', error);
            const container = document.getElementById('liked-posts-container');
            if (container) {
                container.innerHTML = `<p class="error">Error: ${error.message}</p>`;
            }
        });

}


document.addEventListener('DOMContentLoaded', getData);
