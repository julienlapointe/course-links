var http = false;

if(navigator.appName == "Microsoft Internet Explorer") {
  http = new ActiveXObject("Microsoft.XMLHTTP");
} else {
  http = new XMLHttpRequest();
}

function like(item_id,user_ip,style) {
	var respone = "statusLike_" + item_id;
	http.abort();
	http.open("GET", "./slike/like_widgate.php?action=like&item_id=" + item_id + "&user_ip=" + user_ip + "&style=" + style, true);
	http.onreadystatechange=function() {
		if(http.readyState == 4) {
		document.getElementById(respone).innerHTML = http.responseText;
		}
	}
	http.send(null);
}

function unlike(item_id,user_ip,style) {
	var respone = "statusLike_" + item_id;
	http.abort();
	http.open("GET", "./slike/like_widgate.php?action=unlike&item_id=" + item_id + "&user_ip=" + user_ip + "&style=" + style, true);
	http.onreadystatechange=function() {
		if(http.readyState == 4) {
		document.getElementById(respone).innerHTML = http.responseText;
		}
	}
	http.send(null);
}