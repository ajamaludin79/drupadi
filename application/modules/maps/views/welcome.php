
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAoJjLtO2mIbRM3CQeGaCYATmPoX7WbiD8&libraries=geometry,drawing,places"></script>    

<link href="<?php echo base_url();?>/assets/build/maps.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        		
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo base_url();?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>                
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url();?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>/assets/global/plugins/select2/js/select2.min.js" type="text/javascript"></script>

<script src="<?php echo base_url();?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>/assets/global/plugins/jquery.input-ip-address-control-1.0.min.js" type="text/javascript"></script>
	
<style type="text/css">

/* Marker Edit form */
.marker-edit {padding-top: 5px; padding-right: 2px; padding-bottom: 8px;}
.marker-edit label{display:block;margin-bottom: 5px;}
.marker-edit label span {width: 100px;float: left;}
.marker-edit label input, .marker-edit label select{height: 24px;}
.marker-edit label textarea{height: 60px;}
.marker-edit label input, .marker-edit label select, .marker-edit label textarea {width: 60%;margin:0px;padding-left: 5px;border: 1px solid #DDD;border-radius: 3px;}

/* Marker Info Window */
h1.marker-heading{color: #585858;margin: 0px;padding: 0px;padding-bottom: 5px;font: 18px "Trebuchet MS", Arial;border-bottom: 1px dotted #D8D8D8;}
div.marker-info-win {max-width: 300px;margin-right: -20px;}
div.marker-info-win p{padding: 0px;margin: 10px 0px 10px 0;}
div.marker-inner-win{padding: 5px;}
button.save-marker, button.remove-marker{border: none;background: rgba(0, 0, 0, 0);color: #00F;padding: 0px;text-decoration: underline;margin-right: 10px;cursor: pointer;
}
</style>
<div class="page-content">	
	<div class="row">
		
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box dark">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-map" ></i><span id="titleMaps">
						<?php
							$sessdata = $this->session->userdata('sessdata');	
							echo isset($sessdata)?$sessdata['pry_name']:'Maps';
						?>						
					</span></div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""> </a>						
					<a href="javascript:;" class="fullscreen" data-original-title="" title=""> </a>
					<a href="javascript:;" class="remove" data-original-title="" title=""> </a>
				</div>
			</div>
			<!-- Add an input button to initiate the toggle method on the overlay. -->			
			<div class="btn-group floating-panel pull-right" role="group">
			  <button type="button" class="btn btn-default hremove" onclick="removeOverlay();">Sembunyikan Gambar</button>
			  <button type="button" class="btn btn-default tremove" onclick="addOverlay();" style="display:none;">Tampilkan Gambar</button>
			  <!--<button type="button" class="btn btn-default">Right</button>-->
			</div>			
			<img src="<?php echo base_url();?>assets/build/img/menu.png" alt="Klik untuk membuka menu" id="btnopn" onclick="openNav('mySidenav');"/>
			<div class="scroller" style="display:none;">				
				<div id="mySidenav" class="sidenav" style="padding-top: 0;"><?php include('right_menus.php');?></div>	
				<div id="aturproyek" class="sidenav" style="padding-top: 0;"></div>	
				<div id="showpetani" class="sidenav" >					
					<?php include('penugasan_user.php');?>
				</div>		
				
				<div id="infoproyek" class="sidenav" style="padding-top: 0;"></div>					
				<div id="tind_blok" class="sidenav" style="padding-top: 0;"></div>					
			</div>	
			<!-- END PAGE BAR -->  
			<div class="portlet-body portlet-empty" id="maps_in"> </div>			
		</div>
		<ul>
						
		<!-- END Portlet PORTLET-->			
		
	</div>
	
</div>
<script type="text/javascript">
var historicalOverlay,$map,selectedShape,all_overlays = [], overlay;
var iconWidth 	= 40;
var iconHeight 	= 40;
	
$(document).ready(function() {		
	$(".dragimg").draggable({
		//revert: true,
		helper: 'clone',
		//opacity: 0.7,
		cursor: "move",			
		/* helper: function( event ) {
			return $( "<div class='ui-widget-header'>I'm a custom helper</div>" );
		},  */
		stop: function(e,ui) {
			//$(ui.helper).clone(true).removeClass('box ui-draggable ui-draggable-dragging').addClass('box-clone');
			var x = e.pageX - $('#maps_in').offset().left;
			var y = e.pageY;
			if(x > 0) {
				var point	= new google.maps.Point(x,y); 
				var ll		= overlay.getProjection().fromContainerPixelToLatLng(point);
				var icon 	= $(this).attr('src'); //alert(icon);
								
				var EditForm = '<p><div class="marker-edit">'+
								'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
								'<label for="pName"><span>Jenis </span><input type="text" name="pName" class="save-name" placeholder="Jenis Padi" maxlength="40" /></label>'+
								'<label for="pType"><span>Type </span> <input type="text" name="pType" class="save-type" placeholder="Type" maxlength="40" />'+				
								'<label for="tName"><span>Mulai Tanam </span><input type="text" name="tName" class="save-tanam datepicker" placeholder="Mulai Tanam" maxlength="40" /></label>'+
								'<label for="pDesc"><span>Status </span><textarea name="pDesc" class="save-desc" placeholder="Status" maxlength="150"></textarea></label>'+				
								'<label for="pType"><span>User </span> <select name="pUser" class="save-assignee">'+
								'<?php									
									foreach($users->result() as $rows){
										echo '<option value="'.$rows->id.'">'.$rows->fullname.'</option>';
									}	
								?></select></label>'+
								'</form>'+
								'</div></p><button name="save-marker" class="save-marker">Simpan Tugas</button>';						

						//Drop a new Marker with our Edit Form
				create_marker(ll, 'Penugasan Blok', EditForm, true, true, true, icon);
			}	
		}
	});
		
	
	$("li.mnuactive").click(function () {
		$("li.mnuactive").removeClass("active");		
		$(this).addClass("active");   
	}); 
});	 
	
	maps_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
		
	function maps_initialize()
	{
			var googleMapOptions = { 
				center: new google.maps.LatLng(0.5585831513372275, 123.05879216169362), // map center				          
				zoom: 18, //zoom level, 0 = earth view to higher value
				//maxZoom: 18,
				minZoom: 16,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.SMALL //zoom control size
				},
				scaleControl: true, // enable scale control
				//mapTypeId: google.maps.MapTypeId.SATELLITE // google map type
				mapTypeId: 'satellite'
			};
		
		   	$map = new google.maps.Map(document.getElementById("maps_in"), googleMapOptions);			
			
			var bounds = new google.maps.LatLngBounds(
			new google.maps.LatLng(0.556706230317291, 123.05865000461586),
			new google.maps.LatLng(0.5601580693606888, 123.06106935714729));

			historicalOverlay = new google.maps.GroundOverlay(
				'<?php echo base_url("assets/attach/".$this->tank_auth->get_org_id()."/1491411269.png");?>',
				bounds);

			addOverlay();
			
			//Load Markers from the XML File, Check (map_process.php)
			$.get("<?php echo base_url('maps/welcome/getPolygon');?>", function (data) {
				$(data).find("polygon").each(function () {
					  var area 		= $(this).attr('area');
					  var status 	= $(this).attr('status');					  
					  var areaid	= $(this).attr('areaid');
					  var type 		= $(this).attr('type');					  		  
					  var m_tanam	= $(this).attr('m_tanam');					  		  
					  var petani	= $(this).attr('petani');					  		  
					  var lokasi	= $(this).attr('poly');		//var dtPoly = JSON.parse(point);	console.log(dtPoly);
					  var title		= area+" - "+petani;
					  var Forms = 	'<p><div class="marker-edit">'+						
									'<label for="pName"><span>Jenis </span>'+area+'</label>'+
									'<label for="pType"><span>Type </span>'+type+'</label>'+				
									'<label for="tName"><span>Mulai Tanam </span>'+m_tanam+'</label>'+
									'<label for="pDesc"><span>Status </span>'+status+'</label>'+				
									'</div></p>';				
					
					var cords = [];
					var str = lokasi.split(" "); 
					
					for (var j=0; j < str.length; j++) { 
						var point = str[j].split(",");
						cords.push(new google.maps.LatLng(parseFloat(point[0]), parseFloat(point[1])));
					}
					  
					  create_polygon(cords, title, Forms, false, false, false, false,areaid,true);
				});
			});

			//Right Click to Drop a New Marker			
			google.maps.event.addListener($map, 'rightclick', function(event) {
				//Edit form to be displayed with new marker
				form_marker(event);
			});		

			google.maps.event.addListener(historicalOverlay, 'rightclick', function(event) {
				form_marker(event);			
			});		
						
			overlay 		= new google.maps.OverlayView();
			overlay.draw 	= function() {};
			overlay.setMap($map);
			
			var polyOptions = {				
				  editable: false,
				  draggable:true,
				  strokeColor: '#FF0000',
				  strokeOpacity: 0.8,
				  strokeWeight: 2,
				  fillColor: '#FF0000',
				  fillOpacity: 0.3
			}; 
			  // Creates a drawing manager attached to the map that allows the user to draw
			  // markers, lines, and shapes.
				drawingManager = new google.maps.drawing.DrawingManager({
					//drawingMode: google.maps.drawing.OverlayType.POLYGON,
					drawingControlOptions: {
					  //position: google.maps.ControlPosition.TOP_CENTER,
					  drawingModes: [
						google.maps.drawing.OverlayType.POLYGON
					  ]
					},
					/* markerOptions: {
					  draggable: true
					},
					polylineOptions: {
					  editable: true
					},
					rectangleOptions: polyOptions,
					circleOptions: polyOptions,*/
					polygonOptions: polyOptions, 
					map: $map
				});
				
				/* google.maps.event.addListener(drawingManager, 'polygoncomplete', function(e){				
					
					form_polygon(e.getPath());
					setSelection(e);
				});
				
				google.maps.event.addListener(polyOptions, 'click', function(e){									
					//form_polygon(e.getPath());
					setSelection(e);
				}); */
			
			 google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
				all_overlays.push(e);
				if (e.type != google.maps.drawing.OverlayType.MARKER) {
				// Switch back to non-drawing mode after drawing a shape.
				drawingManager.setDrawingMode(null);
				// Add an event listener that selects the newly-drawn shape when the user
				// mouses down on it.
				var newShape = e.overlay;
				newShape.type = e.type;
				google.maps.event.addListener(newShape, 'click', function() { 
					if(e.type=='polygon'){						
						form_polygon(newShape.getPath());	
					} 
				  setSelection(newShape);
				});
				setSelection(newShape);
				
					if(e.type=='polygon'){
						form_polygon(newShape.getPath());	
					}
			  }
			}); 
	}
	
	function setSelection(shape) { 
		clearSelection(); 
		selectedShape = shape; 
		shape.setEditable(true);	//console.log(selectedShape);	  		
	}	
	
	function clearSelection() {
		if (selectedShape) {		
			selectedShape.setEditable(false);
			selectedShape = null;
		}
	}
	
	function deleteSelectedShape() {		
		if (selectedShape) { 
			selectedShape.setMap(null);			
		}
	}
	//############### Create Marker Function ##############
	function create_polygon(poly, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, Editable,areaid,create)
	{	
		// Construct the polygon.
		if(create){ 
			var poly = new google.maps.Polygon({
			  paths: poly,
			  map: $map,
			  editable: Editable,
			  draggable:DragAble,
			  strokeColor: '#FF0000',
			  strokeOpacity: 0.8,
			  strokeWeight: 2,
			  fillColor: '#FF0000',
			  fillOpacity: 0.3
			  //fillOpacity: false
			});
		}
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win" style="width:280px;">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		MapDesc+ 
		'</span><button name="remove-marker" class="remove-marker" title="Hapus Marker">Hapus</button>'+
		'</div></div>');		

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {		
			if (infowindow) {
				infowindow.close();
			}
			remove_polygon(poly,areaid);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace 	= contentString.find('span.info-content'); //html to be replaced after success
				var mName 		= contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  		= contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType 		= contentString.find('input.save-type')[0].value; //type of marker
				var assignee	= contentString.find('select.save-assignee')[0].value; //type of marker
				var mTanam 		= contentString.find('input.save-tanam')[0].value; //type of marker
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{				
					if(create){
						poly = poly.getPath();
					}	
					save_polygon(poly, mName, mDesc, mType, mReplace,assignee,mTanam); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(poly, 'click', function(e) {	
			if (infowindow) { 
				infowindow.close(); 
				
				infowindow.open($map); // click on marker opens info window 
				infowindow.setPosition(e.latLng); 			
				setSelection(poly);
			}	
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{ 
			var x = poly.getAt(0); 
			//console.log(polygonBounds.lat);
			infowindow.setPosition(poly.getAt(0));
			infowindow.open($map); // click on marker opens info window 
			
			infowindow.addListener('domready', function() {
				$('.datepicker').datepicker({
					format: 'dd-mm-yyyy',
					autoclose: true
				});	

				$('input[name=pName]').keyup(function(){
					this.value = this.value.toUpperCase();
				});	

				$('input.save-tanam').inputmask(
					"dd-mm-yyyy", {
					placeholder: "DD-MM-YYYY", 
					insertMode: false, 
					showMaskOnHover: true
				});	
				//$('select.save-assignee').select2();	
			});
		}
	}
	
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		var image = {
			  url: iconPath,
			  // This marker is 20 pixels wide by 32 pixels high.
				scaledSize: new google.maps.Size(iconWidth, iconHeight), // scaled size
				origin: new google.maps.Point(0,0)
			  // The origin for this image is (0, 0).
			  /* target: new google.maps.Point(iconWidth/2, iconHeight/2),
			  origin: new google.maps.Point(iconWidth/2, iconHeight/2)  */
			};

		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: $map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Penugasan Petani",
			icon: image
			//content: "<img src='"+iconPath+"' class='img-circle' />"
		});
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		MapDesc+ 
		'</span><button name="remove-marker" class="remove-marker" title="Hapus Marker">Hapus</button>'+
		'</div></div>');		

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			remove_marker(marker);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace 	= contentString.find('span.info-content'); //html to be replaced after success
				var mName 		= contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  		= contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType 		= contentString.find('input.save-type')[0].value; //type of marker
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open($map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
			if (infowindow) {
				infowindow.close();
			}	
			infowindow.open($map,marker);
		}
	}
	
	//############### Form Marker Function ##############
	function form_polygon(event)
	{
		var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Jenis </span><input type="text" name="pName" class="save-name" placeholder="Jenis Padi" maxlength="40" /></label>'+
				'<label for="pType"><span>Type </span> <input type="text" name="pType" class="save-type" placeholder="Type" maxlength="40" />'+				
				'<label for="tName"><span>Mulai Tanam </span><input type="text" name="tName" class="save-tanam datepicker" placeholder="Mulai Tanam" maxlength="40" /></label>'+
				'<label for="pDesc"><span>Status </span><textarea name="pDesc" class="save-desc" placeholder="Status" maxlength="150"></textarea></label>'+				
				'<label for="pType"><span>User </span> <select name="pUser" class="save-assignee">'+
				'<?php					
					foreach($users->result() as $rows){
						echo '<option value="'.$rows->id.'">'.$rows->fullname.'</option>';
					}	
				?></select></label>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Simpan Tugas</button>';

				//Drop a new Marker with our Edit Form
		create_polygon(event, 'Penugasan Blok', EditForm, true, true, true, true,false);
	}
	
	//############### Form Marker Function ##############
	function form_marker(event)
	{
		var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Jenis </span><input type="text" name="pName" class="save-name" placeholder="Jenis Padi" maxlength="40" /></label>'+
				'<label for="pType"><span>Type </span> <select name="pType" class="save-type"><option value="IR 64">IR 64</option><option value="IR 60">IR 60</option>'+
				'<option value="IR 65">IR 65</option></select></label>'+
				'<label for="tName"><span>Mulai Tanam </span><input type="text" name="tName" class="save-tanam datepicker" placeholder="Mulai Tanam" maxlength="40" /></label>'+
				'<label for="pDesc"><span>Status </span><textarea name="pDesc" class="save-desc" placeholder="Status" maxlength="150"></textarea></label>'+				
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Simpan Tugas</button>';

				//Drop a new Marker with our Edit Form
		create_marker(event.latLng, 'Penugasan Blok', EditForm, true, true, true, "<?php echo base_url('assets/build/img/pin_green.png');?>");
	}
	
	//############### Remove Marker Function ##############
	function remove_marker(Marker)
	{
		
		/* determine whether marker is draggable 
		new markers are draggable and saved markers are fixed */
		if(Marker.getDraggable()) 
		{
			Marker.setMap(null); //just remove new marker
		}
		else
		{
			//Remove saved marker from DB and map using jQuery Ajax
			var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
			var myData = {del : 'true', latlang : mLatLang}; //post variables
			$.ajax({
			  type: "POST",
			  url: "<?php echo base_url('maps/welcome/save_data');?>",
			  data: myData,
			  success:function(data){
					Marker.setMap(null); 
					alert(data);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); //throw any errors
				}
			});
		}

	}
	
	//############### Remove polygon Function ##############
	function remove_polygon(Polygon,areaid)
	{ 	
		var cnfrm = confirm("Yakin ingin menghapus blok ini?");
		if(cnfrm){
			deleteSelectedShape();	
			/* determine whether Polygon is draggable 
			new markers are draggable and saved markers are fixed */
			if(areaid){
				//Remove saved Polygon from DB and map using jQuery Ajax			
				var myData = {del : 'true', areaid : areaid}; //post variables
				$.ajax({
				  type: "POST",
				  url: "<?php echo base_url('maps/welcome/save_polygon');?>",
				  data: myData,
				  success:function(data){
						//Polygon.setMap(null); 
						//alert(data);
					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError); //throw any errors
					}
				});
			}
		}
		return false;
	}
	
	function deleteAllShape() { alert(all_overlays.length);
	  for (var i=0; i < all_overlays.length; i++)
	  {
		all_overlays[i].overlay.setMap(null);
	  }
	  all_overlays = [];
	}
	
	//############### Save Marker Function ##############
	function save_polygon(poly, mName, mstatus, mType, replaceWin,assignee,mTanam)
	{		
		/* var vertices = poly;		
		var polygonBounds="";
		   for (var i = 0; i < vertices.length; i++) {
		   var xy = vertices.getAt(i);
		   polygonBounds += xy.lat()+","+xy.lng()+" ";
		} */
			
		var vertices = poly;		
		var polygonBounds = [];
		   for (var i = 0; i < vertices.length; i++) {
		   var xy = vertices.getAt(i);
		   polygonBounds.push([{lat:xy.lat(),long:xy.lng()}]);
		} 
		
		var myData = {area : mName, status : mstatus, latpoly : polygonBounds, type : mType, assignee : assignee, mtanam : mTanam }; //post variables
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url('maps/welcome/save_polygon');?>",
		  data: myData,
		  success:function(data){ 
			var row = JSON.parse(data); 		  
				if(row.status=='1'){
					alert(row.output); openNav('mySidenav');
				}else{  
					replaceWin.html(row.output); //replace info window with new html
				}	
				/* Marker.setDraggable(false); //set marker to fixed
				Marker.setIcon('<?php echo base_url('assets/build/img/pin_blue.png');?>'); */ //replace icon
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
		});
	}
	
	//############### Save Marker Function ##############
	function save_marker(Marker, mName, mstatus, mType, replaceWin)
	{
		//Save new marker using jQuery Ajax
		var mLatLang = Marker.getPosition().toUrlValue(); //get marker position
		var myData = {area : mName, status : mstatus, latlang : mLatLang, type : mType }; //post variables
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "<?php echo base_url('maps/welcome/save_data');?>",
		  data: myData,
		  success:function(data){
				replaceWin.html(data); //replace info window with new html
				Marker.setDraggable(false); //set marker to fixed
				Marker.setIcon('<?php echo base_url('assets/build/img/pin_blue.png');?>'); //replace icon
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); //throw any errors
            }
		});
	}
	
	//Hide show images
	function addOverlay() {
		$('button.hremove').show();
		$('button.tremove').hide();
		historicalOverlay.setMap($map);		
	}

	function removeOverlay() {
		historicalOverlay.setMap(null);
		$('button.tremove').show();
		$('button.hremove').hide();
	}
	
	function getRightMenus(menus,idx){ //alert(idx);
		$('#'+idx).html('<img src="<?php echo base_url("assets/");?>build/img/ajax-loader.gif" alt="save loading.." class="loadingq" style="margin-top: 50%;margin-left: 50%;">');
		$.ajax({
			  type: 'POST',
			  url: '<?php echo base_url('maps/welcome/');?>'+menus,
			  data:{action:'ajax'},
			  success: function(a){
				  $('#'+idx).html(a);
				  //$('.loadingq').fadeOut();
			  }
		});
	};
	
	function openNav(idx) { 
		$(".scroller").show();	
		$("#"+idx).fadeIn('slow');	
		var px=0;
		if(idx=='aturproyek'){ 
			if($('#'+idx).html().length == '0'){ 
				//getlistproyek();
				getRightMenus('getlistProyek',idx);
			}
			px = "350px";
			$("#tind_blok,#showpetani,#infoproyek").width(0);			
		}else if(idx=='showpetani'){ $('#pngsnUsres').show();	
			if($('#'+idx).html().length == '0'){  
				//getUsers();
				//getRightMenus('getUsers',idx);
				$('#'+idx).show();
				
			}
			px = "350px";
			$("#tind_blok,#aturproyek,#infoproyek").width(0);			
		}else if(idx=='infoproyek'){	
			if($('#'+idx).html().length == '0'){  
				//getInfoProyek();
				getRightMenus('getinfoproyek',idx);
			}
			px = "350px";
			$("#tind_blok,#aturproyek,#showpetani").width(0);			
		}else{ 
			//getRightMenus('gettind_blok',idx);
			if($('#'+idx).html().length == '0'){ 
				//tindakan blok
				getRightMenus('gettind_blok',idx);
			} 
			px = "350px";
			$("#infoproyek,#aturproyek,#showpetani").width(0);			
		}			
		document.getElementById(idx).style.width = px;
		//document.getElementById("main").style.marginLeft = px;
	}
	
	function closeNav(idx) {
		//$("#btnopn").show();		
		$("#"+idx).hide("slide", { direction: "left" }, 100);							
		//$("#"+idx).fadeOut();							
		//document.getElementById("main").style.marginLeft= "0";
	}		
		
	var body = document.body, html = document.documentElement;
	var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight); 
	var height = (height)-105;
	//document.getElementById('maps_in').style.height = height + 'px'; 	
	$('#maps_in').css('height',height + 'px'); 	
</script>	
<!-- END PAGE HEADER--> 

