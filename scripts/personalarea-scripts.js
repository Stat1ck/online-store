const userMes = document.querySelector(".message_for_user");

function showSelectImg(){
    document.querySelector(".personalarea_select_avatar").click(); 
}

window.addEventListener("click", function(e){
        if(e.target.className == "personalarea_main_data_inputs readonly_input"){
            resetReadOnly();
            document.getElementById(e.target.id).readOnly = false;
            document.getElementById(e.target.id).classList.remove("readonly_input");
        }else if((e.target.className != "personalarea_main_data_inputs readonly_input") || (e.target.className != "personalarea_main_data_inputs")){
            if(e.target.className == "personalarea_main_data_inputs"){
                resetReadOnly();
                document.getElementById(e.target.id).readOnly = false;
                document.getElementById(e.target.id).classList.remove("readonly_input");
            }else if((e.target.className != "personalarea_main_data_inputs readonly_input") && (e.target.className != "personalarea_main_data_inputs")){
                resetReadOnly();
            }
        }
})

document.querySelector('.block_wrapper_avatar').onmousemove = () => {
    document.querySelector('.block_personalarea_btn_select_avatar').classList.add('showBtn');
}

document.querySelector('.block_wrapper_avatar').onmouseleave = () => {
    document.querySelector('.block_personalarea_btn_select_avatar').classList.remove('showBtn');
}

window.addEventListener('resize', function(){
    userMes.style.left = (innerWidth - userMes.offsetWidth) / 2  + 'px';
})

function hideMessage(){
    var hideMessageTime = setTimeout(function(){
        userMes.classList.remove("active_message");    
    }, 7000);
}

document.body.onclick = () => {
    userMes.classList.remove("active_message");
    try{
        clearTimeout(hideMessageTime);
    }catch{}
}

function resetReadOnly(){
    let inputs_readonly = document.querySelectorAll(".personalarea_main_data_inputs");
    for(let i = 0; i<inputs_readonly.length; i++){
        inputs_readonly[i].readOnly = true;
        inputs_readonly[i].classList.add("readonly_input");
    }
}

function showUserMes(data){
    userMes.classList.remove("active_message");
    userMes.classList.add("active_message");
    userMes.style.color = "green";
    userMes.innerHTML = "<h2>" + data + "</h2>";
    userMes.style.left = (innerWidth - userMes.offsetWidth) / 2  + 'px';
    hideMessage();
}

function showUserErr(data){
    userMes.classList.remove("active_message");
    userMes.classList.add("active_message");
    userMes.style.color = "red";
    userMes.innerHTML = "<h2>" + data + "</h2>";
    userMes.style.left = (innerWidth - userMes.offsetWidth) / 2  + 'px';
    hideMessage();
}

function changeMainData(){
    
    let p_fname = document.getElementById('p_fname').value,
    p_lname = document.getElementById('p_lname').value,
    p_email = document.getElementById('p_email').value,
    p_phone = document.getElementById('p_phone').value;
    
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/changepdata/changemaindata/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "Изменения сохранены!"){
                    showUserMes(data);
                }else{
                    showUserErr(data);
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("p_fname=" + p_fname + "&p_lname=" + p_lname + "&p_email=" + p_email + "&p_phone=" + p_phone);
    
}

function changePassword(){
    
    let old_password = document.getElementById('p_old_pass').value,
    new_password = document.getElementById('p_new_pass').value;
    
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/changepdata/changepassword/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Пароль успешно изменен!"){
                    document.getElementById('p_old_pass').value = "";
                    document.getElementById('p_new_pass').value = "";
                    showUserMes(data);
                }else{
                    showUserErr(data);
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("old_password=" + old_password + "&new_password=" + new_password);
    
}

document.querySelector('.personalarea_select_avatar').onchange = () => {

    let formData = new FormData(),
    avatarSelect = document.querySelector('.personalarea_select_avatar').files[0];

    if(avatarSelect.name.length !== 0){
        
        formData.append("avatar", avatarSelect);
        
        let xhr;
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhr.open("POST", "/changepdata/changeavatar/", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if((data !== "Формат файла должен быть: jpeg, png, jpg, gif!") || (data !== "Не удалось загрузить файл!")){
                        document.querySelector('.personalarea_avatar_img').src = "/img/avatars/" + data;
                        document.getElementById('menu_user_avatar').src = "/img/avatars/" + data;
                    }else{
                        showUserErr(data);
                    }
                }
            }
        }
        xhr.send(formData);
    }else{}
    
}

function addAddres(){
    
    let country = document.getElementById('p_country').value,
    area = document.getElementById('p_area').value,
    city = document.getElementById('p_city').value,
    index = document.getElementById('p_index').value,
    adres = document.getElementById('p_adres').value;
    
    if(((country.length != 0) || (area.length != 0) || (city.length != 0) || (index.length != 0) || (adres.length != 0)) && ((country.length != 0) && (area.length != 0) && (city.length != 0) && (index.length != 0) && (adres.length != 0))){
        country = country[0].toUpperCase() + country.substring(1);
        area = area[0].toUpperCase() + area.substring(1);
        city = city[0].toUpperCase() + city.substring(1);
        adres = adres[0].toUpperCase() + adres.substring(1);
        let resAdres = index + ', ' + country + ', ' + area + ', ' + city + ', ' + adres;
        let xhr;
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhr.open("POST", "/changepdata/addaddres/", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data != "Заполните все поля!"){
                        document.getElementById('inp_p_addres').value = "Редактировать";
                        document.getElementById('h3_p_addres').innerHTML = "Редактировать адрес";
                        document.getElementById('p_block_user_addres').innerHTML = "<p id='p_block_for_addres'>" + resAdres + "</p><input type='button' onclick='removeAddr()' class='link_user_orders' value='Удалить адрес'>";
                        showUserMes("Адрес добавлен!");
                        document.getElementById('p_country').value = "";
                        document.getElementById('p_area').value = "";
                        document.getElementById('p_city').value = "";
                        document.getElementById('p_index').value = "";
                        document.getElementById('p_adres').value = "";
                    }else{
                        showUserErr(data);
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("addres=" + resAdres);
    }else {
        let data = "Заполните все поля!";
        showUserErr(data);
    }
    
}

function removeAddr(){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/changepdata/removeaddres/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    document.getElementById('p_block_user_addres').innerHTML = "У вас пока нет адреса для доставки! Добавьте его в личном кабинете, чтобы не вводить каждый раз при заказе!";
                    document.getElementById('inp_p_addres').value = "Добавить";
                    document.getElementById('h3_p_addres').innerHTML = "Добавить адрес";
                }
            }
        }
    }
    xhr.send();
}