<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * master project
 *
 * This model represents project to show data. It operates the following tables:
 * - project data,
 *
 * @author	jamal (ajamaludin@gmail.com)
 */
class Project_model extends CI_Model
{
	private $table_name			= 'project';			// jasa accounts

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();		
	}
	 
	 
	public function get_data_by_id($projectid)
	{	
		$this->db->where('projectid', $projectid);									
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
	 * Get project record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_project_by_id($kd_id)
	{
		$this->db->where('projectid', $kd_id);

		$query = $this->db->get($this->table_name);
		if ($query->num_rows() > 0) return $query;
		return NULL;
	}  
	
    
	/**
	 * Get project record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function get_all_project($starting=null,$recpage=null,$searching=null)
	{			
		$this->db->from($this->table_name);		
		
		if($searching){				
			$this->db->where('project.projectid LIKE \'%'.$searching.'%\' OR LOWER(project) LIKE \'%'.$searching.'%\'');						
		}
		
		if($this->tank_auth->get_user_access()!="admin"){	
			$this->db->where('org_id', $this->tank_auth->get_org_id());									
		} 
		
		$this->db->order_by("modified", "desc");		
		
		if($recpage){
			$this->db->limit($recpage,$starting);			
		}
		
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query;		
		}else{
			return null;
		}	
	}
	
	/**
	 * Get project record by Id
	 *
	 * @param	int
	 * @param	bool
	 * @return	object
	 */
	function save_project($datas){
		$this->db->insert($this->table_name,$datas);
	}
	
	function update_project($data,$projectid){
		$this->db->where('projectid',$projectid);
	 	$this->db->update($this->table_name,$data);
	}
	function delete_project($projectid){
		$this->db->where('projectid',$projectid);
		$this->db->delete($this->table_name);
	}	
	
	function check_project($tag){
		$query = $this->db->query("SELECT projectid FROM `mst_kualifikasi` WHERE projectid = '$tag'");

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