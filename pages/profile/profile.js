document.querySelectorAll('#follow-btn').forEach(btn => btn.onclick = async function () {
    this.classList.toggle('submit');
    this.classList.toggle('color-white');
    if (this.classList.contains('submit')) {
        this.textContent = 'Подписаться';
        await fetch('/api/unfollow/<?= $GLOBALS["js"]["profile"]["nickname"] ?>');
    }
    else {
        this.textContent = 'Отписаться';
        await fetch('/api/follow/<?= $GLOBALS["js"]["profile"]["nickname"] ?>');
    }
    refreshStats(await getStats());
});

async function getStats() {
    const result = await fetch('/api/stats/<?= $GLOBALS["js"]["profile"]["nickname"] ?>');
    const data = await result.json();
    console.log(data);
    return data;
}

function refreshStats({ posts_number, followers_number, followed_number }) {
    document.querySelectorAll('#posts_number span').forEach(e => e.textContent = posts_number);
    document.querySelectorAll('#followers_number span').forEach(e => e.textContent = followers_number);
    document.querySelectorAll('#followed_number span').forEach(e => e.textContent = followed_number);
}

