const field_product_number = document.querySelector('.product_cart_number'),
blockUpdateCartInfo = document.querySelector('.blockUpdateCartInfo');
let checkProducts = new Array();

document.addEventListener("click", function(e){
    
    if(e.target.className == "everyProductCheck"){
        if(document.getElementById(e.target.id).checked === false){
            if(checkProductsCartAll.checked){
                checkProductsCartAll.checked = false;
            }
            inpChecking();
        }else{
            inpChecking();
        }
    }else if(e.target.className == "btn_del_order"){
        let orderID = e.target.id;
        deleteOrderFromOrders(orderID);
    }else if(e.target.className == "menu_bars"){
        document.querySelector('.block_person_bottom_menu').classList.toggle('actived');
        document.querySelector('.menu_blok_for_links').classList.toggle('active');
    }
    
})

function inpChecking(noneCart){
    if(!noneCart){
        let everyProductCheck = document.querySelectorAll(".everyProductCheck");
        checkProducts = [];
        try{
            for(let i = 0; i < everyProductCheck.length; i++){
                let id = document.getElementById(everyProductCheck[i].id);
                if(id.checked){
                    let res = everyProductCheck[i].id.replace("check", "");
                    checkProducts.push((+res));
                }
            }
        }catch(err){}
        if(checkProducts.length == 0){
            document.getElementById("btn_buy_cart_id").disabled = true;
            document.getElementById("btn_clear_cart_id").disabled = true;
            resultCartSumma(checkProducts);
        }else{
            document.getElementById("btn_buy_cart_id").disabled = false;
            document.getElementById("btn_clear_cart_id").disabled = false;
            resultCartSumma(checkProducts);
            
        }
    }
}

function resultCartSumma(checkProductsList){
    let everyProductCheck = document.querySelectorAll(".everyProductCheck"),
    nonCheckArr = new Array(),
    sum = 0;
    try{
        if(checkProductsList.length == 0){
            for(let i = 0; i < everyProductCheck.length; i++){
                let idItem = everyProductCheck[i].id.replace("check", "");
                nonCheckArr.push((+idItem));
            }
        }
    }catch(err){}
    if(nonCheckArr.length != 0){
        sum = 0;
        for(let i = 0; i < nonCheckArr.length; i++){
            let priceVal = document.getElementById(nonCheckArr[i] + "priceProductSum").value;
            sum += (+priceVal);
        }
    }else if(checkProducts.length != 0){
        sum = 0;
        for(let i = 0; i < checkProducts.length; i++){
            let priceVal = document.getElementById(checkProducts[i] + "priceProductSum").value;
            sum += (+priceVal);
        }
    }
    document.getElementById("resultCartSum").innerHTML = sum;
    document.getElementById("costCartSum").value = sum;

}

function removeOneProduct(product_id, noneCart, productStatus){
    
    let inpCount = document.getElementById(product_id);
    let inpVal = inpCount.value;
    
    inpCount.value = (+inpVal) - 1;
    inpCount.classList.remove("dis");
    
    if(inpCount.value <= 0){
        let newArrId = new Array();
        newArrId.push(product_id);
        deleteProductFromCart(newArrId, noneCart, productStatus);
        inpCount.value = 0;
    }else{
        changeProductCount(product_id, inpCount.value, noneCart);
    }

}

function addOneProduct(product_id, max, noneCart){

    let inpCount = document.getElementById(product_id);
    let inpVal = inpCount.value;
    
    inpCount.value = (+inpVal) + 1;
    max = (+max);
    
    if(inpCount.value >= max){
        inpCount.value = max;
        inpCount.classList.add("dis");
    }
    
    changeProductCount(product_id, inpCount.value, noneCart);
    
}

function clearCart(){

    deleteProductFromCart(checkProducts);
    document.getElementById("btn_buy_cart_id").disabled = true;
    document.getElementById("btn_clear_cart_id").disabled = true;
    
}

