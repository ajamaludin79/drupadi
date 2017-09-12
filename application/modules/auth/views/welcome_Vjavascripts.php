<!-- BEGIN PAGE HEADER-->
<!-- BEGIN Portlet PORTLET-->
<style>
.page-content-wrapper .page-content{   
    padding: 5px 20px 10px !important;
}
body{overflow:hidden;}
div.floating-panel {
	position: absolute;	
	z-index: 5;
	background-color: #fff;
	padding: 2px;
	border: 1px solid #999;
	text-align: center;
	font-family: 'Roboto','sans-serif';
	line-height: 30px;	
	right: 7px;
	top: 47px;
  }

.sidenav {
    height: 86.8%;
    width: 0;
    position: fixed;
    z-index: 1;   
    background-color: #fff;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 20px;
    text-decoration: none;
    font-size: 15px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover, .offcanvas a:focus{
    color: #d2cbcb;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 0;
    font-size: 25px;    
}

#main {
    transition: margin-left .5s;
    padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
#btnopn{cursor:pointer;z-index: 1;position: absolute;margin-left: 10px;margin-top: 50px;}
</style>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAoJjLtO2mIbRM3CQeGaCYATmPoX7WbiD8&libraries=geometry,drawing,places"></script>    
<div class="page-content">	
	<div class="row">
		
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box dark">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-map"></i>Maps</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>						
					<a href="javascript:;" class="fullscreen" data-original-title="" title=""> </a>
					<a href="javascript:;" class="remove" data-original-title="" title=""> </a>
				</div>
			</div>
			<!-- Add an input button to initiate the toggle method on the overlay. -->			
			<div class="btn-group floating-panel pull-right" role="group">
			  <button type="button" class="btn btn-default" onclick="overlay.toggle();">Hide/show image</button>
			  <!--<button type="button" class="btn btn-default" onclick="openNav();">Open</button>
			  <button type="button" class="btn btn-default">Right</button>-->
			</div>			
			<img src="<?php echo base_url();?>assets/build/img/menu.png" alt="Klik untuk membuka menu" id="btnopn" onclick="openNav();"/>	
			<div class="scroller">				
				<div id="mySidenav" class="sidenav">
				  <a href="javascript:void(0);" class="closebtn" onclick="closeNav()">&times;</a>				  
				  <a href="#">Tandai area sawah</a>
				  <a href="#">Atur petani</a>
				  <a href="#">Bagi blok otomatis</a>
				  <a href="#">Salin blok yang lalu</a>
				  <a href="#">Penugasan blok</a>
				  <a href="#">Informasi blok</a>
				  <a href="#">Tindakan blok</a>
				</div>								
			</div>					
			<div class="portlet-body portlet-empty" id="map_in" > </div>
		</div>
		<!-- END Portlet PORTLET-->			
		
	</div>
</div>
<!-- END PAGE BAR -->  

<script>
	function openNav() {
		$("#btnopn").hide();
		document.getElementById("mySidenav").style.width = "175px";
		document.getElementById("main").style.marginLeft = "175px";
	}

	function closeNav() {
		$("#btnopn").show();	
		document.getElementById("mySidenav").style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
	}
      // This example adds hide() and show() methods to a custom overlay's prototype.
  var overlay;

  USGSOverlay.prototype = new google.maps.OverlayView();

  function initMap() {
	var map = new google.maps.Map(document.getElementById('map_in'), {
	  zoom: 18,
	  center: {lat: 0.5585831513372275, lng: 123.05879216169362},
	  mapTypeId: 'satellite'
	});
	//(0.556706230317291, 123.05865000461586)~(0.5601580693606888, 123.06106935714729)

	var bounds = new google.maps.LatLngBounds(
		new google.maps.LatLng(0.556706230317291, 123.05865000461586),
		new google.maps.LatLng(0.5601580693606888, 123.06106935714729));

	// The photograph is courtesy of the U.S. Geological Survey.
	var srcImage = '<?php echo base_url("assets/attach/".$this->tank_auth->get_org_id());?>';
	srcImage += '/1491411269.png';

	overlay = new USGSOverlay(bounds, srcImage, map);
  }

  /** @constructor */
  function USGSOverlay(bounds, image, map) {

	// Now initialize all properties.
	this.bounds_ = bounds;
	this.image_ = image;
	this.map_ = map;

	// Define a property to hold the image's div. We'll
	// actually create this div upon receipt of the onAdd()
	// method so we'll leave it null for now.
	this.div_ = null;

	// Explicitly call setMap on this overlay
	this.setMap(map);
  }

  /**
   * onAdd is called when the map's panes are ready and the overlay has been
   * added to the map.
   */
  USGSOverlay.prototype.onAdd = function() {

	var div = document.createElement('div');
	div.style.border = 'none';
	div.style.borderWidth = '0px';
	div.style.position = 'absolute';

	// Create the img element and attach it to the div.
	var img = document.createElement('img');
	img.src = this.image_;
	img.style.width = '100%';
	img.style.height = '100%';
	div.appendChild(img);

	this.div_ = div;

	// Add the element to the "overlayImage" pane.
	var panes = this.getPanes();
	panes.overlayImage.appendChild(this.div_);
  };

  USGSOverlay.prototype.draw = function() {

	// We use the south-west and north-east
	// coordinates of the overlay to peg it to the correct position and size.
	// To do this, we need to retrieve the projection from the overlay.
	var overlayProjection = this.getProjection();

	// Retrieve the south-west and north-east coordinates of this overlay
	// in LatLngs and convert them to pixel coordinates.
	// We'll use these coordinates to resize the div.
	var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
	var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

	// Resize the image's div to fit the indicated dimensions.
	var div = this.div_;
	div.style.left = sw.x + 'px';
	div.style.top = ne.y + 'px';
	div.style.width = (ne.x - sw.x) + 'px';
	div.style.height = (sw.y - ne.y) + 'px';
  };

  USGSOverlay.prototype.onRemove = function() {
	this.div_.parentNode.removeChild(this.div_);
  };

  // Set the visibility to 'hidden' or 'visible'.
  USGSOverlay.prototype.hide = function() {
	if (this.div_) {
	  // The visibility property must be a string enclosed in quotes.
	  this.div_.style.visibility = 'hidden';
	}
  };

  USGSOverlay.prototype.show = function() {
	if (this.div_) {
	  this.div_.style.visibility = 'visible';
	}
  };

  USGSOverlay.prototype.toggle = function() {
	if (this.div_) {
	  if (this.div_.style.visibility === 'hidden') {
		this.show();
	  } else {
		this.hide();
	  }
	}
  };
google.maps.event.addDomListener(window, 'load', initMap);
    	
		
var body = document.body, html = document.documentElement;
var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight); 
var height = (height)-105;
document.getElementById('map_in').style.height = height + 'px';
</script>	
<!-- END PAGE HEADER-->                       

