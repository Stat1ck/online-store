let countProducts = document.getElementById("countProducts");

countProducts.onchange = () => {
    
    let resBtn,
    optionId = countProducts.options.selectedIndex,
    optionVal = countProducts.options[optionId].value,
    allProductsCountLength = document.querySelectorAll('.block_for_catalog').length,
    minId = 1,
    maxId = optionVal;

    showProducts(allProductsCountLength, maxId, minId);
    
    resBtn = Math.ceil(allProductsCountLength / optionVal);
    document.querySelector('.catalog_block_for_btns_bottom').innerHTML = "";
    
    for(let i = 1; i <= resBtn; i++){
        if(i == 1){
            document.querySelector('.catalog_block_for_btns_bottom').innerHTML += "<input type='button' disabled class='page_active' value='" + i + "' onclick='togglePage(" + i + ", " + optionVal + ", " + allProductsCountLength + ", " + resBtn + ")' id='" + i + "BtnToggle'>";
        }else{
            document.querySelector('.catalog_block_for_btns_bottom').innerHTML += "<input type='button' class='' value='" + i + "' onclick='togglePage(" + i + ", " + optionVal + ", " + allProductsCountLength + ", " + resBtn + ")' id='" + i + "BtnToggle'>";
        }
    }

}

function togglePage(btnId, showGoods, countGoods, resBtns){
    
    $("html, body").animate({ scrollTop: 0 }, "slow");
    
    let startId, endId;
    
    startId = (btnId - 1) * showGoods + 1;
    
    if(btnId == resBtns){
        endId = countGoods;
    }else{
        endId = btnId * showGoods;
    }
    
    showProducts(countGoods, endId, startId);
    
    for(let i = 1; i <= resBtns; i++){
        document.getElementById(i + "BtnToggle").classList.remove("page_active");
        document.getElementById(i + "BtnToggle").disabled = false;
    }
    
    document.getElementById(btnId + "BtnToggle").classList.add("page_active");
    document.getElementById(btnId + "BtnToggle").disabled = true;
    
}

function showProducts(allProductsCountLength, maxId, minId){
    
    for(let i = 1; i <= allProductsCountLength; i++){
        document.getElementById(i + "ProductItem").classList.remove("catalog_product_show");
        document.getElementById(i + "ProductItem").classList.add("catalog_product_hide");
    }
    
    for(let i = minId; i <= maxId; i++){
        document.getElementById(i + "ProductItem").classList.remove("catalog_product_hide");
        document.getElementById(i + "ProductItem").classList.add("catalog_product_show");
    }
    
}