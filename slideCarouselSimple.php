<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Totally Totally Amazing Slide Carousel</title>
	<style>
	body {
		font-family:Arial, Helvetica, sans-serif;
		color:#FFFF66;
		background-image:url(carpetBkgd.jpg);
		background-repeat:repeat;
		z-index:0;
	}
	#container {
		width: 760px;
    	margin: 0 auto;
		text-align:center;
	}
	h3 {
		color:#FFF;
	}
	#thumbDiv {
		display:block;
		margin: 2px auto;
		max-width:760px;
		z-index:10;
		position:relative;
	}
	#Thumbs img { 
		max-width: 80px;
	}
	#left {
		width:380px;
		float:left;
		margin-top:14%;
	}
	#right {
		width:380px;
		float:right;
		margin-top:14%;
	}
	#arrowLeft {
		margin-right:180px;
	}
	#arrowRight {
		margin-left:180px;
	}
	.fade {
		position:absolute;
		top:190px;
		width:760px;
		height:330px;
		float:inherit;
		opacity: 0;
		transition: opacity .25s ease-in-out;
		-moz-transition: opacity .25s ease-in-out;
		-webkit-transition: opacity .25s ease-in-out;
		z-index:15;
	}
	.fade:hover {
		opacity: 0.4;
	}
	.selColor {
		border:3px solid #A8856F;
	}
	.noSelColor {
		border:3px;
	}
	#Slide {
		border-left: 4px solid rgb(60, 23, 14);
		border-left: 4px solid rgba(60, 23, 14, .5);
		border-right: 4px solid rgb(60, 23, 14);
		border-right: 4px solid rgba(60, 23, 14, .5);
		border-top: 4px solid rgb(60, 23, 14);
		border-top: 4px solid rgba(60, 23, 14, .5);
		margin: 5px auto;
		z-index:5;
		position:relative;
	}
	#imageSelector {
		margin: 5px auto;
		text-align:center;
		color:#B69179;
		background: transparent;
		font-weight:bold;
		width: 158px;
		padding: 5px;
		font-size: 22px;
		line-height: 1;
		border: 0;
		border-radius: 0;
		height: 42px;
		-webkit-appearance: none;
	}
	#selectorDiv {
		background:#3C170E;
		width:728px;
		height:54px;
		margin: -9px auto;
		text-align:center;
		opacity:.5;
		position:relative;
		z-index:1;
	}
	</style>
	<!-- creates a php array from "Images" folder -->
	<?php
	$image = glob("Images/*.jpg");
	?>
	<script type="text/javascript">
	var imagePaths = <?php echo json_encode($image); ?>; // with php json help the php array is converted for js
	// the above 2 php lines dynamically replace manually coding an array (Just add JPEGs to "Images" folder)
	
	var imageCache = []; // declares image cache
	for (var i=0; i<imagePaths.length; i++) { // fills imageCache with data
		var s = imagePaths[i]
		imageCache[i] = new Image();
		imageCache[i].src = s;
		imageCache[i].name = s.substring(s.lastIndexOf("/")+1, s.lastIndexOf("."));
	}
    
	var curSlide = 0; // declares the default / 1st slide source (Slide.src)
	function changeSlide(dir){ // changes the Slide array up or down (arrows)
		curSlide += dir;
		if (curSlide < 0) {
			curSlide = imageCache.length - 1;
		} else if (curSlide >= imageCache.length) {
			curSlide = 0;
		}
		document.Slide.src = imagePaths[curSlide]; // changes the picture (Slide.src)
		document.forms[0].imageSelector.selectedIndex=curSlide; // forces "imageSelector" to change
		changeBorder(curSlide);
	}
    
	function goToSlide(slide){ // passes "imageSelector" & "Thumbs" values to change picture (Slide.src change)
		document.Slide.src = imagePaths[slide];
		curSlide = slide;
		changeBorder(slide);
	}
	
	window.onload = function (event) { // declares the default or 1st thumb selected
		changeBorder(0)
	}
	var clicked = false;
	var unClick = 0;
	function changeBorder(sel){ // changes thumb selection
		if (clicked == false){
			document.getElementById(sel).className="selColor";
			clicked = true;
		} else if (clicked == true){
			document.getElementById(unClick).className="noSelColor";
			document.getElementById(sel).className="selColor";
		}
		unClick = sel;
		document.forms[0].imageSelector.selectedIndex=curSlide; // forces "imageSelector" to change
	}
	</script>
</head>
<body>
<div id="container">
	<div>
		<h1>Simple Slide Carousel</h1>
		<h3>Just add JPEGs to Images folder.<br>
		Download source or copy code below.</h3>
		<script type="text/javascript">
			document.write("<img id='Slide' name='Slide' src='Images/" + imageCache[0].name + ".jpg' alt='first image'>");
		</script>
		<div class="fade">
			<div id="left">
				<img id="arrowLeft" src="Images/arrow_left.png" alt="left arrow" width="130" height="130" onClick="changeSlide(-1);">
			</div>
			<div id="right">
				<img id="arrowRight" src="Images/arrow_right.png" alt="right arrow" width="130" height="130" onClick="changeSlide(1);">
			</div>
		</div>
	</div>
	<div id="selectorDiv">
		<form>
			<select id="imageSelector" name="imageSelector" onchange="goToSlide(this.selectedIndex);">
				<script type="text/javascript">
				for (var i=0; i<imageCache.length; i++) {
					document.write("<option value='" + i + "'>" + imageCache[i].name + "</option>");
				}
				</script>
			</select>
		</form>
	</div>
	<div id="Thumbs">
		<div id="thumbDiv">
			<script type="text/javascript">
			for (var i=0; i<imageCache.length; i++) {
				document.write("<img id='" + i + "' src='Images/" + imageCache[i].name + ".jpg' onClick='goToSlide(" + i + ");'>");
			}
			</script>
		</div>
	</div>
	<script type="text/javascript">
		document.onkeydown = function(evt) { // triggers for left and right arrow keys
			evt = evt || window.event;
			switch (evt.keyCode) {
				case 37:
					changeSlide(-1);
					break;
				case 39:
					changeSlide(1);
					break;
			}
		};
	</script>
</div>
</body>
</html>
