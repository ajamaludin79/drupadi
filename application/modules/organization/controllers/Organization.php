<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Organization extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','tank_auth'));	
		$this->load->model(array('organization_model','users/user_model'));	
		//$this->lang->load('tank_auth');
	}

	function index()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {			
			$this->organization();
		}
	}
/* --------------------------------------- start master ----------------------------------------------- */		
	
	function organization()
	{		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');				
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['web_name']	= $this->config->item('group_name', 'tank_auth');	
			
			$data['content']	= 'list_organization';
			
			$data['title']		= 'Master organization';			
			$data['menu_aktif']	= 'organization';			
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
			
			$data['sql'] 		= $this->organization_model->get_all_organization()->num_rows();	
			$data['query'] 		= $this->organization_model->get_all_organization($starting,$data['recpage'],$searching);
			
			if($action == 'ajax'){	
				$data['sql'] 		= $this->organization_model->get_all_organization($starting=null,$recpage=null,$searching)->num_rows();	
				$this->load->view('list_organization_ajax', $data);
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
						
			$data['title']		= 'Tambah Organisasi';
			$data['button']		= $this->input->post('button');
			$this->load->view('modal/add_modal',$data);
		}
	}
	
	function save_data()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {	
			$this->form_validation->set_rules('org_name', 'Nama Organisasi', 'trim|required|xss_clean');						
			$this->form_validation->set_rules('pic', 'PIC', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
						
			$action 	= strtolower($this->input->post('action'));
			$idn 		= strtolower($this->input->post('kodeq'));
			
			/* if($action=='simpan'){
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
				
				$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
				$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
			}else{
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
			}	 */
			
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			
			$status = 0; $message = array();
			if ($this->form_validation->run()) {
				
				$org_name 	= $this->input->post('org_name');				
				$org_id		= $this->organization_model->get_ordinal('rf_organization','org_id');
								
				if($action=="simpan"){
					$org_id		= $org_id;	
					$created	= 'created';	
				}else{					
					$org_id		= $idn;					
					$created	= 'modified';
				}	
								
				
				
				$org_name	= $this->input->post('org_name');	
				$pic 		= $this->input->post('pic');				
				$email 		= $this->input->post('email');	
				$telp 		= $this->input->post('telp');
				$alamat 	= $this->input->post('alamat');
				$active 	= $this->input->post('active');
								
											
				$data       = array('org_id'		=> $org_id,
								'organization'		=> trim($org_name),								
								'pic'  				=> trim($pic),
								'email'     		=> trim($email),																
								'phone_number'		=> $telp,																
								'address'			=> $this->input->post('alamat'),								
								'activated'			=> isset($active)?$active:'1',																
								$created			=> $this->tank_auth->insert_datetime(),
								'created_by'		=> $this->tank_auth->get_user_id()
							);
				if($action=="simpan"){		
					$this->organization_model->save_organization($data);						
				}else{
					$this->organization_model->update_organization($data,$org_id);					
				}	
				
				$message = array('status' => 0,'sukses' => 'data sudah tersimpan');		
			}else{
				$message = array('status' => 1,'errors' => validation_errors());				
			}
			echo json_encode($message);		
		}
	}
	
	function update_statusUsers()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {	
						
			$status 	= strtolower($this->input->post('status'));
			$nrp 		= strtolower($this->input->post('nrp'));
							
											
			$data       = array(
							'penugasan'			=> $status,
							'last_ip'			=> $this->input->ip_address(),
							'created'			=> $this->tank_auth->insert_datetime(),
							'created_by'		=> $this->tank_auth->get_user_id()
						);
			
				$this->organization_model->update_user($data,$nrp);	
		}
	}
	
	function email_check($str)
	{
		$email = $this->organization_model->role_exists($str);
		if ($str == $email)
		{
				$this->form_validation->set_message('email_check', '{field} sudah terdaftar');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
	}
	
	function _validate_phone_number($value) {
		$value = trim($value);
		if ($value == '') {
			return TRUE;
		}
		else
		{
			if (preg_match('/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/', $value))
			{
				return preg_replace('/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/', '($1) $2-$3', $value);
			}
			else
			{
				return FALSE;
			}
		}
	}
	
}

/* End of file divisi.php */
/* Location: ./application/controllers/welcome.php */