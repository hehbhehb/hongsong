<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<script src="http://api.map.baidu.com/components?ak=qW23l8uZjYxkTLUa0pBYxD7Y&v=1.0"></script>
	<title>定位事件</title>
	<style type="text/css">
		body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;}
		#golist {display: none;}
		@media (max-device-width: 800px){#golist{display: block!important;}}
	</style>
</head>
<body>

    <lbs-map center="114.311831,30.598428" style="height:91%" id="lbsmap"></lbs-map>
</body>
</html>
<script type="text/javascript">
	var lbsGeo = document.createElement('lbs-geo');
	lbsGeo.addEventListener("geofail",function(evt){ //注册事件
		alert("fail");
	});
	lbsGeo.addEventListener("geosuccess",function(evt){ //注册
		var addr = evt.detail.coords;
		var x = addr.lng;
		var y = addr.lat;
		alert(x+','+y);
	});
	lbsGeo.setAttribute("enable-modified","true");
	lbsGeo.setAttribute("id","geo");
	document.body.appendChild(lbsGeo);
</script>