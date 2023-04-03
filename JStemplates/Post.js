function Post(content, my) {
    const html = `
    <div class="feed__block">
        <div class="post" id="post_${content.id}">
            <header class="post__header">
                <div class="post__avatar">
                    <a href="/profile/${content.nickname}">
                        <img src="/api/images/avatars/${content.avatar}" alt="avatar">
                    </a>
                </div>
                <div class="post__header__wrapper">
                    <div class="post__author">
                        <a href="/profile/${content.nickname}">${content.nickname}</a>
                    </div>
                    <div class="post__date">
                        ${formatDate(content.date)}
                    </div>
                </div>
            </header>
            <div class="separator"></div>
            <div class="post__content">
                <div class="post__text">
                    ${content.text}
                </div>
            </div>
            <div class="post__reactions">
                ${/* <button class="post__like">
                    <i class="Icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                            <path
                                d="m480 935-41-37q-105.768-97.121-174.884-167.561Q195 660 154 604.5T96.5 504Q80 459 80 413q0-90.155 60.5-150.577Q201 202 290 202q57 0 105.5 27t84.5 78q42-54 89-79.5T670 202q89 0 149.5 60.423Q880 322.845 880 413q0 46-16.5 91T806 604.5Q765 660 695.884 730.439 626.768 800.879 521 898l-41 37Zm0-79q101.236-92.995 166.618-159.498Q712 630 750.5 580t54-89.135q15.5-39.136 15.5-77.72Q820 347 778 304.5T670.225 262q-51.524 0-95.375 31.5Q531 325 504 382h-49q-26-56-69.85-88-43.851-32-95.375-32Q224 262 182 304.5t-42 108.816Q140 452 155.5 491.5t54 90Q248 632 314 698t166 158Zm0-297Z" />
                            /svg>
                    </i>
                </button> */ ''}
                <button class="reaction__comments">
                    <i class="Icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                            <path
                                d="M880 976 720 816H140q-23 0-41.5-18.5T80 756V236q0-23 18.5-41.5T140 176h680q24 0 42 18.5t18 41.5v740ZM140 236v520h605l75 75V236H140Zm0 0v595-595Z" />
                        </svg>
                    </i>
                </button>
            </div>
            <div class="separator"></div>
        </div>
        `;
    document.querySelector('.posts').insertAdjacentHTML('beforeend', html);
    const post = document.querySelector(`#post_${content.id}`);
    if (my) {
        const menu = document.createElement('div');
        menu.className = 'post__menu';
        let btn = document.createElement('button');
        btn.className = "dropdown-item dangerous";
        btn.append('Удалить');
        btn.addEventListener('click', async () => {
            post.parentNode.remove();
            await fetch('/api/posts/' + content.id, { method: 'DELETE' });
            if (refreshStats) refreshStats(await getStats());
        })
        menu.append(btn)
        post.querySelector(`header`).append(Dropdown(content.id, menu));
    }
    const content_wrapper = document.querySelector(`#post_${content.id} .post__content`);
    content.images ? content_wrapper.append(Slider(content.images.split(' '))) : '';
    const commentsNode = Comments(content.id);
    post.querySelector('.reaction__comments').onclick = () => {
        commentsNode.classList.toggle('post__comments-closed');
    }
    post.append(commentsNode);
    post.append(Input(content.id));
}