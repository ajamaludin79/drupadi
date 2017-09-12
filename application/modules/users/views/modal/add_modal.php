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
	.select2-container--bootstrap .select2-selection--single {
		height: 34px;
		line-height: 1.42857;
		padding: 6px 24px 6px 12px;
	}
</style>	
<div class="modal fade draggable-modal modal_users" id="draggable">
	<div class="modal-dialog">
		<form action="<?php echo base_url('users/user/save_data');?>" method="post" id="savequl">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Tambah User</h4>
				</div>
				<div class="modal-body"> 
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>										
						<span class="m_error"></span>				
					</div>
					<div class="portlet-body">
						<form role="form" action="#">
							
								<div class="col-md-6">									
									<input placeholder="First Name" class="form-control first_name" name="first_name" type="text"> </div>
								<div class="col-md-6">									
									<input name="last_name" placeholder="Last Name" class="form-control" type="text"> </div>								
							
								<div class="col-md-6">									
									<select name="jkelamin" id="jkelamin" class="form-control slct2" style="width:100%;">  
										<option value="1">Laki-laki</option>										
										<option value="2">Perempuan</option>																
									</select>
								</div>	
								
								<div class="col-md-6">									
									<select id="akses" name="access" class="form-control slct2" style="width:100%;">
										<option value="user">User</option>	
										<option value="spv">Supervisor</option>										
									<?php if($this->tank_auth->get_user_access()=='admin'){?>		
										<option value="admin">Admin</option>					
									<?php }?>	
									</select>								
								</div>						
								
								<div class="col-md-6">									
									<input name="password" placeholder="Password" class="form-control" type="password"> </div>
								<div class="col-md-6">									
									<input name="cpassword" placeholder="Confirm password" class="form-control" type="password"> </div>								

								<div class="col-md-6">									
									<input name="email" placeholder="Email" class="form-control" type="email"> </div>
								<div class="col-md-6">									
									<input placeholder="Tgl/Tahun Lahir" name="birthday" id="mask_date" class="form-control datepicker" type="text"> </div>								

								<div class="col-md-6">									
									<input name="ktp" placeholder="No. KTP" class="form-control" type="text"> </div>
								<div class="col-md-6">									
									<input placeholder="No. HP" name="hp" class="form-control" type="text"> </div>								
							
							
							<div class="form-group" style="padding: 4px;">								
								<textarea class="form-control" rows="2" placeholder="Alamat" name="alamat" id="alamat"></textarea>
							</div>
						</form>
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
		
		$('input[name=first_name], input[name=last_name]').keyup(function(){
			this.value = this.value.toUpperCase();
		});
		$('.modal').on('shown.bs.modal', function () {
			$('input.first_name').focus();
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

		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true
		});	
		
		$('.slct2').select2({	
			allowClear: true,
			placeholder:'-pilih-'
		});	
	});	  
</script>	