<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * master organization
 *
 * This model represents organization to show data. It operates the following tables:
 * - organization data,
 *
 * @author	jamal (ajamaludin@gmail.com)
 */
class Organization_model extends CI_Model
{
	private $table_name			= 'rf_organization';			// jasa accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();		
	}
	 
	 
	public function get_data_by_id($id)
	{	
		$this->db->where('org_id', $id);									
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query->row();
		return NULL;	
	} 
	
	function role_exists($key)
	{
		$this->db->where('email',$key);
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0){
			return $query->row('email');
		}
		else{
			return false;
		}
	}
	/**
	 * Get organization record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_organization_by_id($kd_id)
	{
		$this->db->where('organization', $kd_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query;
		return NULL;
	}  
	
    
	/**
	 * Get organization record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_all_organization($starting=null,$recpage=null,$searching=null)
	{			
		$this->db->from($this->table_name);		
		
		if($searching){				
			$this->db->having('organization.org_id LIKE \'%'.$searching.'%\' OR LOWER(organization.organization) LIKE \'%'.$searching.'%\'');			
			//$this->db->where("(LOWER(organizationname) LIKE '%$searching%' OR CONCAT(first_name,' ',last_name') LIKE '%$searching%')");	
		}
		
		if($this->tank_auth->get_user_access()!="admin"){	
			$this->db->where('org_id', $this->tank_auth->get_org_id());									
		}
		
		$this->db->order_by("created", "desc");		
		
		if($recpage){
			$this->db->limit($recpage,$starting);			
			}
		$query = $this->db->get();
		return $query;		
	}
	
	/**
	 * Get organization record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function save_organization($datas){
		$this->db->insert($this->table_name,$datas);
	}
	
	function update_organization($data,$id){
		$this->db->where('org_id',$id);
	 	$this->db->update($this->table_name,$data);
	}
	function delete_organization($id){
		$this->db->where('org_id',$id);
		$this->db->delete($this->table_name);
	}	
	
	function check_organization($tag){
		$query = $this->db->query("SELECT id FROM `mst_kualifikasi` WHERE id = '$tag'");

        if ($query->num_rows() === 1) {
			echo 'false';
        } else { 
            echo 'true';
        }
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