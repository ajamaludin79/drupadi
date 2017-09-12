<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />	
	<title><?php echo $title;?></title>
	<style> .row {margin-bottom: -15px !important;}p {	margin: 0 !important;} </style>	
</head>
<body>
	<div class="page-content">

		<!-- BEGIN PAGE BREADCRUMBS -->
		<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="portlet box yellow">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs"></i><?php echo isset($title)?$title:'';?>
					</div>
					<div class="actions">
						<a href="javascript:;" class="btn btn-default btn-sm" onclick="getModalpetani();">							
							<i class="fa fa-plus"></i> Tambah <img src="<?php echo base_url('assets/');?>build/img/ajax-loader16.png" alt="save loading.." id="gload" style="display:none;"></a>
						<!--<a href="javascript:;" class="btn btn-default btn-sm">
							<i class="fa fa-print"></i> Print </a>-->
					</div>	
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-6 col-sm-6"><div class="dataTables_length" id="sample_1_length"><label>Show <select name="sample_1_length" id="sort" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline"><option value="5">5</option><option value="10" selected>10</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select></label></div></div>
						<div class="col-md-6 col-sm-6"><div id="sample_1_filter" class="dataTables_filter" style="float:right;"><label>Search:<input class="form-control input-sm input-small input-inline search" placeholder="" aria-controls="sample_1" type="search"></label></div></div>
					</div>
					<div id="datatables" >
						<?php include ("list_user_ajax.php");?>  
					</div>	
				</div>				
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
		<!-- END PAGE CONTENT INNER -->
		
	</div>	
</body>
</html>

<script type="text/javascript">
function getModalpetani(){
	$('#gload').fadeIn();
	$.ajax({
		  type: 'POST',
		  url: '<?php echo base_url('users/user/get_modal');?>',
		  data:{action:'ajax'},
		  success: function(a){
				$('#showModals').html(a);			   
				
				$('.alert-danger').hide();				
				$('input[name=action]').val('simpan');								
				$('#draggable').modal({ backdrop: 'static', keyboard: false, show: true });
				$('#gload').fadeOut();
		  }
	});
};
$(document).ready(function(){			
	$(document).on('click','.tr-q', function () {	
		var that = $(this);
		$.ajax({
			  type: 'POST',
			  url: '<?php echo base_url('users/user/get_modal');?>',
			  data:{action:'ajax'},
			  success: function(a){
					$('#showModals').html(a);			   
					$('#draggable').modal({ backdrop: 'static', keyboard: false, show: true });
					$('.alert-danger').hide();
					//get content
					var kode = that.attr('kode');
					$('.addmodal').trigger('click'); $('.modal-title').html('Edit User');		
					$('input[name=kodeq]').val(kode);
					$('input[name=first_name]').val(that.attr('first_name'));
					$('input[name=last_name]').val(that.attr('last_name'));
					$('input[name=email]').val(that.attr('email'));		
					$('input[name=birthday]').val(that.attr('birthday'));		
					$('input[name=hp]').val(that.attr('mobilenumber'));		
					$('input[name=ktp]').val(that.attr('ktp'));		
					$('#alamat').val($("#"+kode).html());
					$('#akses').val(that.attr('access'));
					$('#jkelamin').val(that.attr('jkelamin'));
					$('input[name=action]').val('edit');
			  }
		});		
	});	
});	  

  function pagination(page){
	  $('#loader').fadeIn();
	  var searching 	= $('.search').val();
 	  var limit  		= $('#sort').val();
	  var destination 	= '<?php echo base_url("list-users");?>';				  
	  $.ajax({
		  type: 'POST',
		  url: destination,
		  data:{action:'ajax',page:page,searching:searching,limit:limit},
		  success: function(a){
			  $('#datatables').html(a);
			  $('#loader').fadeOut();
		  }
	  })			
  }
  //enter key for searchings
	$(document).on('keyup','.search',function(e){
		if(e.keyCode == 13){
		   pagination(0);	
		}
	});
	
	$(document).on('change','#sort',function(e){
		   pagination(0);	
	});			
</script>

