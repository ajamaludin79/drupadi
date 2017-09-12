<!-- ADD MODAL -->
<script src="<?php echo base_url('assets/');?>pages/scripts/ui-modals.min.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />        		
<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?php echo base_url();?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>                
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo base_url();?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo base_url();?>/assets/global/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->  
<script src="<?php echo base_url();?>/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
<style>
	.col-md-6{padding:4px;}	
</style>	
<div class="modal fade draggable-modal modal_users" id="draggable">
	<div class="modal-dialog">
		<form action="<?php echo base_url('organization/save_data');?>" method="post" id="savequl">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Tambah organization</h4>
				</div>
				<div class="modal-body"> 
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>										
						<span class="m_error"></span>				
					</div>
					<div class="portlet-body">
						<form role="form" action="#">
							
								<div class="form-group" style="padding: 4px;padding-bottom: 0px;">									
									<input placeholder="Nama Organisasi" class="form-control org_name" name="org_name" type="text"> </div>
								<div class="col-md-6">									
									<select name="pic" class="form-control pic" style="width:100%;">  
										<option></option>															
									</select>
								</div>									
								<div class="col-md-6">									
									<input name="email" placeholder="Email Organisasi" class="form-control" type="email"> </div>								
								<div class="col-md-6">									
									<input placeholder="No. Telp" name="telp" class="form-control" type="text"> </div>		
							
							<div class="col-md-6" >								
								<textarea class="form-control" rows="2" placeholder="Alamat Organisasi" name="alamat" id="alamat"></textarea>
							</div>
						</form>
						<p>&nbsp;</p>
					</div>
				</div>
				<div class="modal-footer">
					<img src="<?php echo base_url('assets/');?>build/img/ajax-loader.gif" alt="save loading.." id="loadingq" style="display:none;">
					<input type="hidden" name="action">
					<input type="hidden" name="kodeq">
					<button type="button" class="btn blue" id="saveq">Simpan</button>
					<button type="button" class="btn dark btn-outline" data-dismiss="modal" >Tutup</button>
				</div>
			</div>
		</form>	
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>  

<script>
	$(document).ready(function(){	
		
		$('input[name=org_name]').keyup(function(){
			this.value = this.value.toUpperCase();
		});
		$('.modal').on('shown.bs.modal', function () {
			$('input.org_name').focus();
		});
				
		$('#saveq').on('click', function () {			
			$('#savequl').ajaxForm({    
				  dataType:  'json',  // dataType identifies the expected content type of the server response              
				  beforeSubmit:function(){
						$('#loadingq').show();
						$('#saveq').html('Proses..');					
					},
				  success: function(res) { 
					  $('#loadingq').fadeOut(); $('#saveq').html('Simpan');	
					  if(res.status=='1'){
						  $(".m_error").html(res.errors); 					  
						  $('.alert-danger').show();	
						  return false;
					  }else{	
						pagination(0);
						$('.modal').modal('hide');
					  }					  
				  }	
			}).submit();
			return false; 			
		});	

		/* $('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true
		});	
		
		$('.slct2').select2({	
			allowClear: true,
			placeholder:'-pilih-'
		}); */	
		
		//get karyawan
		$(".pic").select2({
			allowClear: true,
			placeholder:'-pilih PIC-',
			ajax: {
				url: "<?php echo base_url('users/user/get_all_employee');?>",
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
		}); 
	});	  
</script>	