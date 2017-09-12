<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		//$this->load->model(array('company/company_model'));		
		$this->load->helper('url');
		$this->load->library(array('tank_auth','googlemaps'));
		$this->lang->load('tank_auth',$this->input->cookie('language', TRUE));
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');
		} else {
			##maps
			$config['center'] 				= '0.556706230317291, 123.05865000461586';
			$config['zoom'] 				= 'auto';
			$config['drawing'] 				= true;
			$config['map_type'] 			= 'SATELLITE';			
			$config['drawingModes']			= array('circle','rectangle','polygon');
			$this->googlemaps->initialize($config);

			$groundOverlay 					= array();			
			$groundOverlay['image'] 		= ATTACH_DIR.$this->tank_auth->get_org_id().'/1491411269.png';
			$groundOverlay['positionSW'] 	= '0.556706230317291, 123.05865000461586';
			$groundOverlay['positionNE'] 	= '0.5601580693606888, 123.06106935714729';
			
			$this->googlemaps->add_ground_overlay($groundOverlay);
			
			##create maps
			$data['map'] 		= $this->googlemaps->create_map();

			$data['company_id']	= $this->tank_auth->get_org_id();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['title']		= 'Maps';
			$action 			= $this->input->post('action');
			
			if($action=="ajax"){
				$data['action']	= $action;				
				$this->load->view('maps', $data);	
			}else{
				$data['content']	= 'welcome';	
				$this->load->view('auth/header', $data);	
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */