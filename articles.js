function readMoreFunction(articleDiv, articleData) {
    // Rimpiazza il preview con il testo completo
    const preview = articleDiv.querySelector('p');
    preview.textContent = articleData.content;

    const readMoreBtn = articleDiv.querySelector('.read-more');
    if (readMoreBtn) readMoreBtn.remove();

    // Container per i commenti
    const commentsDiv = document.createElement('div');
    commentsDiv.classList.add('comments-container');
    articleDiv.appendChild(commentsDiv);

    // Carica ultimi 3 commenti
    fetch(`getComments.php?article_id=${articleData.id}`)
        .then(response => response.json())
        .then(comments => {
            comments.slice(-2).forEach(comment => {
                const commentP = document.createElement('p');
                commentP.classList.add('comment');
                commentP.textContent = comment.comment_text;
                commentsDiv.appendChild(commentP);
            });
        });

    // Form per aggiungere un commento
    const commentForm = document.createElement('form');
    commentForm.classList.add('comment-form');

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Write a comment...';
    input.required = true;

    const submitBtn = document.createElement('input');
    submitBtn.type = 'submit';
    submitBtn.textContent = 'Send';

    commentForm.appendChild(input);
    commentForm.appendChild(submitBtn);
    articleDiv.appendChild(commentForm);

    submitBtn.addEventListener('click', function(e) {
        
        e.preventDefault();
        const comment = input.value.trim();
       
        if (comment === '') {
            alert('Please enter a comment before submitting.');
            return;
        } 

        fetch('addComment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                article_id: articleData.id,
                comment: comment
            })
        })
        .then(response => response.json())
        .then(newComment => {
            const commentP = document.createElement('p');
            commentP.textContent = newComment.content;
            commentsDiv.appendChild(commentP);
            input.value = '';
        });
    });

    const showLessBtn = document.createElement('button');
    showLessBtn.textContent = 'Read less';
    showLessBtn.classList.add('read-more');
    articleDiv.appendChild(showLessBtn);

    showLessBtn.addEventListener('click', () => {
        preview.textContent = articleData.content.substring(0,150);

        commentsDiv.remove();
        commentForm.remove();
        showLessBtn.remove();

        const newReadMoreBtn = document.createElement('button');
        newReadMoreBtn.textContent = 'Read more';
        newReadMoreBtn.classList.add('read-more');
        articleDiv.appendChild(newReadMoreBtn);
        newReadMoreBtn.addEventListener('click', () => {
            readMoreFunction(articleDiv, articleData);
        });
    });
}


// Articles research and like functionality
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

            likeImg.replaceWith(likeImg.cloneNode(true));
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

        const likeImg = document.createElement('img');
        likeImg.dataset.id = article.id;
        
        if (article.liked == 0) {
            likeImg.src = 'pics/like.svg';
        } else {
            likeImg.src = 'pics/liked.svg';
        }


        const likeCount = document.createElement('p');
        likeCount.textContent = article.like_count;

        const handler = article.liked ? unlikeFunction(article.id, likeImg, likeCount) : likeFunction(article.id, likeImg, likeCount);
        likeImg.addEventListener('click', handler);
        actionDiv.appendChild(likeImg);

        actionDiv.appendChild(likeCount);
    
        const commentImg = document.createElement('img');
        commentImg.src = 'pics/comment.svg';
        const commentCount = document.createElement('p');
        commentCount.textContent = article.comment_count;
        commentImg.addEventListener('click', () => readMore(article));

        actionDiv.appendChild(commentImg);
        actionDiv.appendChild(commentCount);

        const shareImg = document.createElement('img');
        shareImg.src = 'pics/share.svg';
        actionDiv.appendChild(shareImg);

        articleDiv.appendChild(actionDiv);

        const readMore = document.createElement('a');
        readMore.textContent = 'Read more';
        readMore.classList.add('read-more');
        readMore.addEventListener('click', () => readMoreFunction(articleDiv, article));
        articleDiv.appendChild(readMore);

        articleDiv.dataset.id = article.id; // Article: data-id attribute
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


const searchForm = document.getElementById('search-form');
if (searchForm) {
    searchForm.addEventListener('submit', searchArticles);
}

