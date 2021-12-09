$(document).ready(function(){
	$('.header_type_text').typeIt({
		strings: ["Насладитесь многообразием фруктов и овощей!", "Фрукты и овощи из разных уголков мира!", "В нашем магазине только свежайшая продукция!"],
		speed: 110,
		breakLines: false,
		autoStart: true,
		loop: 1
	});
})
function scrollToCategory(top){
    const category = document.querySelector(".block_categories")
    category.scrollIntoView({
        block: "start",
        inline: "nearest",
        behavior: "smooth"
    })
}