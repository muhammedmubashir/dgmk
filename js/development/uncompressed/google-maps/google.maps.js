//Google maps api
//-----------------------------------------------

 function initialize() {
		var point = new google.maps.LatLng(40.416691,-3.700345);   //change lat lng to point to map
	
		var myMapOptions = {
			scrollwheel:false,
			zoom: 10,     // change zoom level
			center: point,
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		
		var map = new google.maps.Map(document.getElementById('map'),myMapOptions);
		
		var image = new google.maps.MarkerImage(
		  './images/gmap/image_red_big.png',
		  new google.maps.Size(150,150),
		  new google.maps.Point(0,0),
		  new google.maps.Point(32,65)
		);

		var shadow = new google.maps.MarkerImage(
		  '',
		  new google.maps.Size(208,56),
		  new google.maps.Point(0,0),
		  new google.maps.Point(88,56)
		);

		var shape = {
		  coord: [165,8,166,9,166,10,166,11,166,12,166,13,166,14,166,15,166,16,166,17,166,18,166,19,166,20,166,21,166,22,166,23,166,24,166,25,166,26,166,27,166,28,166,29,166,30,166,31,166,32,166,33,166,34,166,35,166,36,166,37,166,38,166,39,166,40,165,41,95,42,95,43,94,44,93,45,93,46,92,47,91,48,90,49,90,50,89,51,86,51,85,50,84,49,84,48,83,47,82,46,82,45,81,44,80,43,80,42,7,41,6,40,6,39,6,38,6,37,6,36,6,35,6,34,6,33,6,32,6,31,6,30,6,29,6,28,6,27,6,26,6,25,6,24,6,23,6,22,6,21,6,20,6,19,6,18,6,17,6,16,6,15,6,14,6,13,6,12,6,11,6,10,6,9,7,8,165,8],
		  type: 'poly'
		};
	
		var marker = new google.maps.Marker({
		  draggable: true,
		  raiseOnDrag: true,
		  icon: image,
		  shadow: shadow,
		  shape: shape,
		  map: map,
		  position: point
		});
	}
	
	//google
	