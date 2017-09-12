<?php include("./assets/build/pagination_class.php");?>	
<div class="table-scrollable" >	
	<table class="table table-striped table-bordered table-hover" >	
		<thead>
			<th>Id</th>
			<th>Nama</th>			
			<th>PIC</th>			
			<th>Email</th>			
			<th>HP</th>			
		</thead>
		<tbody>
			<?php 
			if($sql > 0 ){
				
				$obj = new pagination_class($sql,$starting,$recpage);			
				foreach($query->result() as $rows){										
					echo '<textarea id="'.$rows->org_id.'" style="display:none;">'.$rows->address.'</textarea>';				
					$picn = $this->user_model->get_data_by_id($rows->pic);
				?>				
				<tr class="tr-q" kode="<?php echo $rows->org_id;?>" org_name="<?php echo htmlentities($rows->organization);?>" pic="<?php echo $rows->pic;?>" email="<?php echo $rows->email;?>" telp="<?php echo $rows->phone_number;?>">
					<td><?php echo $rows->org_id;?></td>                					
					<td><?php echo $rows->organization;?></td>					
					<td><?php echo isset($picn) ? $picn->first_name.' '.$picn->last_name : '--';?></td>					
					<td><?php echo $rows->email;?></td>                					
					<td><?php echo $rows->phone_number;?></td>                					
				</tr>
			<?php
				}
			 }else{ ?>
			<tr >
				<td colspan="4">Data tidak ditemukan</td>
			</tr>
			<?php }?>
		</tbody>    
	</table>	
</div>	
<?php 
	//get pagging
	echo '<div class="row">';		
		if($sql > 0 ){
			echo $obj->total; 
			echo $obj->anchors; 
		}	
	echo '</div>';	
?>
						
