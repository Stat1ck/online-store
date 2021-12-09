const main_block_modals = document.querySelector('.block_modals'),
registration_modal = document.querySelector('.block_modals_registration'),
login_modal = document.querySelector('.block_modals_login'),
modals_closed = document.querySelector('.block_modals_btn_close'),
body = document.querySelector('body'),
search_modal = document.querySelector('.block_for_search'),
searchFieldRes = document.querySelector(".block_for_search .inp_for_search"),
personalArea = document.querySelector('.btn_toggle_personalarea'),
btns_menu = document.querySelector('.menu_blok_for_btns'),
bottom_menu = document.querySelector('.block_person_bottom_menu');
let modals_width, modals_height, screen_width, screen_height, flag = false;

function modals_show(){
    body.style.overflow = "hidden";
    main_block_modals.style.display = "flex";
    modals_reset();
}

this.onclick = (e) => {
    let target_class = String(e.target.className);
    if ((target_class == 'fas fa-eye') || (target_class == 'fas fa-eye active_pass')){
        let iden = e.target.previousElementSibling;
        if(iden.type === "password"){
            iden.type = "text";
            e.target.classList.add("active_pass");
        }else{
            turnOff(iden, e.target);
        }
    }else{
        let targets = ["goToReg", "goToLogin", "goToSearch", "logout"];
        if (targets.includes(target_class)){
            e.preventDefault();
            window[target_class]();
        }
    }
}

function turnOff(iden, targ){
    iden.type = "password";
    targ.classList.remove("active_pass");
}

personalArea.onmouseenter = () => {
    bottom_menu.classList.add("active");
}

btns_menu.onmouseleave = () => {
    bottom_menu.classList.remove("active");
}

function goToReg(){
    modals_show();
    registration_modal.style.display = "flex";
    registration_modal.classList.add('active_modal');
    resize_modals();
}

function goToLogin(){
    modals_show();
    login_modal.style.display = "flex";
    login_modal.classList.add('active_modal');
    resize_modals();
}

function goToSearch(){
    modals_show();
    search_modal.style.display = "flex";
    search_modal.classList.add('active_modal');
    searchFieldRes.focus();
    resize_modals();
}

modals_closed.onclick = () => {
    modals_close();
}

main_block_modals.onclick = () => {
    document.querySelector(".block_modals_error-text").classList.remove("active_error");
}

function modals_close(){
    body.style.overflow = "auto";
    main_block_modals.style.display = "none";
    modals_reset();
    flag = false;
}

function modals_reset(){
    registration_modal.style.display = "none";
    login_modal.style.display = "none";
    search_modal.style.display = "none";
    search_modal.classList.remove('active_modal');
    registration_modal.classList.remove('active_modal');
    login_modal.classList.remove('active_modal');
    document.form_regist.reset();
    document.form_login.reset();
    searchFieldRes.value = "";
    document.querySelector(".block_modals_error-text").classList.remove("active_error");
}

function resize_modals() {
    modals_width = document.querySelector('.active_modal').offsetWidth;
    modals_height = document.querySelector('.active_modal').offsetHeight;
    screen_width = innerWidth;
    screen_height = innerHeight;
    document.querySelector('.active_modal').style.left = (screen_width - modals_width) / 2  + 'px';
    document.querySelector('.block_modals_error-text').style.left = (screen_width - document.querySelector('.block_modals_error-text').offsetWidth) / 2  + 'px';
    document.querySelector('.active_modal').style.top = (screen_height - modals_height) / 2  + 'px';
    flag = true;
}

window.addEventListener('resize', function(){
    
    if(flag){
        resize_modals();
    }
    
});