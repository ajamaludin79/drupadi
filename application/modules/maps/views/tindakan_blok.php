<style>
	td:empty:after {
		content: '-kosong-';
		color: #C7C7CD;
	}
</style>
<div class="portlet light ">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-bubbles font-dark hide"></i>
			<span class="caption-subject font-dark bold uppercase"><?php echo isset($title)?$title:'Users';?></span>
		</div>
		<div class="tools">								
			<a href="javascript:;" class="removes" data-original-title="" title="Daftar petani" onclick="closeNav('tind_blok')" style="padding:0;"> </a>
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
							<a class="accordion-toggle collapsed showpoly" areaid ="<?php echo $irows->area_id;?>" data-toggle="collapse" data-parent="#accordion<?php echo $n;?>" href="#accordion1_<?php echo $n;?>" aria-expanded="true"> <?php echo $n;?>. Blok <?php echo $n;?> </a>
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
												
												<?php 
													$petani = $this->user_model->get_all_user(100,null,null,$irows->user_id);
													if(isset($petani)){														
														$rows 	= $petani->row();
														echo $rows->fullname;	
															
													}else{
														echo '-tidak ada user-';		
													}	
												?>												 
												
											</td>	
										</tr>										
									</tbody>    
								</table>
								<table class="table table-striped table-bordered table-hover">								
									<thead>			
										<th>Tindakan</th>						
										<th>Satuan</th>	
										<th>Banyak</th>	
									</thead>
									<tbody id="myTable<?php echo $irows->area_id;?>">	
										<tr>					
											<td class="tind"></td>															
											<td class="satuan"></td>															
											<td class="banyak"></td>												
											<td><a href="javascript:;" style="padding: 0px;" onclick="myFunction('<?php echo $irows->area_id;?>',this)"><i class="fa fa-plus"></i></a></td>	
										</tr>																														
									<?php
									$g_area = $this->maps_model->get_area_by_id($irows->area_id,'area_actionplan');
									if(isset($g_area)){	
										$rows = isset($g_area) ? $g_area->result() : array(0);
										foreach($rows as $row){
									?>	
										<tr>					
											<td class="tind"><?php echo isset($g_area) ? $row->action: "";?></td>															
											<td class="satuan"><?php echo isset($g_area) ? $row->subaction: "";?></td>															
											<td class="banyak"><?php echo isset($g_area) ? $row->amount: "";?></td>	
											<?php
												
												$act = isset($g_area) ? 'removeRows(this)' : 'myFunction(\''.$irows->area_id.'\',this)';
												$icon = isset($g_area) ? 'fa-trash' : 'fa-pencil';
											?>
											<td><a href="javascript:;" style="padding: 0px;" onclick="<?php echo $act;?>"><i class="fa <?php echo $icon;?>"></i></a></td>	
										</tr>	
									<?php }
									}
									?>	
										<tr>														
											<td colspan="3"><a href="javascript:;" class="btn btn-small savetindakan" id="<?php echo $irows->area_id;?>"><i class="fa fa-save"></i> Simpan </a></td>																									
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
	//$( "#accordion" ).accordion( "option", "active", 0 );
	$( ".showpoly" ).click(function() {		
		var areaid 	= $(this).attr('areaid');
		getPolygon(areaid,false,true);
	});
	
	$( "a.savetindakan" ).click(function() {
		var idtable 	= $(this).attr('id');		
		var tind		= "", sat	= "", byk	= "";
		var x =0;		
		var tindkn = [];
		$( "#myTable"+idtable+" td:not(:last-child)" ).each(function() { x++;
			
			if(x==1){
				tind = $(this).html();				
			}
			
			if(x==2){
				sat = $(this).html();				
			}
			
			if(x==3){
				byk = $(this).html();	

				tindkn.push([{area_id:idtable,action:tind,subaction:sat,amount:byk}]);				
				x=0;	
			} 
		});  
		var that = $(this);		
		$(this).html('<img src="<?php echo base_url("assets/");?>build/img/ajax-loader.gif" alt="save loading..">');
		$.post( "<?php echo base_url("maps/welcome/save_tindakan");?>",{tarray:tindkn,id:idtable}, function( data ) {
			that.html('<i class="fa fa-save"></i> Simpan ');			
		});	
		return false; 		
	});

	$('td.tind').prop('contenteditable', true).css('background','#ffe9e9');
	$('td.satuan').prop('contenteditable', true).css('background','#ffe9e9');
	$('td.banyak').prop('contenteditable', true).css('background','#ffe9e9');
	$('td.tind:first').focus();
});	 

var i=0; 
function myFunction(areaid,that) { i++; 	
	//remove add row function 
	$(that).parent().html('<a href="javascript:;" style="padding: 0px;" onclick="removeRows(this)"><i class="fa fa-trash"></i></a>');
	
    var table = document.getElementById("myTable"+areaid); 
    var row   = table.insertRow(0);		
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    
	$(cell1).prop('contenteditable', true).css('background','#ffe9e9').addClass("tind").focus();
	$(cell2).prop('contenteditable', true).css('background','#ffe9e9').addClass("satuan");
	$(cell3).prop('contenteditable', true).css('background','#ffe9e9').addClass("banyak");
	$(cell4).html('<a href="javascript:;" style="padding: 0px;" onclick="myFunction('+areaid+',this)"><i class="fa fa-plus"></i></a>');
}

function removeRows(that) { //alert($(that).closest('tr').html());
	$(that).closest('tr').remove(); return false;
}
</script>