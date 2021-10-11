function main(){
	$(".post-page").fadeIn(1);

	var lheight = $(".loading").height();
	$(".loading").css("line-height",lheight+"px");
}

function openLogin(){
	$(".select-login").fadeOut(1);
	$(".login-form").fadeIn(1);
	$(".back-to-reg").fadeIn(1);
}

function openRegister(){
	$(".select-login").fadeOut(1);
	$(".register-form").fadeIn(1);
	$(".back-to-reg").fadeIn(1);
}

function backtoSelect(){
	$(".login-form").fadeOut(1);
	$(".register-form").fadeOut(1);
	$(".back-to-reg").fadeOut(1);
	$(".select-login").fadeIn(1);
}

function openSettings(){
	$(".settings-overlay").fadeIn(1);
	$(".settings-icon").attr("src","content/img/x-icon.png");
	$(".settings-icon").attr("onclick","closeSettings()");
}

function closeSettings(){
	$(".settings-overlay").fadeOut(1);
	$(".settings-icon").attr("src","content/img/settings-icon.png");
	$(".settings-icon").attr("onclick","openSettings()");
}

function openPost(){
	$(".newpost-overlay").fadeIn(1);
	$(".settings-icon").attr("src","content/img/x-icon.png");
	$(".settings-icon").attr("onclick","closePost()");
}

function closePost(){
	$(".newpost-overlay").fadeOut(1);
	$(".settings-icon").attr("src","content/img/settings-icon.png");
	$(".settings-icon").attr("onclick","openSettings()");
}


function openPage(x) {
	$(".page").each(function(){
		$(".page").fadeOut(1);
	});

	if(x === 1){
		$(".post-page").fadeIn(1);
	}
	if(x === 2){
		$(".schedule-page").fadeIn(1);
	}
	if(x === 3){
		$(".event-page").fadeIn(1);
	}
	if(x === 4){
		$(".profile-page").fadeIn(1);
	}
}
