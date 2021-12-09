const footer = document.querySelector(".block_for_footer"),
blockCart = document.querySelector(".block_cart"),
checkProductsCartAll = document.querySelector('#checkProductsCartAll'); 

function footerResize(){
    
    footerHeight = footer.offsetHeight + 30;
    blockCart.style.minHeight = "calc(100vh - 110px - 60px - " + footerHeight + "px)";

}

window.addEventListener('load', footerResize);
window.addEventListener('resize', footerResize);

checkProductsCartAll.onchange = () => {
    let everyProductCheck = document.querySelectorAll(".everyProductCheck");
    try{
        if(checkProductsCartAll.checked){
            for(let i = 0; i <= everyProductCheck.length; i++){
                document.getElementById(everyProductCheck[i].id).checked = true;
            }
        }else{
            for(let i = 0; i <= everyProductCheck.length; i++){
                document.getElementById(everyProductCheck[i].id).checked = false;
            }
        }
    }catch(err){}
    if(checkProductsCartAll.checked){
        inpChecking();
        document.getElementById("btn_buy_cart_id").disabled = false;
        document.getElementById("btn_clear_cart_id").disabled = false;
    }else{
        document.getElementById("btn_buy_cart_id").disabled = true;
        document.getElementById("btn_clear_cart_id").disabled = true;
    }
}