<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * master user
 *
 * This model represents user to show data. It operates the following tables:
 * - user data,
 *
 * @author	jamal (ajamaludin@gmail.com)
 */
class User_model extends CI_Model
{
	private $table_name			= 'users';			// jasa accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();		
	}
	 
	 
	public function get_data_by_id($id)
	{	
		$this->db->where('id', $id);									
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
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_user_by_id($kd_id)
	{
		$this->db->where('id', $kd_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query;
		return NULL;
	}  
	
    
	/**
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_all_user($starting=null,$recpage=null,$searching=null,$userid=null)
	{	
		$this->db->select('*, concat(users.first_name, " " ,users.last_name) AS fullname ', FALSE);
		$this->db->from($this->table_name);		
		
		if($searching){				
			$this->db->having('LOWER(fullname) LIKE \'%'.$searching.'%\' OR users.id LIKE \'%'.$searching.'%\' OR LOWER(username) LIKE \'%'.$searching.'%\'');			
			//$this->db->where("(LOWER(username) LIKE '%$searching%' OR CONCAT(first_name,' ',last_name') LIKE '%$searching%')");	
		}
		
		if($userid){	
			$this->db->where('id', $userid);									
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
	 * Get user record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function save_user($datas){
		$this->db->insert($this->table_name,$datas);
	}
	
	function update_user($data,$id){
		$this->db->where('id',$id);
	 	$this->db->update($this->table_name,$data);
	}
	function delete_user($id){
		$this->db->where('id',$id);
		$this->db->delete($this->table_name);
	}	
	
	function check_user($tag){
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