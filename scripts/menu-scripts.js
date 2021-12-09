const menu = document.querySelector('.menu');

let stillScroll = false;

window.onscroll = () => stillScroll = true;

setInterval(() => {
    if ( stillScroll ) {
        stillScroll = false;
        menu.classList.remove("nonactive");
        menu.classList.add("active");
        document.querySelector('.block_person_bottom_menu').classList.remove("active");
    }else{
        menu.classList.remove("active");
        menu.classList.add("nonactive");
    }
}, 100);