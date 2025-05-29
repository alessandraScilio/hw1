async function loadLikedPosts() {
    try {
        const response = await fetch('getPosts.php');
        const posts = await response.json();
        
        if (posts.error) {
            throw new Error(posts.error);
        }
        
        posts.forEach(post => {
            console.log('Post ID:', post.id);
            console.log('Title:', post.title);
            console.log('Image URL:', post.image_url);
            

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
                // Aggiungere reindirizzamento per articoli
            }
        });
        
    } catch (error) {
        console.error('Error loading liked posts:', error);
        const container = document.getElementById('liked-posts-container');
        if (container) {
            container.innerHTML = `<p class="error">Error: ${error.message}</p>`;
        }
    }
}

document.addEventListener('DOMContentLoaded', loadLikedPosts);