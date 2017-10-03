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
	
	.btn-file {
		position: relative;
		overflow: hidden;
	}
	.btn-file input[type=file] {
		position: absolute;
		top: 0;
		right: 0;
		min-width: 100%;
		min-height: 100%;
		font-size: 100px;
		text-align: right;
		filter: alpha(opacity=0);
		opacity: 0;
		outline: none;
		background: white;
		cursor: inherit;
		display: block;
	}

	#img-upload{
		width: 250px;
		padding: 30px 0px;
	}
</style>	
<div class="modal fade draggable-modal modal_users" id="draggable">
	<div class="modal-dialog">
		<form action="<?php echo base_url('project/project/save_data');?>" method="post" id="savequl">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Tambah Proyek</h4>
				</div>
				<div class="modal-body"> 
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>										
						<span class="m_error"></span>				
					</div>
					<div class="portlet-body">
						<form class="form-horizontal">
						  <div class="control-group" style="margin-bottom: 15px;">
							<label class="control-label" for="proyek">Nama Proyek</label>
							<div class="controls">
							  <input placeholder="Nama Proyek" class="form-control proyek" name="proyek" type="text"> 
							</div>
						  </div>
						  <div class="control-group">
							<label class="control-label" for="proyek">Upload Image</label>
							<div class="controls">							  
								<div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-default btn-file">
											Browse… <input type="file" id="imgInp">
										</span>
									</span>
									<input type="text" class="form-control" readonly>
								</div>
								<img id='img-upload' />
								<textarea id="imgpry" style="display:none;" name="imgpry" ></textarea>
							</div>
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
		
		$('input[name=proyek]').keyup(function(){
			this.value = this.value.toUpperCase();
		});
		$('.modal').on('shown.bs.modal', function () {
			$('input.proyek').focus();
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
		
		
		$(document).on('change', '.btn-file :file', function() {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function(event, label) {
			
			var input = $(this).parents('.input-group').find(':text'),
				log = label;
			
			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}
		
		});
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$('#img-upload').attr('src', e.target.result);
					document.getElementById("imgpry").value 	= e.target.result;
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function(){
			readURL(this);
		}); 	
		
		/* $('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			autoclose: true
		});	
		
		$('.slct2').select2({	
			allowClear: true,
			placeholder:'-pilih-'
		}); */	
	});	  
</script>	