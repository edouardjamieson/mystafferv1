function main(){
	$(".homepage").fadeIn(1);
	$(".home-icon").attr("src","content/img/home-icon-active.png");
}

function openPost(){$(".newpost-overlay").fadeIn(1);}
function closePost(){$(".newpost-overlay").fadeOut(1);}

function openPage(x) {

	var v = document.getElementById('pageholder');
	var y = document.getElementById('pageholder').innerHTML;
	var z = parseInt(y, 10);

	if(x == 1){openHome();}
	if(x == 2){openSchedule();}
	if(x == 3){openEmployees();}
	if(x == 4){openProfile();}

	function openHome(){
		$(".page").each(function(){
			$(this).fadeOut(1);
			$(this).removeClass("animate-right");
			$(this).removeClass("animate-left");
		});

		if(z < x){
			$(".homepage").addClass("animate-right");
		}else
		if(z > x){
			$(".homepage").addClass("animate-left");
		}
		$(".homepage").fadeIn(1);
		$(".home-icon").attr("src","content/img/home-icon-active.png");
		$(".schedule-icon").attr("src","content/img/schedule-icon.png");
		$(".notif-icon").attr("src","content/img/notif-icon.png");
		$(".profile-icon").attr("src","content/img/name-icon.png");
		v.innerHTML = x;
	}
	function openSchedule(){
		$(".page").each(function(){
			$(this).fadeOut(1);
			$(this).removeClass("animate-right");
			$(this).removeClass("animate-left");
		});
		if(z < x){
			$(".schedulepage").addClass("animate-right");
		}else
		if(z > x){
			$(".schedulepage").addClass("animate-left");
		}
		$(".schedulepage").fadeIn(1);
		$(".home-icon").attr("src","content/img/home-icon.png");
		$(".schedule-icon").attr("src","content/img/schedule-icon-active.png");
		$(".notif-icon").attr("src","content/img/notif-icon.png");
		$(".profile-icon").attr("src","content/img/name-icon.png");
		v.innerHTML = x;

	}
	function openEmployees(){
		$(".page").each(function(){
			$(this).fadeOut(1);
			$(this).removeClass("animate-right");
			$(this).removeClass("animate-left");
		});
		if(z < x){
			$(".employeespage").addClass("animate-right");
		}else
		if(z > x){
			$(".employeespage").addClass("animate-left");
		}
		$(".employeespage").fadeIn(1);
		$(".home-icon").attr("src","content/img/home-icon.png");
		$(".schedule-icon").attr("src","content/img/schedule-icon.png");
		$(".notif-icon").attr("src","content/img/notif-icon-active.png");
		$(".profile-icon").attr("src","content/img/name-icon.png");
		v.innerHTML = x;
	}
	function openProfile(){
		$(".page").each(function(){
			$(this).fadeOut(1);
			$(this).removeClass("animate-right");
			$(this).removeClass("animate-left");
		});

		if(z < x){
			$(".profilepage").addClass("animate-right");
		}else
		if(z > x){
			$(".profilepage").addClass("animate-left");
		}
		$(".profilepage").fadeIn(1);
		$(".home-icon").attr("src","content/img/home-icon.png");
		$(".schedule-icon").attr("src","content/img/schedule-icon.png");
		$(".notif-icon").attr("src","content/img/notif-icon.png");
		$(".profile-icon").attr("src","content/img/name-icon-active.png");
		v.innerHTML = x;
	}

}
