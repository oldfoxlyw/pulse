function center(obj)
{
	var windowWidth = document.documentElement.clientWidth;   
	var windowHeight = document.documentElement.clientHeight;   
	var popupHeight = $("#" + obj).height();   
	var popupWidth = $("#" + obj).width();    
	$("#" + obj).css({     
		"top": (windowHeight-popupHeight)/2+$(document).scrollTop(),   
		"left": (windowWidth-popupWidth)/2   
	});  
}	

function popmask()
{
	$("body").before('<div id="popupmask"></div>');
	$("#popupmask").css({
		"width":			$(document).width(),
		"height":			$(document).height(),
		"position":   "absolute",
		"top":				"0px",
		"left":				"0px",
		"background-color":	"#000",
		"filter":			"Alpha(opacity=50)",  
		"-moz-opacity":		0.5,
		"opacity":			0.5,
		"z-index":			9999
	});		
}