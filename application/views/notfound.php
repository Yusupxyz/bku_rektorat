<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	body{
		margin:0;
		padding:0;
		width:100%;
    	height:100%;
    	overflow: hidden;
	}
	#background {
    width: 100%; 
    height: 100%; 
    position: absolute; 
    left: 0px; 
    top: 0px; 
    z-index: 0;
}

.stretch {
    width:100%;
    height:100%;
}
</style>
<body>
<div id="background">
	<img class="stretch" src="<?= base_url();?>assets/dist/img/404.jpg">
</div>
</body>
</html>