function buyCart(){
    
    buyProductFromCart(checkProducts);
    
}

function buyProductFromCart(product_id){
    let CartSumma = document.getElementById("costCartSum").value,
    everyProductCheck = document.querySelectorAll(".everyProductCheck"),
    xhr;
    
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/cartfunctions/buyproductfromcart/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data !== "Error"){
                    window.location.assign("/checkout/");
                    checkProductsCartAll.checked = false;
                    for(let i = 0; i < everyProductCheck.length; i++){
                        document.getElementById(everyProductCheck[i].id).checked = false;
                    }
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("product_id=" + product_id + "&CartSumma=" + CartSumma);
}

function changeProductCount(product_id, product_count, noneCart){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/cartfunctions/changeproductcount/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data !== "Error"){
                    data = JSON.parse(data);
                    updateCartInfo(data, noneCart);
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("product_id=" + product_id + "&product_count=" + product_count);
}

function addToCart(productId, productStatus){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/cartfunctions/addtocart/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data !== "Error"){
                    field_product_number.style.display = "flex";
                    field_product_number.innerHTML = data;
                    if(productStatus){
                        let allProducts = document.querySelectorAll(".btns_change_count_product");
                        if(allProducts.length == 1){
                            document.querySelector(".btns_change_count_product").innerHTML = "<input type='button' onclick='removeOneProduct(" + productId + ", true, " + productStatus + ")' value='-' class='btns_cart'><input type='number' id='" + productId + "' min='0' max='" + productStatus + "' value='1' class='btns_cart product_count' readonly><input type='button' onclick='addOneProduct(" + productId + ", " + productStatus + ", true)' value='+' class='btns_cart'>";
                        }else{
                            document.getElementById(productId + 'CatalogDeleteAddProduct').innerHTML = "<input type='button' onclick='removeOneProduct(" + productId + ", true, " + productStatus + ")' value='-' class='btns_cart'><input type='number' id='" + productId + "' min='0' max='" + productStatus + "' value='1' class='btns_cart product_count' readonly><input type='button' onclick='addOneProduct(" + productId + ", " + productStatus + ", true)' value='+' class='btns_cart'>";
                        }
                    }
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("product_id=" + productId);
}

function deleteProductFromCart(product_id, noneCart, productStatus){
    inpChecking(noneCart);
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/cartfunctions/deleteproductfromcart/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data !== "Error"){
                    field_product_number.style.display = "flex";
                    field_product_number.innerHTML = data;
                    if(!noneCart){
                        if(product_id.length > 1){
                            for(let i = 0; i < product_id.length; i++){
                                document.getElementById(product_id[i] + "cart").innerHTML = "";
                            }
                        }else{
                            document.getElementById(product_id + "cart").innerHTML = "";
                        }
                        cartClear(data);
                    }
                    if(noneCart){
                        let allProducts = document.querySelectorAll(".btns_change_count_product");
                        if(allProducts.length == 1){
                            document.querySelector(".btns_change_count_product").innerHTML = "<a href='#' onclick='addToCart(" + product_id + ", " + productStatus + "); return false;' class='catalog_dobavkorzina'>Добавить в корзину</a>";
                        }else{
                            document.getElementById(product_id + 'CatalogDeleteAddProduct').innerHTML = "<a href='#' onclick='addToCart(" + product_id + ", " + productStatus + "); return false;' class='catalog_dobavkorzina'>Добавить в корзину</a>";
                        }
                    }
                    inpChecking(noneCart);
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("product_id=" + product_id);
}

