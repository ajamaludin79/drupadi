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
<?php echo $map['js']; ?>
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
			  <button type="button" class="btn btn-default" onclick="load_maps();">Hide/show image</button>
			  <!--<button type="button" class="btn btn-default">Middle</button>
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
			<div id="inc_data"><?php //include("maps.php");?></div>
		</div>
		<!-- END Portlet PORTLET-->			
	</div>
</div>
<!-- END PAGE BAR -->                        
<script>	
	
	$(document).ready(function(){
		/*$("#btnhide").click(function(){		
			$.post("<?php echo base_url("auth/welcome");?>",{action:"ajax"},function(data){
				$("#inc_data").html(data);
			});
		});*/
		load_maps();	
	});
	
	function load_maps(){
			$.post("<?php echo base_url("auth/welcome");?>",{action:"ajax"},function(data){
				$("#inc_data").html(data);
			});
		}
</script>					 

