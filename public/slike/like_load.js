function SmartLike(item_id,style) {
	var res = "statusLike_" + item_id;
	var ress = "#statusLike_" + item_id;
	var span_rld = "<span id='" + res + "'></span>";
	var load_url = "./slike/like_load.php?item_id=" + item_id + "&style=" + style;
	$(ress).load(load_url);
}