<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','tank_auth'));	
		$this->load->model(array('project_model','users/user_model'));	
		//$this->lang->load('tank_auth');
	}
	
	function index()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {			
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['web_name']	= $this->config->item('group_name', 'tank_auth');	
			
			$data['content']	= 'list_project';
			
			$data['title']		= 'Master Proyek';			
			$data['menu_aktif']	= 'proyek';			
			$data['class']		= '2';
			
			$limit 		= $this->input->post('limit');
			$searching 	= $this->input->post('searching');
			$starting 	= $this->input->post('page');
			$action 	= $this->input->post('action');
			$starting 	= isset($starting) ? $starting : 0;
			
			if($limit) $recpage = $limit; else $recpage = 10;
			
			$data['searching']	= $searching;	
			$data['starting']	= $starting;
			$data['action']		= $action;
			
			$data['recpage'] 	= $recpage;//show data per page						
			
			$data['sql'] 		= $this->project_model->get_all_project()->num_rows();	
			$data['query'] 		= $this->project_model->get_all_project($starting,$data['recpage'],$searching);
			
			if($action == 'ajax'){	
				$data['sql'] 		= $this->project_model->get_all_project($starting=null,$recpage=null,$searching)->num_rows();	
				$this->load->view('list_project_ajax', $data);
			}else{							
				$this->load->view('auth/header', $data);					
			}
		}
	}
	
	function get_modal()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
						
			$data['title']		= 'Tambah Proyek';
			$data['button']		= $this->input->post('button');
			$this->load->view('modal/add_modal',$data);
		}
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
	
	function save_data()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {	
			$this->form_validation->set_rules('proyek', 'Nama Proyek', 'trim|required|xss_clean');									
			
			$action 	= strtolower($this->input->post('action'));
			$company_id	= $this->tank_auth->get_org_id();
						
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			
			$status = 0; $message = array();
			if ($this->form_validation->run()) {
				
				$project	= $this->input->post('proyek');				
				$kode		= $this->input->post('kodeq');				
				$imgpry		= $this->input->post('imgpry');				
				
				if($action=="simpan"){
					$pryid	= $this->project_model->get_ordinal('project','projectid');	
					$created	= 'created';	

				}else{
					$pryid	= $kode;		
					$created	= 'modified';
				}
				
				
				$data       = array('projectid'		=> $pryid,
								'project'			=> trim($project),
								'imagepath' 		=> encodedFiles64($imgpry,$company_id),								
								'created_by'		=> $this->tank_auth->get_user_id(),
								'org_id'			=> $this->tank_auth->get_org_id(),
								$created			=> $this->tank_auth->insert_datetime()
							);
							
				if($action=="simpan"){		
					$this->project_model->save_project($data);					
				}else{
					$this->project_model->update_project($data,$pryid);					
				}	
				
				$message = array('status' => 0,'sukses' => 'data sudah tersimpan');		
			}else{
				$message = array('status' => 1,'errors' => validation_errors());				
			}
			echo json_encode($message);		
		}
	}
	
}

/* End of file divisi.php */
/* Location: ./application/controllers/welcome.php */