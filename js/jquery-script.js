$(function(){
	$(".menu > ul > li").hover(function(){$(this).find("ul").show();},function(){$(this).find("ul").hide();});
	
	$(".tblist tr").hover(function(){$(this).addClass("active");},function(){$(this).removeClass("active");});
});
