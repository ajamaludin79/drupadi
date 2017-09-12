<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * master area
 *
 * This model represents area to show data. It operates the following tables:
 * - area data,
 *
 * @author	jamal (ajamaludin@gmail.com)
 */
class Maps_model extends CI_Model
{
	private $table_name			= 'area_location';			// jasa accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();		
	}
	 
	 
	public function get_data_by_id($id)
	{	
		$this->db->where('area_id', $id);									
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query->row();
		return NULL;	
	} 
		
	/**
	 * Get area record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_area_by_id($kd_id,$table=null)
	{
		$table = isset($table) ? $table : $this->table_name;
		$this->db->where('area_id', $kd_id);

		$query = $this->db->get($table);
		if ($query->num_rows() > 0) return $query;
		return NULL;
	}  
	
	function get_area_by_userId()
	{
		if($this->tank_auth->get_user_access()!="admin"){	
			$this->db->where('area_location.user_id', $this->tank_auth->get_user_id());
			$this->db->where('area_location.org_id', $this->tank_auth->get_org_id());									
		}	
				
		$this->db->limit(1);
		$this->db->order_by('area_location.modified','DESC');
		$query = $this->db->get($this->table_name);		
		if ($query->num_rows() > 0) return $query->row();
		return NULL;
	}  
	
	function get_detail_poly_by_id($kd_id)
	{
		$this->db->where('area_id', $kd_id);
		$query = $this->db->get('area_location_d');
		$poly = '';
		if ($query->num_rows() > 0){
			foreach($query->result() as $rows){
				$poly .= $rows->lat.','.$rows->long.' ';
			}			
		}

		return $poly;	
	} 
	
	function get_detail_info_by_id($starting=null,$recpage=null,$searching=null)
	{
		//$this->db->where('area_id', $kd_id);
		$query = $this->db->from($this->table_name);
				
		/* if($this->tank_auth->get_user_access()!="admin"){	
			$this->db->where('area_location.org_id', $this->tank_auth->get_org_id());									
		} */
		
		$sessdata = $this->session->userdata('sessdata');	
		
		if(isset($sessdata)){
			$pry_id = $sessdata['pry_id'];
			$this->db->where("area_location.projectid", $pry_id);		
		}
		
		$this->db->order_by("area_location.created", "desc");		
		
		if($recpage){
			$this->db->limit($recpage,$starting);			
			}
		$query = $this->db->get();
		
		$rows = null;
		if($query->num_rows()>0){
			$rows = $query->result();		
		}
		
		return $rows;	
	}  
	
    
	/**
	 * Get area record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_all_area($starting=null,$recpage=null,$searching=null)
	{			
		$this->db->from($this->table_name);		
		
		if($searching){				
			$this->db->having('area_location.area_id LIKE \'%'.$searching.'%\' OR LOWER(area_location.area) LIKE \'%'.$searching.'%\'');			
			//$this->db->where("(LOWER(areaname) LIKE '%$searching%' OR CONCAT(first_name,' ',last_name') LIKE '%$searching%')");	
		}
		
		if($this->tank_auth->get_user_access()!="admin"){	
			$this->db->where('area_location.user_id', $this->tank_auth->get_user_id());
			$this->db->where('area_location.org_id', $this->tank_auth->get_org_id());									
		}
		
		$sessdata = $this->session->userdata('sessdata');	
		
		if(isset($sessdata)){
			$pry_id = $sessdata['pry_id'];
			$this->db->where("area_location.projectid", $pry_id);		
		}
		
		$this->db->order_by("area_location.created", "desc");		
		
		if($recpage){
			$this->db->limit($recpage,$starting);			
			}
		$query = $this->db->get();
		return $query;		
	}
	
	/**
	 * Get area record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function save_area($datas,$table=null){
		$tbl = isset($table) ? $table : $this->table_name;
		$this->db->insert($tbl,$datas);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function update_area($data,$id){
		$this->db->where('area_id',$id);
	 	$this->db->update($this->table_name,$data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	function delete_area($lat,$lng){
		$this->db->where('lat',$lat);
		$this->db->where('lng',$lng);
		$this->db->delete($this->table_name);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	
	function delete_tindakan($id){		
		$this->db->where('area_id',$id);
		$this->db->delete('area_actionplan');
		return ($this->db->affected_rows() != 1) ? false : true;
	}	
	function delete_polygon($area_id){
		$this->db->where('area_id',$area_id);		
		$this->db->delete($this->table_name);
		return ($this->db->affected_rows() != 1) ? false : true;
	}	
			
	function get_ordinal($table,$field){
		$date 	= date("ym");
		
		//1508009
		$this->db->select_max('right('.$field.',3)','ordinal');		
		$this->db->where('LEFT('.$field.',4)',$date);						
		$this->db->order_by('ordinal','DESC');		
		
		$query = $this->db->get($table);
		
		$ordinal =(int) $query->row('ordinal') + 1;
		
		if($ordinal == 0 || $ordinal == NULL){
			$ordinal = 1;
		}   
		
		$ordinal = str_pad($ordinal, 3,0, STR_PAD_LEFT);  		
		return trim($date.$ordinal);			
	}
}
/* End of file patiens.php */
/* Location: ./application/models/master/patiens.php */