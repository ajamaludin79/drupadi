<?php include("./assets/build/pagination_class.php");?>	
<div class="table-scrollable" >	
	<table class="table table-striped table-bordered table-hover" >	
		<thead>			
			<th>Nama</th>						
			<th class="bs-checkbox " style="width: 36px; " data-field="state" tabindex="0">Status</th>	
		</thead>
		<tbody>
			<?php 
			if($sql > 0 ){
				
				$obj = new pagination_class($sql,$starting,$recpage);			
				foreach($query->result() as $rows){					
					echo '<textarea id="'.$rows->id.'" style="display:none;">'.$rows->alamat.'</textarea>';				
				?>				
				<tr>					
					<td class="tr-q" kode="<?php echo $rows->id;?>" ktp="<?php echo $rows->ktp;?>" mobilenumber="<?php echo $rows->mobilenumber;?>"  first_name="<?php echo $rows->first_name;?>" last_name="<?php echo $rows->last_name;?>" email="<?php echo $rows->email;?>" access="<?php echo $rows->access;?>" birthday="<?php echo $this->tank_auth->date_in_view($rows->birthday);?>" jkelamin="<?php echo $rows->jkelamin;?>"><?php echo $rows->first_name.' '.$rows->last_name;?></td>															
					<td class="bs-checkbox" style="text-align: center;" nrp="<?php echo $rows->id;?>"><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input data-index="0" name="btSelectItem" class="selectStatus" type="checkbox" <?php echo ($rows->penugasan == '1') ? 'checked' : '';?>><span></span></label></td>	
				</tr>
			<?php
				}
			 }else{ ?>
			<tr >
				<td colspan="2">Data tidak ditemukan</td>
			</tr>
			<?php }?>
		</tbody>    
	</table>	
</div>	
<?php 
	//get pagging
	echo '<div class="row">';		
		if($sql > 0 ){
			//echo $obj->total; 
			echo $obj->anchors; 
		}	
	echo '</div>';	
?>
						
