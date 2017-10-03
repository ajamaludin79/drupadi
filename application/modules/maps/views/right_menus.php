<div class="portlet light ">
	<div class="portlet-title">
		<div class="caption col-md-11">
			<select name="pryk" id="pryk" class="form-control pryk" style="width:100%;">  
				<option></option>								
				<?php
					$projcts = $this->project_model->get_all_project(100);
					if(isset($projcts)){
						foreach($projcts->result() as $pry){
							$sessdata = $this->session->userdata('sessdata');	
							$sel = (isset($sessdata) && $pry->projectid == $sessdata['pry_id']) ?'selected':'';
							echo '<option value="'.$pry->projectid.'" '.$sel.'>'.$pry->project.'</option>';
						}	
					}	
				?>	
			</select>			
		</div>
		<div class="tools col-md-1">								
			<a href="javascript:;" class="removes" data-original-title="" title="Daftar petani" onclick="closeNav('mySidenav')" style="padding:0;"> </a>
		</div>		
	</div>
	<div class="portlet-body">		
		<div class="tab-content">		
			
				<ul class="ver-inline-menu tabbable margin-bottom-10">
					<li onclick="alert('menu masih dalam pengembangan!.');">
						<a data-toggle="tab" href="#tab_1" aria-expanded="true">
							<i class="fa fa-gears"></i> Buat blok otomatis </a>
						<span class="after"> </span>
					</li>
					<li onclick="alert('menu masih dalam pengembangan!.');">
						<a data-toggle="tab" href="#tab_2" aria-expanded="true">
							<i class="fa fa-paste"></i> Salin blok yang lalu </a>
					</li>
					<!--
					<li onclick="openNav('showpetani');">
						<a data-toggle="tab" href="#tab_3" aria-expanded="true">
							<i class="fa fa-user"></i> Penugasan Blok </a>
					</li>
					-->
					<li onclick="openNav('infoproyek');">
						<a data-toggle="tab" href="#tab_1" aria-expanded="true">
							<i class="fa fa-info-circle"></i> Informasi Area </a>
					</li>
					<li onclick="openNav('tind_blok');">
						<a data-toggle="tab" href="#tab_2" aria-expanded="true">
							<i class="fa fa-map"></i> Tindakan Blok </a>
					</li>                                                    
				</ul>			
				
			<!--	  
		  
			<div id="panel-content">
				<div id="controls">
					<select id="polyList"></select>
					<button id="btnDelete">Delete</button>
				</div>
			</div>
			-->										
		</div>					
	</div>	
</div>

<script type="text/javascript">
$(document).ready(function(){	
	$( "#pryk" ).change(function() { 
		var id 		= $("option:selected", this).val(),	text 	= $("option:selected", this).text();	
		$('#titleMaps').html($("option:selected", this).text());
		
		$.post( "<?php echo base_url('maps/welcome/set_sessiPry');?>", { idpry: id, nmpry: text }, function(data, status){
			maps_initialize(); $('#tind_blok,#infoproyek').html("");
		});
		
		
		/* $.ajax({
            url: "caripeta.php",
            data: "kecamatan="+kecamatan+"&status="+status,
            dataType: 'json',
            cache: false,
            success: function(msg) { 
                var karawang2 = new google.maps.LatLng(-6.284600, 107.381583);
                var petaoption2 = {
                    zoom: 11,
                    center: karawang2,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                var peta2 = new google.maps.Map(document.getElementById("map-canvas"),petaoption2);

                var polygon;
                var cords = [];
                for(i=0;i<msg.karawang.lahan.length;i++){
                    nama[i] = msg.karawang.lahan[i].nama_lokasi;
                    kecamatan[i] = msg.karawang.lahan[i].kecamatan;
                    alamat[i] = msg.karawang.lahan[i].alamat;
                    status_lokasi[i] = msg.karawang.lahan[i].status;
                    keterangan[i] = msg.karawang.lahan[i].keterangan;
                    lokasi[i] = msg.karawang.lahan[i].polygon;
                    
                    var str = lokasi[i].split(" "); 
                    
                    for (var j=0; j < str.length; j++) { 
                        var point = str[j].split(",");
                        cords.push(new google.maps.LatLng(parseFloat(point[0]), parseFloat(point[1])));
                    }

                    var contentString = '<b>'+nama[i]+'</b><br>' +
                                        'Alamat: '+ alamat[i] +
                                        '<br>' +
                                        'Kecamatan: '+ kecamatan[i] +
                                        '<br>' +
                                        'Keterangan: '+ keterangan[i] +
                                        '<br>' +
                                        'Status Lokasi : '+ status_lokasi[i] +
                                        '<br>';
                                        
                    polygon = new google.maps.Polygon({
                        paths: [cords],
                        strokeColor: msg.karawang.lahan[i].warna,
                        strokeOpacity: 0,
                        strokeWeight: 1,
                        fillColor: msg.karawang.lahan[i].warna,
                        fillOpacity: 0.5,
                        html: contentString
                    });     

                    cords = [];

                    polygon.setMap(peta2); 
                    google.maps.event.addListener(polygon, 'click', function(event) {
						addNewPolys(polygon);
                        infoWindow.setContent(this.html);
                        infoWindow.setPosition(event.latLng);
                        infoWindow.open(peta2);						
                    });
                }
            }
        }); */
	});
	//get project
	$(".pryk").select2({
		allowClear: true,
		placeholder:'-pilih proyek-'
	});	
	/* $(".pryk").select2({
		allowClear: true,
		placeholder:'-pilih proyek-',
		ajax: {
			url: "<?php echo base_url('project/project/get_all_projects');?>",
			dataType: 'json',
			//delay: 250,
			data: function (params) { 
			  return {
				q: params.term
			  };
			},
			processResults: function (data) {          
			  return {
				results: data
			  };
			},
			cache: true
		}
	});  */	
});	  

</script>