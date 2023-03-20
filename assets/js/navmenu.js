document.querySelector('#navbar__menu-btn').onclick = () => {
    document.querySelector('#navbar__menu').classList.toggle('navbar__menu-open');
}

document.querySelector('#change_theme').onclick = async () => {
    const html = document.querySelector('html');
    if (html.getAttribute('theme') === 'light') {
        html.setAttribute('theme', 'dark');
        fetch('/sn/api/theme?theme=dark');
    } else {
        html.setAttribute('theme', 'light');
        await fetch('/sn/api/theme?theme=light');
    }
}

document.querySelector('#navbar-close-btn').onclick = () => {
    document.querySelector('.navbar').classList.add('navbar-closed');
}

document.querySelector('#navbar-open-btn').onclick = () => {
    document.querySelector('.navbar').classList.remove('navbar-closed');
}

document.querySelector('#report-open').onclick = () => {
    document.querySelector('#report').style.display = 'flex';
}

document.querySelector('#report').onclick = function (e) {
    if (e.target.classList.contains('popup__btn-close')) {
        this.style.display = 'none';
    }
}