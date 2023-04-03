function formatDate(timestamp) {
    const date = new Date(+timestamp * 1000);
    return (date.getDate() + "").padStart(2, '0') + '.' + (date.getMonth() + 1 + "").padStart(2, '0') + '.' +
        date.getFullYear()
}

document.querySelector('.main__content').addEventListener('scroll', function (e) {
    if (this.scrollHeight - (this.scrollTop + window.innerHeight) < 200) { loadPosts(page); page++; }
})