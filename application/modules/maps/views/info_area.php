
<div class="portlet light ">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-bubbles font-dark hide"></i>
			<span class="caption-subject font-dark bold uppercase"><?php echo isset($title)?$title:'Users';?></span>
		</div>
		<div class="tools">								
			<a href="javascript:;" class="removes" data-original-title="" title="Daftar petani" onclick="closeNav('infoproyek')" style="padding:0;"> </a>
		</div>		
	</div>
	<div class="portlet-body">		
		<div class="tab-content" style="max-height: 600px;overflow-x: auto;">							
		<?php
			$info = $this->maps_model->get_detail_info_by_id(10);
			if(isset($info)){					
				$n=0;
				foreach($info as $irows){ $n++;
		?>		<div id="accordion<?php echo $n;?>" class="panel-group">
					<div class="panel panel-danger">					
						<h4 class="panel-title">
							<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion<?php echo $n;?>" href="#accordion1_<?php echo $n;?>" aria-expanded="true"> <?php echo $n;?>. Blok <?php echo $n;?> </a>
						</h4>					
						<div id="accordion1_<?php echo $n;?>" class="panel-collapse collapse in" aria-expanded="true">
							<div class="panel-body" style="pading:5px;"> 
								<table class="table table-striped table-bordered table-hover" style="margin-bottom: 2px;">								
									<tbody>												
										<tr>					
											<td>Jenis</td>															
											<td>:</td>															
											<td class="trpName"><?php echo $irows->area;?></td>	
										</tr>											
										<tr>					
											<td>Type</td>															
											<td>:</td>	
											<td class="pType"><?php echo $irows->type;?></td>													
										</tr>
										<tr>					
											<td>Mulai tanam</td>															
											<td>:</td>															
											<td class="trdatepicker"><?php echo $this->tank_auth->date_in_view($irows->m_tanam);?></td>	
										</tr>
										<tr>					
											<td>Usia</td>															
											<td>:</td>															
											<td class="trusia"><?php echo $this->tank_auth->age_call($irows->m_tanam);?></td>	
										</tr>
										<tr>					
											<td>Status</td>															
											<td>:</td>															
											<td><?php echo $irows->status;?></td>	
										</tr>										
										<tr>					
											<td>Petani</td>															
											<td>:</td>															
											<td>
												<select class="ptni">
												<?php 
													$petani = $this->user_model->get_all_user(100);
													if(isset($petani)){
														foreach($petani->result() as $rows){
															$sel 	= ($irows->user_id==$rows->id) ? "selected" : "";													
															echo '<option value="'.$rows->id.'" '.$sel.'>'.$rows->first_name.'</option>';	
														}	
													}else{
														echo '<option>-tidak ada user-</option>';		
													}	
												?>												 
												</select> 											
											</td>	
										</tr>
										<tr>														
											<td colspan="3"><a href="javascript:;" class="btn btn-small savedataarea" id="<?php echo $irows->area_id;?>"><i class="fa fa-pencil"></i> Edit </a></td>																									
										</tr>
									</tbody>    
								</table>								
							</div>
						</div>
					</div>							
				</div>		
		<?php 	}		
			}else{
				echo '--tidak ada data--';				
			}
		?>	
		</div>		
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){		
	//acknowledgement message
	/* $('td.jns').dblclick(function(){
		alert($(this).html());
	}); */	
	
	$('select.ptni').prop('disabled', 'disabled');
	
	$("a.savedataarea").click(function(){	
		var idtable = $(this).attr('id'), that = $(this);
		$(this).parent().parent().parent().find("select").prop('disabled', false);
		
		var inp = $(this).parent().parent().parent().find("td:eq(2),td:eq(5),td:eq(8),td:eq(14)");
		
		var jenis 	= $(this).parent().parent().parent().find("td:eq(2)").html();
		var type 	= $(this).parent().parent().parent().find("td:eq(5)").html();
		var mt 		= $(this).parent().parent().parent().find("td:eq(8)").html();
		var sts		= $(this).parent().parent().parent().find("td:eq(14)").html();
		var petani	= $(this).parent().parent().parent().find("select").val();
		
		inp.prop('contenteditable', true).css('background','#ffe9e9');
		$(this).parent().parent().parent().find("td:eq(2)").focus();					
		
		if($(this).html()=='<i class="fa fa-save"></i> Simpan '){ 
			$.post( "./maps/welcome/updateArea",{area:jenis,type:type,mt:mt,sts:sts,petani:petani,id:idtable}, function( data ) {
				that.html('<i class="fa fa-pencil"></i> Edit ');					
				inp.prop('contenteditable', false).css('background','transparent');
				that.parent().parent().parent().find("select").prop('disabled', true);
			}); 
		} 	
		$(this).html('<i class="fa fa-save"></i> Simpan ');	
		/* 		}else{	
					inp.prop('contenteditable', false).css('background','transparent');
					$(this).html('<i class="fa fa-pencil"></i> Simpan ');	
				} */	
	});	
	
	$('.trdatepicker').datepicker({
		format: 'dd-mm-yyyy',
		autoclose: true
	}).on("changeDate", function (e) {
		var today = convertDate(e.date);
		$(this).html(today);
		var that = $(this);
		
		$.post( "./maps/welcome/getUsiaSawah",{today:today}, function( data ) {
			that.parent().parent().find(".trusia").html(data);
		});
		
	});
		
	
	$('.trpName').keyup(function(){
		this.value = this.value.toUpperCase();
	});	

	$('.trdatepicker').inputmask(
		"dd-mm-yyyy", {
		placeholder: "DD-MM-YYYY", 
		insertMode: false, 
		showMaskOnHover: true
	});	
});	 

function convertDate(inputFormat) {
  function pad(s) { return (s < 10) ? '0' + s : s; }
  var d = new Date(inputFormat);
  return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('-');
} 
</script>