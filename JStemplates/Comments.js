function Comments(id) {
    async function req() {
        const result = await fetch(`/api/posts/comment/${id}`);
        const data = await result.json();
        return data;
    }
    const Comments = document.createElement('div');
    Comments.className = 'post__comments post__comments-closed';
    req().then((data) => {
        console.log(data);
        data.forEach(c => {
            html = `
    <div class="post__comment mt">
        <div class="post__comment__wrapper">
            <a href="/profile/${c.nickname}"><img class="post__comment__avatar" src="/api/images/avatars/${c.avatar}"
                    alt="" /></a>
            <div class="flex ml">
                <div class="post__comment__nickname">
                    <a href="/profile/${c.nickname}">${c.nickname}</a>
                </div>
                <div class="post__comment__date ml">${formatDate(c.date)}</div>
            </div>
        </div>
        <div class="post__comment__text">${c.text}</div>
    </div>`
            Comments.insertAdjacentHTML('beforeend', html);
        })
    }, () => console.log("Fetch comments ERROR"));
    Comments
    return Comments;
}