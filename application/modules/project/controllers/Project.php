<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','tank_auth'));	
		$this->load->model(array('project_model'));	
		//$this->lang->load('tank_auth');
	}
	
	##get Project
	function get_all_projects()
	{		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {
							
			##searchings			
			$searching 		= $this->input->get('q'); 			
			$employee 	= $this->project_model->get_all_project($starting=0,$recpage=20,$searching);
			$c 			= array(); 
			if($employee->num_rows()>0){
				foreach ($employee->result() as $a ){	
					//if($a->id_kar != $nrp){ 
						$c[] = array('projectid' => $a->projectid, 'text' => $a->project);
					//}
				}
			} else {
			// 0 results send a message back to say so.
				$c[] = array("id"=>"0","text"=>"data yg anda cari tidak ada..");
			}
			//format the array into json data
			echo json_encode($c);			
		}
	}
	
}

/* End of file divisi.php */
/* Location: ./application/controllers/welcome.php */