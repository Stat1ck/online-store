const error_text = document.querySelector(".block_modals_error-text"),
selectAvatarL = document.querySelector(".block_modals_field_image label"),
selectAvatarI = document.querySelector(".block_modals_field_image input[type='file']"),
regForm = document.querySelector(".block_modals_form_reg"),
logForm = document.querySelector(".block_modals_form_log");

function logout(){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/logout/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success"){
                    location.reload();
                }
            }
        }
    }
    xhr.send();
}

selectAvatarL.onclick = () => {
    selectAvatarI.click();
}

regForm.onsubmit = (e) => {
    e.preventDefault();
    
    signup();
}

logForm.onsubmit = (e) => {
    e.preventDefault();
    
    login();
}

function login(){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/login/", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Вы вошли!"){
                    error_text.classList.remove("active_error");
                    error_text.classList.add("active_error");
                    error_text.style.color = "green";
                    error_text.innerHTML = "<h2>" + data + "</h2>";
                    regCon();
                }else{
                    error_text.classList.remove("active_error");
                    error_text.classList.add("active_error");
                    error_text.style.color = "red";
                    error_text.innerHTML = "<h2>" + data + "</h2>";
                }
                resize_modals();
            }
        }
    }
    let formData = new FormData(logForm);
    xhr.send(formData);
}

function signup(){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/signup/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "Вы зарегистрированы!"){
                    error_text.classList.remove("active_error");
                    error_text.classList.add("active_error");
                    error_text.style.color = "green";
                    error_text.innerHTML = "<h2>" + data + "</h2>";
                    regCon();
                }else{
                    error_text.classList.remove("active_error");
                    error_text.classList.add("active_error");
                    error_text.style.color = "red";
                    error_text.innerHTML = "<h2>" + data + "</h2>";
                }
                resize_modals();
            }
        }
    }
    let formData = new FormData(regForm);
    xhr.send(formData);
}

function regCon() {
    setTimeout(function(){
        error_text.classList.remove("active_error");
        modals_close();
        location.reload();
    }, 1000);
}