function Input(id) {
    const InputMultiline = document.createElement('div'); InputMultiline.className = 'Input-multiline'; html = ` <div
    class="Input-multiline__textarea" contenteditable="true">
    </div>
    <button class="Input-multiline__send">
        <i class="Icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                <path d="M120 896V256l760 320-760 320Zm60-93 544-227-544-230v168l242 62-242 60v167Zm0 0V346v457Z" />
            </svg>
        </i>
    </button>
    `;
    InputMultiline.insertAdjacentHTML('beforeend', html);
    const area = InputMultiline.querySelector('.Input-multiline__textarea');
    area.onpaste = (e) => {
        e.preventDefault();
        area.textContent += e.clipboardData.getData('text/plain');
        var range = document.createRange()
        document.getSelection().removeAllRanges();
        document.getSelection().addRange(range);
        range.selectNodeContents(area);
        range.collapse();
    }
    const send = InputMultiline.querySelector('.Input-multiline__send');
    send.onclick = async (e) => {
        const body = { id: id, text: area.textContent };
        await fetch('/api/posts/comment', {
            method: 'POST',
            body: JSON.stringify(body)
        })
        area.textContent = '';
    }
    return InputMultiline;
}