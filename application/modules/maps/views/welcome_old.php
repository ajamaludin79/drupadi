
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
					<i class="fa fa-map"></i>Maps</div>
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
			<div class="scroller">				
				<div id="mySidenav" class="sidenav" style="padding-top: 0;"><?php include('right_menus.php');?></div>	
				<div id="aturproyek" class="sidenav" style="padding-top: 0;"></div>	
				<div id="showpetani" class="sidenav" style="padding-top: 0;"></div>						
				<div id="infoproyek" class="sidenav" style="padding-top: 0;"></div>					
				<div id="tind_blok" class="sidenav" style="padding-top: 0;"></div>					
			</div>					
			<div class="portlet-body portlet-empty" id="map_in" > </div>			
		</div>
		<!-- END Portlet PORTLET-->			
		
	</div>
	
</div>
<!-- END PAGE BAR -->  
<script type="text/javascript">
	var historicalOverlay,map;
	
$(document).ready(function() {	
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true
	});	
		
	var mapCenter = new google.maps.LatLng(0.5585831513372275, 123.05879216169362); //Google map Coordinates
	map_initialize(); // initialize google map
	
	//############### Google Map Initialize ##############
	function map_initialize()
	{
			var googleMapOptions = 
			{ 
				center: mapCenter, // map center				          
				zoom: 17, //zoom level, 0 = earth view to higher value
				//maxZoom: 18,
				minZoom: 16,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL //zoom control size
			},
				scaleControl: true, // enable scale control
				//mapTypeId: google.maps.MapTypeId.SATELLITE // google map type
				mapTypeId: 'satellite'
			};
		
		   	map = new google.maps.Map(document.getElementById("map_in"), googleMapOptions);			
			
			var bounds = new google.maps.LatLngBounds(
			new google.maps.LatLng(0.556706230317291, 123.05865000461586),
			new google.maps.LatLng(0.5601580693606888, 123.06106935714729));

			historicalOverlay = new google.maps.GroundOverlay(
				'<?php echo base_url("assets/attach/".$this->tank_auth->get_org_id()."/1491411269.png");?>',
				bounds);

			addOverlay();
			
			//Load Markers from the XML File, Check (map_process.php)
			$.get("<?php echo base_url('maps/welcome/getMarkers');?>", function (data) {
				$(data).find("marker").each(function () {
					  var area 		= $(this).attr('area');
					  var status 	= $(this).attr('status');
					  var area 		= $(this).attr('area');
					  var type 		= $(this).attr('type');
					  var point 	= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					  
					  var Forms = '<p><div class="marker-edit">'+									
									'<label for="pName"><span>Jenis </span><span style="width:165px;">'+area+'</span></label>'+
									'<label for="tName"><span>Mulai Tanam </span>--</label>'+
									'<label for="pDesc"><span>Status </span>'+status+'</label>'+
									'<label for="pType"><span>Type </span>'+type+'</label>'+									
									'</div></p>';
					  
					  create_marker(point, area, Forms, false, false, false, "<?php echo base_url('assets/build/img/pin_blue.png');?>");
				});
			});

			//Right Click to Drop a New Marker			
			google.maps.event.addListener(map, 'rightclick', function(event) {
				//Edit form to be displayed with new marker
				form_marker(event);
			});		

			google.maps.event.addListener(historicalOverlay, 'rightclick', function(event) {
				form_marker(event);			
			});		
			
			google.maps.event.addListener(map, 'droppable', function(event) {
				//Edit form to be displayed with new marker
				//form_marker(event);
				alert('aa');
			});	
			
			/* $('#map_in').droppable({
				drop: function (event, ui) {
					var el = ui.draggable;
					form_marker(el);			
					//alert(el.text());					
					el.remove(); 
				}
			}); */
	}
	
	//############### Create Marker Function ##############
	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Penugasan Petani",
			icon: iconPath
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
				var mType 		= contentString.find('select.save-type')[0].value; //type of marker
				
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
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//############### Form Marker Function ##############
	function form_marker(event)
	{
		var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Jenis </span><input type="text" name="pName" class="save-name" placeholder="Jenis Padi" maxlength="40" /></label>'+
				'<label for="tName"><span>Mulai Tanam </span><input type="text" name="tName" class="save-tanam datepicker" placeholder="Mulai Tanam" maxlength="40" /></label>'+
				'<label for="pDesc"><span>Status </span><textarea name="pDesc" class="save-desc" placeholder="Status" maxlength="150"></textarea></label>'+
				'<label for="pType"><span>Type </span> <select name="pType" class="save-type"><option value="IR 64">IR 64</option><option value="IR 60">IR 60</option>'+
				'<option value="IR 65">IR 65</option></select></label>'+
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

	$("li.mnuactive").click(function () {
		$("li.mnuactive").removeClass("active");		
		$(this).addClass("active");   
	}); 	
	
});	 
	//Hide show images
	function addOverlay() {
		$('button.hremove').show();
		$('button.tremove').hide();
		historicalOverlay.setMap(map);		
	}

	function removeOverlay() {
		historicalOverlay.setMap(null);
		$('button.tremove').show();
		$('button.hremove').hide();
	}
	
	function getRightMenus(menus,idx){
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
		//$("#btnopn").hide();	
		var px=0;
		if(idx=='aturproyek'){ 
			if($('#'+idx).html().length == '0'){ 
				//getlistproyek();
				getRightMenus('getlistProyek',idx);
			}
			px = "350px";
			document.getElementById('tind_blok').style.width = "0";
			document.getElementById('showpetani').style.width = "0";
			document.getElementById('infoproyek').style.width = "0";
		}else if(idx=='showpetani'){	
			if($('#'+idx).html().length == '0'){  
				//getUsers();
				getRightMenus('getUsers',idx);
			}
			px = "350px";
			document.getElementById('aturproyek').style.width = "0";
			document.getElementById('tind_blok').style.width = "0";
			document.getElementById('infoproyek').style.width = "0";
		}else if(idx=='infoproyek'){	
			if($('#'+idx).html().length == '0'){  
				//getInfoProyek();
				getRightMenus('getinfoproyek',idx);
			}
			px = "350px";
			document.getElementById('aturproyek').style.width = "0";
			document.getElementById('showpetani').style.width = "0";
			document.getElementById('tind_blok').style.width = "0";
		}else{
			if($('#'+idx).html().length == '0'){  
				//tindakan blok
				getRightMenus('gettind_blok',idx);
			}
			px = "350px";
			document.getElementById('aturproyek').style.width = "0";
			document.getElementById('infoproyek').style.width = "0";
			document.getElementById('showpetani').style.width = "0";
		}			
		document.getElementById(idx).style.width = px;
		document.getElementById("main").style.marginLeft = px;
	}
	
	function closeNav(idx) {
		//$("#btnopn").show();					
		document.getElementById(idx).style.width = "0";
		document.getElementById("main").style.marginLeft= "0";
	}		
		
	var body = document.body, html = document.documentElement;
	var height = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight); 
	var height = (height)-105;
	document.getElementById('map_in').style.height = height + 'px'; 	
</script>	
<!-- END PAGE HEADER-->                       

