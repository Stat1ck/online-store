const footer = document.querySelector(".block_for_footer"),
blockSearch = document.querySelector(".block_search_notfound"); 

function searchResize(){
    
    try{
        footerHeight = footer.offsetHeight;
        blockSearch.style.minHeight = "calc(100vh - 100px - 30px - " + footerHeight + "px)";
    }catch{}

}

window.addEventListener('load', searchResize);
window.addEventListener('resize', searchResize);