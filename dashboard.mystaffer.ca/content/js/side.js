function side(){


	var dnlheight = $(".dn-link").height();
	$(".dn-link").css("line-height",dnlheight+"px");

	var dlabh = $(".dn-label").height();
	$(".dn-label").css("line-height",dlabh+"px");

	var lheight = $(".loading").height();
	$(".loading").css("line-height",lheight+"px");

	var ibch = $(".ib-commerce").height();
	$(".ib-user").css("height",ibch+"px");

	var nbh = $(".ne-box").height();
	$(".nes-box").css("height",nbh+"px");

	var ebh = $(".emp-box").height();
	$(".emp-infos").css("height",ebh+"px");
	$(".emp-infos").css("line-height",ebh+"px");

	var scwh = $(".sc-week").height();
	$(".scw-infos").css("height",scwh+"px");
	$(".scw-infos").css("line-height",scwh+"px");
}

function openMenu(){
	var dncw = $(".dnc-icons").width();
	var dnlh = $(".dn-link").height();
	$(".dash-navigation").css("width","15%");
	$(".dash-navigation").removeClass("close-menu-anim");
	$(".dash-navigation").addClass("open-menu-anim");
	$(".dash-wrapper").css("width","85%");
	$(".dash-wrapper").removeClass("big-wrapper");
	$(".dash-wrapper").addClass("small-wrapper");
	$(".x-icon").attr("src","content/img/x-icon.png");
	$(".menu-icon").attr("onclick","closeMenu()");
	$(".dnc-icons").css("width",dncw+"px");
	$(".dn-label").fadeIn(1);
}

function closeMenu(){
	$(".dash-navigation").css("width","4%");
	$(".dash-navigation").removeClass("open-menu-anim");
	$(".dash-navigation").addClass("close-menu-anim");
	$(".x-icon").attr("src","content/img/menu-icon.png");
	$(".menu-icon").attr("onclick","openMenu()");
	$(".dash-wrapper").css("width","96%");
	$(".dash-wrapper").removeClass("small-wrapper");
	$(".dash-wrapper").addClass("big-wrapper");
}
