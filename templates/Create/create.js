const createInput = document.querySelector('.create .create__input');
createInput.onpaste = (e) => {
    e.preventDefault();
    createInput.textContent += e.clipboardData.getData('text/plain');
    const range = document.createRange()
    document.getSelection().removeAllRanges();
    document.getSelection().addRange(range);
    range.selectNodeContents(createInput);
    range.collapse();
}

const createSend = document.querySelector('.create .create__send');
const inputPhotos = document.querySelector('.create #photos');
createSend.onclick = (e) => {
    e.preventDefault();
    const form = new FormData();
    form.append('text', createInput.textContent ? createInput.textContent : '');
    for (let i = 0; i < inputPhotos.files.length; i++) {
        form.append('photos[]', inputPhotos.files[i]);
    }
    fetch('', {
        method: 'POST',
        body: form
    })
    inputPhotos.files = null;
    createInput.textContent = '';
    window.location.reload();
}
