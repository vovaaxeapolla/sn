document.querySelector('#change_theme').onclick = async () => {
    const html = document.querySelector('html');
    if (html.getAttribute('theme') === 'light') {
        html.setAttribute('theme', 'dark');
        fetch('/api/theme?theme=dark');
    } else {
        html.setAttribute('theme', 'light');
        await fetch('/api/theme?theme=light');
    }
};

document.querySelector('#navbar-close-btn').onclick = () => {
    document.querySelector('.navbar').classList.add('navbar-closed');
};

document.querySelector('#navbar-open-btn').onclick = () => {
    document.querySelector('.navbar').classList.remove('navbar-closed');
};

document.querySelector('#avatar-change').onchange = async () => {
    const input = document.querySelector('#avatar-file')
    const data = new FormData()
    data.append('avatar', input.files[0])
    const result = await fetch('/api/avatar', {
        method: 'POST',
        body: data
    })
    const newSrc = await result.json();
    document.querySelectorAll('[data-avatar]').forEach(a => {
        a.src = "/api/images/avatars/" + newSrc;
    })
}

document.querySelector('#delete-avatar').onclick = async () => {
    await fetch('/api/avatar', { method: 'delete' });
    document.querySelectorAll('[data-avatar]').forEach(a => {
        a.src = '/api/images/avatars/noavatar.png';
    })
}