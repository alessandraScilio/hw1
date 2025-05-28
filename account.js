// Post con like

function onJSON(json) {
    const container = document.getElementById('liked-posts-container');
    container.innerHTML = ''; 

    if (json.length === 0) {
        const msg = document.createElement('p');
        msg.textContent = 'No liked posts yet.';
        msg.classList.add('no-liked-msg'); 
        container.appendChild(msg);
        return;
    }

    for (const post of json) {
        const postDiv = document.createElement('div');
        postDiv.classList.add('liked-post');

        const title = document.createElement('h3');
        title.classList.add('liked-post-title');
        title.textContent = post.title;

        postDiv.appendChild(title);
        container.appendChild(postDiv);
    }
}

function onResponse(response){
 if (response.ok) {
        return response.json();
    } else {
        throw new Error('Network response was not ok');
    }
}

fetch('accountInfo.php?').then(onResponse).then(onJSON);