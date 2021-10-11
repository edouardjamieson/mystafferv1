function side() {

	var logoplacementh = $(".reg-logoplacement").height();
	$(".reg-logoplacement").css("line-height",logoplacementh + "px");

	var hheight = $(".app-header").height();
	$(".app-header").css("line-height",hheight+"px");

	var nheight = $(".navigator").height();
	$(".navigator").css("line-height",nheight+"px");


	checkIfStandalone();
}

function checkIfStandalone() {
	if (
    ("standalone" in window.navigator) &&
    !window.navigator.standalone
    ){

    $(".noapp-view").fadeIn(1);
}
}
