<?php include("./assets/build/pagination_class.php");?>	
<div class="table-scrollable" >	
	<table class="table table-striped table-bordered table-hover" >	
		<thead>
			<th>Proyek Id</th>
			<th>Proyek</th>			
			<th>Path Gambar</th>			
			<th>Dibuat</th>							
			<th>Modifikasi</th>							
		</thead>
		<tbody>
			<?php 
			if($sql > 0 ){
				
				$obj = new pagination_class($sql,$starting,$recpage);			
				foreach($query->result() as $rows){										
				?>				
				<tr> 
					<td><?php echo $rows->projectid;?></td>                					
					<td class="tr-q" kode="<?php echo $rows->projectid;?>" project="<?php echo $rows->project;?>" imagepath="<?php echo $rows->imagepath;?>"><a title="klik untuk menampilkan gambar" href="javascript:void(0);"><?php echo $rows->project;?></a></td>			
					<?php						
						$img = "./assets/attach/".$this->tank_auth->get_org_id()."/".$rows->imagepath;						
					?>	
					<td><a title="klik untuk menampilkan gambar" href="javascript:void(0);" onclick="openpopup('<?php echo $img;?>','Show Gambar');"><?php echo $rows->imagepath;?></a></td>					
					<td><?php echo $this->tank_auth->date_in_view($rows->created);?></td>                										             					
					<td><?php echo $this->tank_auth->date_in_view($rows->modified);?></td>                										             					
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
						
