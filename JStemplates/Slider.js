function Slider(images) {
    let current = 0, slides = [];
    const Slider = document.createElement('div');
    Slider.className = 'postSlider';
    let SliderInner = `
<div class="postSlider__current">
    ${images.length > 1 ? `<button class="postSlider__prev">
        <i class="Icon" style="transform: rotate(180deg)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                <path d="m480 896-42-43 247-247H160v-60h525L438 299l42-43 320 320-320 320Z" />
            </svg>
        </i>
    </button>` : ""}
    <button class="postSlider__middle">
        <i class="Icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                <path
                    d="M200 856V663h60v133h133v60H200Zm0-367V296h193v60H260v133h-60Zm367 367v-60h133V663h60v193H567Zm133-367V356H567v-60h193v193h-60Z" />
            </svg>
        </i>
    </button>
    ${images.length > 1 ?
            `<button class="postSlider__next">
        <i class="Icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960">
                <path d="m480 896-42-43 247-247H160v-60h525L438 299l42-43 320 320-320 320Z" />
            </svg>
        </i>
    </button>` : ""}

    <div class="postSlider__current-bg" style="background-image: url(/api/images/posts/${images[current]});">
    </div>
    <img src="/api/images/posts/${images[current]}" alt="post image" />
    <div class="postSlider__fullsreen postSlider__fullsreen-closed">
        <img src="/api/images/posts/${images[current]}" alt="post image" />
    </div>
</div>
<div class="postSlider__container">
</div>
`
    Slider.insertAdjacentHTML('beforeend', SliderInner);
    const fullscreenBtn = Slider.querySelector('.postSlider__middle');
    const fullscreen = Slider.querySelector('.postSlider__fullsreen');
    const fullscreenImg = fullscreen.querySelector('img');
    fullscreenBtn.onclick = function (e) {
        fullscreen.classList.remove('postSlider__fullsreen-closed');
    }
    fullscreen.onclick = function (e) {
        this.classList.add('postSlider__fullsreen-closed');
    }
    if (images.length > 1) {
        const bg = Slider.querySelector('.postSlider__current-bg');
        const container = Slider.querySelector('.postSlider__container');
        const currentImg = Slider.querySelector('.postSlider__current img');
        const leftBtn = Slider.querySelector('.postSlider__prev');
        const rightBtn = Slider.querySelector('.postSlider__next');
        images.forEach((img, index) => {
            const image = document.createElement('div');
            image.className = 'postSlider__image';
            let imgHtml = `
<img class="postSlider__slide" src="/api/images/posts/${img}" alt="post image" />
`
            image.insertAdjacentHTML('beforeend', imgHtml);
            if (index === current) {
                image.classList.add('postSlider__highlighter');
            }
            image.onclick = function () {
                slides[current].classList.remove('postSlider__highlighter');
                current = index;
                slides[current].classList.add('postSlider__highlighter');
                bg.style.backgroundImage = `url(/api/images/posts/${images[current]})`;
                currentImg.src = `/api/images/posts/${img}`;
                fullscreenImg.src = `/api/images/posts/${img}`;
            }
            container.append(image);
            slides.push(image);
        });
        leftBtn.onclick = function (e) {
            slides[current].classList.remove('postSlider__highlighter');
            current--;
            if (current < 0) current = images.length - 1; slides[current].classList.add('postSlider__highlighter');
            bg.style.backgroundImage = `url(/api/images/posts/${images[current]})`; currentImg.src = '/api/images/posts/' +
                images[current]; fullscreenImg.src = '/api/images/posts/' + images[current];
        }
        rightBtn.onclick = function (e) {
            slides[current].classList.remove('postSlider__highlighter'); current = (current + 1) % images.length;
            slides[current].classList.add('postSlider__highlighter');
            bg.style.backgroundImage = `url(/api/images/posts/${images[current]})`; currentImg.src = '/api/images/posts/' +
                images[current]; fullscreenImg.src = '/api/images/posts/' + images[current];
        }
    } return Slider;
} 