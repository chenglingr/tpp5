//var pathname = window.location.pathname + window.location.search;


var pathname = window.location.pathname;

$(".mynav li a").each(function() {
　　var href = $(this).attr("href");
　　if(pathname ==  href){
　　　//　$(this).parents("ul").parent("li").addClass("active open");
　　　　$(this).parent("li").addClass("active");
　　}
});