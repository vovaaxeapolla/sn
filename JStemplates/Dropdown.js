function Dropdown(id, menu) {
    const Dropdown = document.createDocumentFragment();
    const button = document.createElement('button');
    button.className = "Dropdown dropdown-btn";
    button.setAttribute('data-dropdown', id);
    const html = `
        <i class="Icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                <path d="M479.858 896Q460 896 446 881.858q-14-14.141-14-34Q432 828 446.142 814q14.141-14 34-14Q500 800 514 814.142q14 14.141 14 34Q528 868 513.858 882q-14.141 14-34 14Zm0-272Q460 624 446 609.858q-14-14.141-14-34Q432 556 446.142 542q14.141-14 34-14Q500 528 514 542.142q14 14.141 14 34Q528 596 513.858 610q-14.141 14-34 14Zm0-272Q460 352 446 337.858q-14-14.141-14-34Q432 284 446.142 270q14.141-14 34-14Q500 256 514 270.142q14 14.141 14 34Q528 324 513.858 338q-14.141 14-34 14Z"/>
            </svg>
        </i>
        <div class="dropdown-menu" data-dropdown="${id}"></div>
    `
    button.insertAdjacentHTML('beforeend', html);
    Dropdown.append(button);
    button.querySelector('.dropdown-menu').append(menu);
    Dropdown.querySelector('button').addEventListener('click', dropdown);
    return Dropdown;
}