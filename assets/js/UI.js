function dropdown() {
    document.querySelectorAll(`.dropdown-menu`).forEach(e => {
        if (e.dataset.dropdown === this.dataset.dropdown)
            e.classList.toggle('dropdown-menu-open');
    })
}
document.querySelectorAll('.dropdown-btn').forEach(e => e.addEventListener('click', dropdown));
window.addEventListener('click', (event) => {
    if (!event.target.matches('.dropdown-btn')) {
        document.querySelectorAll('.dropdown-menu').forEach(e => e.classList.remove('dropdown-menu-open'));
    } else {
        document.querySelectorAll('.dropdown-menu').forEach(e => {
            if (e.dataset.dropdown !== event.target.dataset.dropdown)
                e.classList.remove('dropdown-menu-open');
        });
    }
});

document.querySelectorAll('.popup-btn').forEach(e => e.onclick = function () {
    document.querySelectorAll(`.popup`).forEach(e => {
        if (e.dataset.popup === this.dataset.popup)
            e.classList.add('popup-open');
    })
});

document.querySelectorAll('.popup-close').forEach(e => e.onclick = function () {
    document.querySelectorAll(`.popup`).forEach(e => {
        if (e.dataset.popup === this.dataset.popup)
            e.classList.remove('popup-open')
    })
});

document.querySelectorAll('.Img').forEach(i => {
    const fs = i.querySelector('.Img__fullscreen');
    i.querySelector('img').onclick = () => {
        fs.classList.add('Img__fullscreen-opened');
    }
    fs.onclick = () => {
        fs.classList.remove('Img__fullscreen-opened');
    }
});

document.querySelector('.main__content').addEventListener('scroll', function (e) {
    if (this.scrollTop > 200) {
        document.querySelector('.main__totop').classList.remove('main__totop-hidden');
    } else {
        document.querySelector('.main__totop').classList.add('main__totop-hidden');
    }
})

document.querySelector('.main__totop').onclick = () => {
    document.querySelector('.main__content').scrollTo({ top: 0, behavior: 'smooth' });
}