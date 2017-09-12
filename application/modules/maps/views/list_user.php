<!-- BEGIN SAMPLE TABLE PORTLET-->
<div class="portlet box yellow">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-cogs"></i><?php echo isset($title)?$title:'';?>
		</div>		
		<div class="tools">								
			<a href="javascript:;" class="removes" data-original-title="" title="Daftar petani" onclick="closeNav('aturproyek')" style="padding:0;"> </a>
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
			<!--<div class="col-md-6 col-sm-6"><div id="sample_1_filter" class="dataTables_filter" style="float:right;"><label>Search:<input class="form-control input-sm input-small input-inline search" placeholder="" aria-controls="sample_1" type="search"></label></div></div>-->
		</div>
		<div id="datatables" >
			<?php include ("list_user_ajax.php");?>  
		</div>	
	</div>				
</div>
	<!-- END SAMPLE TABLE PORTLET-->
<!-- END PAGE CONTENT INNER -->		
 
<script type="text/javascript">

$(document).ready(function(){					
	/* $( ".bs-checkbox" ).each(function(index) {	
		 $(this).on("click", function(){
			var sts=0;
			if($(this).find('input').is(':checked')){
				sts	= 1;
			}			
			$.ajax({
				  type: 'POST',
				  url: '<?php echo base_url('users/user/update_statusUsers');?>',
				  data:{nrp:$(this).attr('nrp'), status:sts},
				  success: function(a){
						
				  }
			});				
		});				
	});	 */
});	  

  function pagination(page){
	  $('#loader').fadeIn();
	  var searching 	= $('.search').val();
 	  var limit  		= $('#sort').val();
	  var destination 	= '<?php echo base_url('auth/welcome/getList_petani');?>';				  
	  $.ajax({
		  type: 'POST',
		  url: destination,
		  data:{action:'daftar_petani',page:page,searching:searching,limit:limit},
		  success: function(a){
			  $('#datatables').html(a);
			  $('#loader').fadeOut();
		  }
	  });			
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

