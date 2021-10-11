function side() {
	var logoplacementh = $(".reg-logoplacement").height();
	$(".reg-logoplacement").css("line-height",logoplacementh + "px");
	var logoplacementhdrh = $(".hdr-logo-box").height();
	$(".hdr-logo-box").css("line-height",logoplacementhdrh + "px");
	checkIfStandalone();
}

function editProfileO() {$(".edit-profile-overlay").slideDown();}
function editProfileC() {$(".edit-profile-overlay").slideUp();}

function checkIfStandalone() {
	if (
    ("standalone" in window.navigator) &&
    !window.navigator.standalone
    ){

    $(".noapp-view").fadeIn(1);
}
}
