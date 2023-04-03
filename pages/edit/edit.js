document.querySelector('#edit__menu-close-btn').onclick = () => {
    document.querySelector('.edit__menu').classList.add('edit__menu-closed');
};

document.querySelector('#settings-open-btn').onclick = () => {
    document.querySelector('.edit__menu').classList.remove('edit__menu-closed');
};