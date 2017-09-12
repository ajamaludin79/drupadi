<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','tank_auth'));	
		$this->load->model(array('user_model'));	
		//$this->lang->load('tank_auth');
	}

	function index()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {			
			$this->user();
		}
	}
/* --------------------------------------- start master ----------------------------------------------- */		
	
	function user()
	{		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');				
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['web_name']	= $this->config->item('group_name', 'tank_auth');	
			
			$data['content']	= 'list_user';
			
			$data['title']		= 'Master user';			
			$data['menu_aktif']	= 'user';			
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
			
			$data['sql'] 		= $this->user_model->get_all_user()->num_rows();	
			$data['query'] 		= $this->user_model->get_all_user($starting,$data['recpage'],$searching);
			
			if($action == 'ajax'){	
				$data['sql'] 		= $this->user_model->get_all_user($starting=null,$recpage=null,$searching)->num_rows();	
				$this->load->view('list_user_ajax', $data);
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
						
			$data['title']		= 'Tambah User';
			$data['button']		= $this->input->post('button');
			$this->load->view('modal/add_modal',$data);
		}
	}
	
	function save_data()
	{
		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {	
			$this->form_validation->set_rules('first_name', 'Nama Depan', 'trim|required|xss_clean');						
			$this->form_validation->set_rules('jkelamin', 'Jenis Kelamin', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('access', 'Akses User', 'trim|required|xss_clean');			
			$this->form_validation->set_rules('hp', 'No. HP. ', 'trim|required');
			
			$action 	= strtolower($this->input->post('action'));
			$idn 		= strtolower($this->input->post('kodeq'));
			
			if($action=='simpan'){
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check');
				
				$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
				$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'required');
			}else{
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');	
			}	
			
			$this->form_validation->set_message('required', '%s tidak boleh kosong.');
			
			$status = 0; $message = array();
			if ($this->form_validation->run()) {
				
				$first_name = $this->input->post('first_name');
				$last_name 	= $this->input->post('last_name');
				$nrp 		= $this->user_model->get_ordinal('users','id');
				$pass 		= $this->input->post('password');
				
				if(!empty($pass) && $action=="edit"){
					$hasher     = new PasswordHash($this->config->item('phpass_hash_strength', 'tank_auth'),$this->config->item('phpass_hash_portable', 'tank_auth') );	
					$password 	= $hasher->HashPassword($pass);					
				}	 
				
				if($action=="simpan"){
					$nrp		= $nrp;
					$username 	= $this->tank_auth->random_username($first_name.' '.$last_name);
					$hasher     = new PasswordHash($this->config->item('phpass_hash_strength', 'tank_auth'),$this->config->item('phpass_hash_portable', 'tank_auth') );	
					$password 	= $hasher->HashPassword($pass);	
				}else{
					$user		= $this->user_model->get_data_by_id($idn);
					$password	= $user->password;
					$nrp		= $idn;
					$username	= $user->username;
				}	
								
				
				$jkelamin 	= $this->input->post('jkelamin');
				$access 	= $this->input->post('access');
				$email 		= $this->input->post('email');
				$active 	= $this->input->post('aktif');
				$company 	= $this->input->post('company_id');
				$hp 		= $this->input->post('hp');
				$ktp 		= $this->input->post('ktp');
				$cmpny 		= $this->tank_auth->get_org_id();
				$birthday 	= $this->input->post('birthday');
								
											
				$data       = array('id'			=> ($action=="simpan") ? $nrp : $idn,
								'first_name'		=> trim($first_name),
								'last_name' 		=> ltrim($last_name),
								'password'  		=> $password,
								'username'  		=> $username,
								'jkelamin'  		=> $jkelamin,
								'access'  			=> $access,
								'email'     		=> $email,
								'birthday'     		=> $this->tank_auth->date_in_sql($birthday),
								'company_id'		=> $cmpny,								
								'mobilenumber'		=> $hp,								
								'ktp'				=> $ktp,								
								'alamat'			=> $this->input->post('alamat'),								
								'activated'			=> isset($active)?$active:'1',								
								'last_ip'			=> $this->input->ip_address(),
								'created'			=> $this->tank_auth->insert_datetime(),
								'created_by'		=> $this->tank_auth->get_user_id()
							);
				if($action=="simpan"){		
					$this->user_model->save_user($data);
					$sbjc	= 'New Account';	
					
					##sending email to the new user
					$subject					= $sbjc.' | '.$this->config->item('nickname', 'tank_auth');						
					$email 						= $email;
					$sender						= $this->config->item('app_name', 'tank_auth');
					
					$email_data['username']  	= $nrp;
					$email_data['site_name']  	= 'http://'.$_SERVER['HTTP_HOST']."/";
					$email_data['first_name']	= trim($first_name);				
						
					$email_data['password']  	= (!empty($pass)) ? $pass : '---';
					$email_data['email']  	 	= $email;					
					
					$notification_name			= 'welcome-html';
					$this->users->send_notification_email($notification_name, $subject, $email, $sender, $email_data);	
				}else{
					$this->user_model->update_user($data,$nrp);
					$sbjc	= 'Update Account';
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
			
				$this->user_model->update_user($data,$nrp);	
		}
	}
	
	function email_check($str)
	{
		$email = $this->user_model->role_exists($str);
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
	##get PIC
	function get_all_employee()
	{		
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {
							
			##searchings			
			$searching 		= $this->input->get('q'); 			
			$employee 	= $this->user_model->get_all_user($starting=0,$recpage=20,$searching);
			$c 			= array(); 
			if($employee->num_rows()>0){
				foreach ($employee->result() as $a ){	
					//if($a->id_kar != $nrp){ 
						$c[] = array('id' => $a->id, 'text' => $a->fullname);
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