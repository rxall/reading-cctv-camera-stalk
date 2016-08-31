<!DOCTYPE html>
<html>

<!--

	CCTV feeds that seem to exist but were not plotted as they are currently down:
		0007
		0038
		0051
		0056

	CCTV feeds that need real locations:
		0047

-->

  <head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta charset="utf-8">
	<link rel="stylesheet" href="/js/jAlert-master/src/jAlert-v3.css">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cutive+Mono|Roboto:400,500">
	
    <title>Reading CCTV Traffic Cameras</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
  		font-family: "roboto";
      }
	  .ja_title, .ja_button, .ja_close{
		  text-align: center;
  		  font-family: "roboto";
	  }
	  .ja_body{
		  font-family: "roboto";
		  text-align: center;
	  }
	  #keep-left{
		  text-align: left;
		  position:fixed;
	  }
	  #keep-right{
		  text-align: right;
		  float:right;
		  padding-bottom:10px;
	  }
	  #wrapper{
		  position:relative;
		  font-weight:500;
	  }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/jAlert-master/src/jAlert-v3.min.js"></script>
	<script src="js/jAlert-master/src/jAlert-functions.min.js"></script>
    <script>
	
	function initialize() {
	  var myLatlng = new google.maps.LatLng(51.448535, -0.967594);
	  var mapOptions = {
		zoom: 13,
		center: myLatlng
	  };

	  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  addNewMarkers (markers, map);
	  
	}
	
	function reload(){		
		//Appending the time to the filename as a cache breaker. Not an ideal solution as it fills upstream caches with a 1 FPS
		//stream of each webcam if they are being watched.
		var a = document.getElementById("activeImage");
		if(a){
		imgName = document.getElementById("activeImage").getAttribute("src");
		imgName = imgName.split('?').shift();
		document.getElementById("activeImage").setAttribute("src", imgName + '?' + new Date().getTime());	
		}
	}

	function addNewMarkers (markers, map) {
	 
		var markersAmnt = markers.length;
		for ( var i = 0; i < markersAmnt; i++ ) {
			 
			var markerPos = new google.maps.LatLng( markers[i].position.lat, markers[i].position.lng );
	 
			var marker = new google.maps.Marker({
				position: markerPos,
				map: map,
				title: markers[i].title,
				markerNumber: i
			});
	  
			google.maps.event.addListener(marker, 'click', function(pointer, bubble) {
				return function() {
					clearInterval(window.refreshIntervalID);
					window.refreshIntervalID = setInterval("reload()",1000);
					bubble.setContent(markers[pointer.markerNumber].content());
					bubble.open(map, pointer);
				};
			}(marker, infoWindow));
		}
	}
	
	var contentA =  '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<div id="wrapper"><div id="keep-left" class="ja_btn">';
	  
	var contentB = '</div><div id="keep-right"><a href="';
	  
	var contentC = '" class="ja_btn ja_btn_green" download>Download Image!</a></div></div>'+
	  '<div id="bodyContent">'+
      '<p><img src=';
	  
	var contentD = ' id="activeImage" style="max-width:100%;"></p>'+
      '</div>'+
      '</div>';
	
	var markers = [
		{
			title: '01 Church Street',
			position: {
				lat: 51.467412,
				lng: -0.976766
			},
			content: function() {return contentA + this.title + contentB + this.url + contentC + this.url + contentD},
			url: "http://62.255.244.49/0001.jpg",
			marker: null
		},
		{
			title: '02 Castle Hill',
			position: {
				lat: 51.452117, 
				lng: -0.977643
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0002.jpg",
			marker: null
		},
		{
			title: '04 Queens Road',
			position: {
				lat: 51.45371,
				lng: -0.961836
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0004.jpg",	
			marker: null
		},
		{
			title: '05 Kings Road',
			position: {
				lat: 51.454902,
				lng: -0.962417
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0005.jpg",
			marker: null
		},
		{
			title: '10 Robin Hood',
			position: {
				lat: 51.40671528, 
				lng: -1.31715573
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0010.jpg",
			marker: null
		},
		{
			title: '11 A4/Hambridge',
			position: {
				lat: 51.404238,
				lng: -1.296071
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0011.jpg",	
			marker: null
		},
		{
			title: '14 Bath Rd/Berk Ave',
			position: {
				lat: 51.448826,
				lng:  -0.9929,
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0014.jpg",
			marker: null
		},
		{
			title: '16 A339 Kings Rd',
			position: {
				lat: 51.400447, 
				lng: -1.320728
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0016.jpg",
			marker: null
		},
		{
			title: '17 North/land Ave',
			position: {
				lat: 51.433197,
				lng: -0.962477
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0017.jpg",
			marker: null
		},
		{
			title: '18 Whitley St',
			position: {
				lat: 51.446003,
				lng: -0.965925
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0018.jpg",	
			marker: null
		},
		{
			title: '19 A33 Relief Rd',
			position: {
				lat: 51.444055,
				lng: -0.976469,
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0019.jpg",
			marker: null
		},
		{
			title: 'CAM 003',
			position: {
				lat: 51.411478, 
				lng: -0.972876
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0024.jpg",
			marker: null
		},
		{
			title: '25 Winnersh Crossroads',
			position: {
				lat: 51.42862,
				lng: -0.877343
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0025.jpg",	
			marker: null
		},
		{
			title: '26 A4/A329(M)',
			position: {
				lat: 51.455246, 
				lng: -0.938372
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0026.jpg",
			marker: null
		},
		{
			title: '27 A329 Grovelands',
			position: {
				lat: 51.460026, 
				lng: -1.008724
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0027.jpg",
			marker: null
		},
		{
			title: '28 A33 Bennet Rd',
			position: {
				lat: 51.425354, 
				lng:  -0.980374
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0028.jpg",
			marker: null
		},
		{
			title: 'CAM 029',
			position: {
				lat: 51.415171,
				lng:  -0.972516
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0029.jpg",	
			marker: null
		},
		{
			title: '032 A4/Langley Hill',
			position: {
				lat: 51.442067,
				lng: -1.045740
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0032.jpg",
			marker: null
		},
		{
			title: '33 Friar St/Station Rd',
			position: {
				lat: 51.456801,
				lng:  -0.972207
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0033.jpg",	
			marker: null
		},
		{
			title: '34 Friar St/West St',
			position: {
				lat: 51.45663114,
				lng:  -0.97627148
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0034.jpg",	
			marker: null
		},
		{
			title: '37 Caversham Rd',
			position: {
				lat: 51.46207857,
				lng:  -0.97462188
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0037.jpg",	
			marker: null
		},
		{
			title: '39 A33/Rose Kiln Lane',
			position: {
				lat: 51.43656201,
				lng:  -0.9780645
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0039.jpg",	
			marker: null
		},
		{
			title: '43 Gosbrook Rd',
			position: {
				lat: 51.46590931,
				lng:  -0.96611392
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0043.jpg",	
			marker: null
		},
		{
			title: '45 A33 Kennet Island',
			position: {
				lat: 51.43156766,
				lng:  -0.97876322
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0045.jpg",	
			marker: null
		},
		{
			title: '46 Mereoak Lane',
			position: {
				lat: 51.40430492,
				lng:  -0.98113764
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0046.jpg",	
			marker: null
		},
		{
			title: '',
			position: {
				lat: 51.42862034,
				lng:  -0.94613548
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0047.jpg",	
			marker: null
		},
		{
			title: '48 Shinfield Rise 2',
			position: {
				lat: 51.42679509,
				lng:  -0.94663102
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0048.jpg",	
			marker: null
		},
		{
			title: '50 Sidmouth St',
			position: {
				lat: 51.45103709,
				lng:  -0.96324395
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0050.jpg",	
			marker: null
		},
		{
			title: '53 Berkeley/Rose Kiln',
			position: {
				lat: 51.447804,
				lng: -0.977066
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0053.jpg",	
			marker: null
		},
		{
			title: '54 Berk/Coley Ave',
			position: {
				lat: 51.44730975,
				lng:  -0.98501199
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0054.jpg",	
			marker: null
		},
		{
			title: '55',
			position: {
				lat: 51.44668027,
				lng:  -1.00212861
			},
			content: function() {return contentA + this.title + contentB+ this.url + contentC + this.url +contentD},
			url: "http://62.255.244.49/0055.jpg",	
			marker: null
		}
	];
	
	google.maps.event.addDomListener(window, 'load', initialize);
	var infoWindow = new google.maps.InfoWindow();
	
	$(document).ready(function() {
		 $.jAlert({
			'title':'Reading Traffic Camera Viewer', 
			'content':'Click on one of the red map markers to view a live feed from the camera.</br></br>You can also grab a screenshot of the camera by clicking the button above it.</br></br>', 
			'btns': [
				{'text':'Got it', 'theme':'green'}
			]
		});
	});
	
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	ga('create', 'UA-45963284-10', 'auto');
	ga('send', 'pageview');     
    </script>	
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>