function updateCartInfo(data, noneCart){
    
    if(!noneCart){
        document.getElementById(data[0]['product_id'] + "price").innerHTML = data[0]['product_price'] * data[0]['product_amount'] + " руб.";
        document.getElementById(data[0]['product_id'] + "priceProductSum").value = data[0]['product_price'] * data[0]['product_amount'];
        
        let productCount = document.getElementById(data[0]['product_id']).value;
        let resCount = data[0]['product_status'] - (+productCount);
        
        if(resCount !== 0){
            document.getElementById(data[0]['product_id'] + "status").innerHTML = "<font style='color:green'>Есть в наличии еще " + resCount  + " " + data[0]['product_mweight'] + "</font>";
        }else{
            document.getElementById(data[0]['product_id'] + "status").innerHTML = "<font style='color:red'>Больше " + productCount  + " " + data[0]['product_mweight'] + " нет в наличии!</font>";
        }
    }
    inpChecking(noneCart);
    
}

function cartClear(data){
    
    if(data == 0){
        
        document.querySelector(".block_inside_cart").innerHTML = "<div class='block_cart_empty'><div><h2>Ваша корзина пока что пуста!</h2></div><div><a href='/catalog/' class='cart_empty_links'>Перейти к покупкам</a><a href='/' class='cart_empty_links'>На главную</a></div></div>";
        
    }
    
}

//checkout functions

function toBackCheckout(){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/checkout/backtocart/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    window.location.assign("/cart/");
                }
            }
        }
    }
    xhr.send();
}

function toCheckout(addres, tel){
    
    let arrElem = new Array('c_country', 'c_area', 'c_city', 'c_index', 'c_adres'),
    arrPer = new Array('country', 'area', 'city', 'index', 'adres'),
    country, area, city, adres, index, phone, addrInfo, pay, addr = "";
    
    if(addres === true){
        addr = document.getElementById('checkout_addres').innerHTML;
    }else if(addres === false){
        country = document.getElementById('c_country').value;
        area = document.getElementById('c_area').value;
        city = document.getElementById('c_city').value;
        adres = document.getElementById('c_index').value;
        index = document.getElementById('c_adres').value;
    
        if(((country.length != 0) || (area.length != 0) || (city.length != 0) || (index.length != 0) || (adres.length != 0)) && ((country.length != 0) && (area.length != 0) && (city.length != 0) && (index.length != 0) && (adres.length != 0))){
            country = country[0].toUpperCase() + country.substring(1);
            area = area[0].toUpperCase() + area.substring(1);
            city = city[0].toUpperCase() + city.substring(1);
            adres = adres[0].toUpperCase() + adres.substring(1);
            addr = index + ', ' + country + ', ' + area + ', ' + city + ', ' + adres;
        }else{
            for(let i = 0; i < arrElem.length; i++){
                document.getElementById(arrElem[i]).placeholder = "Заполните поле!";
            }
            return false;
        }
    }
    
    if(tel === true){
        phone = document.getElementById('c_phone').value;
    }else if(tel === false){
        phone = document.getElementById('c_phone').value;
    }
    
    addrInfo = document.getElementById('c_addInfo').value;
    
    if(document.getElementById('p_check_money').checked){
        pay = "Деньги курьеру";
    }else if(document.getElementById('p_check_online').checked){
        pay = "Онлайн";
    }
    
        let xhr;
        if(window.XMLHttpRequest){
            xhr = new XMLHttpRequest();
        }else{
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhr.open("POST", "/checkout/tocheckout/", true);
        xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                    let data = xhr.response;
                    if(data != "Error"){
                        document.querySelector('.block_checkout_inside').innerHTML = "<div style='min-height: 40vh; width: 100%; display: flex; align-items: center; justify-content: center'><h3>Ваш заказ принят! Номер заказа №" + data + "!</h3></div>";
                    }else{
                        window.location.assign("/cart/");
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("phone=" + phone + "&addres=" + addr + "&addrInfo=" + addrInfo + "&pay=" + pay);
}

// order functions

function deleteOrderFromOrders(orderId){
    let xhr;
    if(window.XMLHttpRequest){
        xhr = new XMLHttpRequest();
    }else{
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST", "/orders/deleteorder/", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    document.getElementById(orderId).innerHTML = "Заказ отменен!";
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("orderId=" + orderId);
}