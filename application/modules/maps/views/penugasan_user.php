<div class="portlet light" style="display:none;" id="pngsnUsres">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-bubbles font-dark hide"></i>
			<span class="caption-subject font-dark bold uppercase"><?php echo isset($title)?$title:'Users';?></span>
		</div>
		<div class="tools">								
			<a href="javascript:;" class="removes" data-original-title="" title="Daftar petani" onclick="closeNav('showpetani')" style="padding:0;"> </a>
		</div>	
		<div class="actions">			
			<a href="javascript:;" class="btn btn-default btn-sm" onclick="getModalpetani();">							
				<i class="fa fa-plus"></i> Tambah User<img src="<?php echo base_url('assets/');?>build/img/ajax-loader16.png" alt="save loading.." id="gload" style="display:none;"></a>
			<!--<a href="javascript:;" class="btn btn-default btn-sm">
				<i class="fa fa-print"></i> Print </a>-->
		</div>	
	</div>
	<div class="portlet-body">
		<div class="tab-content">
			<div class="tab-pane active" id="portlet_comments_1">
				<!-- BEGIN: Comments -->
				<div class="mt-comments" style="overflow: hidden;">
				<?php
					$query 		= $this->user_model->get_all_user(10);	
					foreach($query->result() as $rows){		
					echo '<textarea id="'.$rows->id.'" style="display:none;">'.$rows->alamat.'</textarea>';				
				?>	
					<div class="mt-comment" style="cursor:move;" >
						<div class="mt-comment-img">
							<img class="dragimg" src="<?php echo $this->tank_auth->each_get_avatar($rows->id,$rows->avatar,$rows->jkelamin);?>" alt="<?php echo $this->tank_auth->get_fullname();?>" style="width: 42px;">
						</div>
						<div class="mt-comment-body">
							<div class="mt-comment-info">
								<span class="mt-comment-author"><?php echo strtoupper($rows->first_name.' '.$rows->last_name);?></span>
								<!--<span class="mt-comment-date"><?php echo  date('d-M-Y g:iA',strtotime($rows->created));?></span>-->
							</div>
							<div class="mt-comment-text"><?php echo strtoupper($rows->access).' - '.date('d-M-Y g:iA',strtotime($rows->modified));?></div>
							
							<div class="mt-comment-details">
								<!--<span class="mt-comment-status mt-comment-status-pending">Pending</span>-->
								<ul class="mt-comment-actions">
									<li>
										<a href="#" class="tr-q" kode="<?php echo $rows->id;?>" ktp="<?php echo $rows->ktp;?>" mobilenumber="<?php echo $rows->mobilenumber;?>"  first_name="<?php echo $rows->first_name;?>" last_name="<?php echo $rows->last_name;?>" email="<?php echo $rows->email;?>" access="<?php echo $rows->access;?>" birthday="<?php echo $this->tank_auth->date_in_view($rows->birthday);?>" jkelamin="<?php echo $rows->jkelamin;?>">Quick Edit</a>
									</li>
									<!--<li>
										<a href="#">View</a>
									</li>
									<li>
										<a href="#">Delete</a>
									</li>-->
								</ul>
							</div>
						</div>
					</div>
				<?php }?>						
				</div>
				<!-- END: Comments -->
			</div>			
		</div>
	</div>
</div>

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
</script>