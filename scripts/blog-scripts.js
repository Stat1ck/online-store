const posts = document.querySelectorAll('.block_for_slider_post .block_slider_posts .instagram-media');
const sliderLine = document.querySelector('.block_for_slider_post .block_slider_posts');
let count = 0;
let width, height, interval;

function init() {
    width = document.querySelector('.block_for_slider_post').offsetWidth;
    height = document.querySelector('.block_for_slider_post').offsetHeight;
    sliderLine.style.width = width * posts.length + 'px';
    sliderLine.style.height = height + 'px';
    posts.forEach(item => {
        item.style.width = width + 'px';
        item.style.height = height + 'px';
    });
    rollSlider();
}

window.addEventListener('load', init);
window.addEventListener('load', interval);
window.addEventListener('resize', init);

function prev(){
    count--;
    if (count < 0) {
        count = posts.length - 1;
    }
    rollSlider();
}

function next(){
    count++;
    if (count >= posts.length) {
        count = 0;
    }
    rollSlider();
}

interval = setInterval(function(){
        next();
    }, 10000);

document.querySelector('.block_for_slider_post-next').onclick = () => {
    clearInterval(interval);
    next();
    resetInterval();
}

document.querySelector('.block_for_slider_post-prev').onclick = () => {
    clearInterval(interval);
    prev();
    resetInterval();
}

function resetInterval(){
    interval = setInterval(function(){
        next();
    }, 10000);
}

function rollSlider() {
    sliderLine.style.transform = 'translate(-' + count * width + 'px)';
}