Slide-Carousel-Simple
=====================

Just add JPEGs to an "Images" folder just outside of the slideCarouselSimple.php file. The carousel requires PHP5 or higher to be loaded on its hosting server. I wrote this in Javascript, PHP, and HTML5 so it can be mobile and or desktop compatible... Enjoy!

simple slide carousel / photo viewer

<a href="http://www.totallytotallyamazing.com/?doaction=code1" target="_blank">DEMO</a>

```html
<div class="reveal">
	<div class="slides">
		<section>Single Horizontal Slide</section>
		<section>
			<section>Vertical Slide 1</section>
			<section>Vertical Slide 2</section>
		</section>
	</div>
</div>
```

<pre><code>
&lt;html&gt;
&lt;head&gt;
&lt;meta charset="UTF-8"&gt;
&lt;title&gt;Totally Totally Amazing Slide Carousel&lt;/title&gt;
	&lt;style&gt;
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
	&lt;/style&gt;
	&lt;!-- creates a php array from "Images" folder --&gt;
	&lt;?php
	$image = glob("Images/*.jpg");
	?&gt;
	&lt;script type="text/javascript"&gt;
	var imagePaths = &lt;?php echo json_encode($image); ?&gt;; // with php json help the php array is converted for js
	// the above 2 php lines dynamically replace manually coding an array (Just add JPEGs to "Images" folder)
	
	var imageCache = []; // declares image cache
	for (var i=0; i&lt;imagePaths.length; i++) { // fills imageCache with data
		var s = imagePaths[i]
		imageCache[i] = new Image();
		imageCache[i].src = s;
		imageCache[i].name = s.substring(s.lastIndexOf("/")+1, s.lastIndexOf("."));
	}
    
	var curSlide = 0; // declares the default / 1st slide source (Slide.src)
	function changeSlide(dir){ // changes the Slide array up or down (arrows)
		curSlide += dir;
		if (curSlide &lt; 0) {
			curSlide = imageCache.length - 1;
		} else if (curSlide &gt;= imageCache.length) {
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
	&lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;div id="container"&gt;
	&lt;div&gt;
		&lt;h1&gt;Simple Slide Carousel&lt;/h1&gt;
		&lt;h3&gt;Just add JPEGs to Images folder.&lt;br&gt;
		Download source or copy code below.&lt;/h3&gt;
		&lt;script type="text/javascript"&gt;
			document.write("&lt;img id='Slide' name='Slide' src='Images/" + imageCache[0].name + ".jpg' alt='first image'&gt;");
		&lt;/script&gt;
		&lt;div class="fade"&gt;
			&lt;div id="left"&gt;
				&lt;img id="arrowLeft" src="Images/arrow_left.png" alt="left arrow" width="130" height="130" onClick="changeSlide(-1);"&gt;
			&lt;/div&gt;
			&lt;div id="right"&gt;
				&lt;img id="arrowRight" src="Images/arrow_right.png" alt="right arrow" width="130" height="130" onClick="changeSlide(1);"&gt;
			&lt;/div&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;div id="selectorDiv"&gt;
		&lt;form&gt;
			&lt;select id="imageSelector" name="imageSelector" onchange="goToSlide(this.selectedIndex);"&gt;
				&lt;script type="text/javascript"&gt;
				for (var i=0; i&lt;imageCache.length; i++) {
					document.write("&lt;option value='" + i + "'&gt;" + imageCache[i].name + "&lt;/option&gt;");
				}
				&lt;/script&gt;
			&lt;/select&gt;
		&lt;/form&gt;
	&lt;/div&gt;
	&lt;div id="Thumbs"&gt;
		&lt;div id="thumbDiv"&gt;
			&lt;script type="text/javascript"&gt;
			for (var i=0; i&lt;imageCache.length; i++) {
				document.write("&lt;img id='" + i + "' src='Images/" + imageCache[i].name + ".jpg' onClick='goToSlide(" + i + ");'&gt;");
			}
			&lt;/script&gt;
		&lt;/div&gt;
	&lt;/div&gt;
	&lt;script type="text/javascript"&gt;
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
	&lt;/script&gt;
&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
