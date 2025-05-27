
function openModal(article) {
    const modal = document.getElementById('article-modal');
    document.getElementById('modal-image').src = article.image_url || 'pics/default_img.jpeg';
    document.getElementById('modal-title').textContent = article.title;
    document.getElementById('modal-content').textContent = article.content;
    document.getElementById('modal-likes').textContent = article.like_count;
    document.getElementById('modal-comments').textContent = article.comment_count;

    modal.classList.remove('hidden');
}

function closeModal() {
    const modal = document.getElementById('article-modal');
    modal.classList.add('hidden');
}


function onLikeResponse(response) {
    if (response.ok) {
        return response.json();
    } else {
        throw new Error('Network response was not ok');
    }
}

function onUnlikeResponse(response) {
    if (response.ok) {
        return response.json();
    } else {
        throw new Error('Network response was not ok');
    }
}

function likeFunction(articleId, likeImg, likeCount) {
    return function () {
        const data = { article_id: articleId };

        fetch('likeArticles.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(onLikeResponse)
        .then(result => {
            likeImg.src = 'pics/liked.svg';
            likeCount.textContent = result.like_count;
            likeImg.replaceWith(likeImg.cloneNode(true)); // remove all listeners
            likeImg = document.querySelector(`img[data-id="${articleId}"]`);
            likeImg.addEventListener('click', unlikeFunction(articleId, likeImg, likeCount));
        });
    };
}

function unlikeFunction(articleId, likeImg, likeCount) {
    return function () {
        const data = { article_id: articleId };

        fetch('unlikeArticles.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(onUnlikeResponse)
        .then(result => {
            likeImg.src = 'pics/like.svg';
            likeCount.textContent = result.like_count;
            likeImg.replaceWith(likeImg.cloneNode(true));
            likeImg = document.querySelector(`img[data-id="${articleId}"]`);
            likeImg.addEventListener('click', likeFunction(articleId, likeImg, likeCount));
        });
    };
}

function onJSON(json) {
    const container = document.getElementById('articles-container');
    container.innerHTML = '';

    if (json.length === 0) {
        const msg = document.createElement('p');
        msg.textContent = 'No articles found.';
        container.appendChild(msg);
        return;
    }

    for (const article of json) {
        const articleDiv = document.createElement('div');
        articleDiv.classList.add('article');

        const image = document.createElement('img');
        image.src = article.image_url || 'pics/default_img.jpeg';
        articleDiv.appendChild(image);

        const title = document.createElement('h3');
        title.textContent = article.title;
        articleDiv.appendChild(title);

        const preview = document.createElement('p');
        preview.textContent = article.content.length > 150 ? article.content.substring(0, 150) + '...' : article.content;
        articleDiv.appendChild(preview);

        const actionDiv = document.createElement('div');
        actionDiv.classList.add('article-meta');

        const likeCount = document.createElement('p');
        likeCount.textContent = article.like_count;
        actionDiv.appendChild(likeCount);


        const likeImg = document.createElement('img');
        likeImg.dataset.id = article.id;
    
        
        if (article.liked == 0) {
            likeImg.src = 'pics/like.svg';
        } else {
            likeImg.src = 'pics/liked.svg';
        }

        const handler = article.liked ? unlikeFunction(article.id, likeImg, likeCount) : likeFunction(article.id, likeImg, likeCount);
        likeImg.addEventListener('click', handler);
        actionDiv.appendChild(likeImg);
    
    
        const commentImg = document.createElement('img');
        commentImg.src = 'pics/comment.svg';
        const commentCount = document.createElement('p');
        commentCount.textContent = article.comment_count;
        commentImg.addEventListener('click', () => openModal(article));

        actionDiv.appendChild(commentImg);
        actionDiv.appendChild(commentCount);

        const shareImg = document.createElement('img');
        shareImg.src = 'pics/share.svg';
        actionDiv.appendChild(shareImg);

        articleDiv.appendChild(actionDiv);

        const readMore = document.createElement('a');
        readMore.textContent = 'Read more';
        readMore.classList.add('read-more');
        readMore.addEventListener('click', () => openModal(article));
        articleDiv.appendChild(readMore);

        container.appendChild(articleDiv);
    }
}

function onResponse(response) {
    return response.json();
}

function searchArticles(event) {
    event.preventDefault(); 
    const formData = new FormData(event.target);
    fetch('searchArticles.php', {
        method: 'POST',
        body: formData
    }).then(onResponse).then(onJSON);
}

document.addEventListener('DOMContentLoaded', function(){
   
    window.addEventListener('click', function(e) {
        if (e.target.id === 'article-modal') {
            closeModal();
        }
    });

    const modal = document.getElementById('article-modal');
    modal.addEventListener('click', function (event) {
        if (event.target.id === 'article-modal') {
            closeModal();
        }
    });

});


const searchForm = document.getElementById('search-form');
if (searchForm) {
    searchForm.addEventListener('submit', searchArticles);
}
