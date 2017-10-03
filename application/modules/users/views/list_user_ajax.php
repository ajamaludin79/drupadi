<?php include("./assets/build/pagination_class.php");?>	
<div class="table-scrollable" >	
	<table class="table table-striped table-bordered table-hover" >	
		<thead>
			<th>Id</th>
			<th>Nama</th>			
			<th>Jenis Kelamin</th>			
			<th>Email</th>			
			<th>HP</th>			
			<th>ORG</th>			
		</thead>
		<tbody>
			<?php 
			if($sql > 0 ){
				
				$obj = new pagination_class($sql,$starting,$recpage);			
				foreach($query->result() as $rows){					
					echo '<textarea id="'.$rows->id.'" style="display:none;">'.$rows->alamat.'</textarea>';	
					$org = $this->organization_model->get_data_by_id($rows->org_id);	
				?>				
				<tr class="tr-q" kode="<?php echo $rows->id;?>" ktp="<?php echo $rows->ktp;?>" mobilenumber="<?php echo $rows->mobilenumber;?>" first_name="<?php echo $rows->first_name;?>" last_name="<?php echo $rows->last_name;?>" email="<?php echo $rows->email;?>" access="<?php echo $rows->access;?>" birthday="<?php echo $this->tank_auth->date_in_view($rows->birthday);?>" jkelamin="<?php echo $rows->jkelamin;?>" >
					<td><?php echo $rows->id;?></td>                					
					<td><?php echo $rows->first_name.' '.$rows->last_name;?></td>					
					<td><?php echo !empty($rows->jkelamin) ? $this->tank_auth->get_kelamin()[$rows->jkelamin] : '-';?></td>					
					<td><?php echo $rows->email;?></td>                					
					<td><?php echo $rows->mobilenumber;?></td>                					
					<td><?php echo isset($org) ? $org->organization : '';?></td>                					
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
						
