<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('maps_model','users/user_model','project/project_model'));		
		$this->load->helper('url');
		$this->load->library(array('tank_auth','session'));
		$this->lang->load('tank_auth',$this->input->cookie('language', TRUE));
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		/* }else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome'); */
		} else {		
			$data['company_id']	= $this->tank_auth->get_org_id();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['users'] 		= $this->user_model->get_all_user(50);
			$data['title']		= 'Maps';
			$data['menu_aktif']	= 'maps';
			$data['content']	= 'welcome';			
			
			$sessPry 	= $this->maps_model->get_area_by_userId();
			$sessdata 	= $this->session->userdata('sessdata');					
						
			if(isset($sessPry) && !isset($sessdata)){  
				$pry = $this->project_model->get_data_by_id($sessPry->projectid);
				$sessdata = array(
				   'pry_id'  	=> $sessPry->projectid,
				   'pry_name'   => $pry->project			   
				);
				$this->session->set_userdata('sessdata',$sessdata);	
			}
			
			$this->load->view('auth/header', $data);			
		}
	}
		
	
	function save_data()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		/*}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');*/
		} else {
			################ Save & delete markers #################
			if($_POST) //run only if there's a post data
			{
				//make sure request is comming from Ajax
				$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
				if (!$xhr){ 
					header('HTTP/1.1 500 Error: Request must come from Ajax!'); 
					exit();	
				}
				
				// get marker position and split it for database
				$mLatLang	= explode(',',$_POST["latlang"]);
				$mLat 		= filter_var($mLatLang[0], FILTER_VALIDATE_FLOAT);
				$mLng 		= filter_var($mLatLang[1], FILTER_VALIDATE_FLOAT);
				
				//Delete Marker
				if(isset($_POST["del"]) && $_POST["del"]==true)
				{
					$results = $this->maps_model->delete_area($mLat,$mLng);
					if (!$results) {  
					  header('HTTP/1.1 500 Error: Could not delete Markers!'); 
					  exit();
					} 
					exit("data berhasil dihapus!");
				}
				
				$mArea 		= filter_var($_POST["area"], FILTER_SANITIZE_STRING);
				$mstatus 	= filter_var($_POST["status"], FILTER_SANITIZE_STRING);
				$mType		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);
				
				$data       = array('area_id'	=> $this->maps_model->get_ordinal('area_location','area_id'),
						'area'			=> $mArea,
						'status'		=> $mstatus,
						'lat'			=> $mLat,														
						'lng'			=> $mLng,														
						'created_by'	=> $this->tank_auth->get_user_id(),
						'org_id'		=> $this->tank_auth->get_org_id(),
						'user_id'		=> $this->tank_auth->get_user_id()
					);
				
				$results = $this->maps_model->save_area($data); 
				if (!$results) {  
					  header('HTTP/1.1 500 Error: Could not create marker!'); 
					  exit();
				} 
				
				$output = '<h1 class="marker-heading">'.$mArea.'</h1><p>'.$mstatus.'</p>';
				exit($output);
			}
		}
	}

	function save_polygon()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		/*}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');*/
		} else {
			$sessdata = $this->session->userdata('sessdata');					
			if(isset($sessdata)){
				################ Save & delete markers #################
				if($_POST) //run only if there's a post data
				{
					//make sure request is comming from Ajax
					$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
					if (!$xhr){ 
						header('HTTP/1.1 500 Error: Request must come from Ajax!'); 
						exit();	
					}
									
					$mLatLang	= $_POST["latpoly"];				
					//$mLatLang	= json_encode($_POST["latpoly"]);				
					
					//Delete Marker
					if(isset($_POST["del"]) && $_POST["del"]==true)
					{
						$areaid		= $_POST["areaid"];					
						$results 	= $this->maps_model->delete_polygon($areaid);
						if (!$results) {  
						  header('HTTP/1.1 500 Error: Could not delete Markers!'); 
						  exit();
						} 
						exit("data berhasil dihapus!");
					}
					
					$mArea 		= filter_var($_POST["area"], FILTER_SANITIZE_STRING);
					$mstatus 	= filter_var($_POST["status"], FILTER_SANITIZE_STRING);
					$mType		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);
					$assignee	= filter_var($_POST["assignee"], FILTER_SANITIZE_STRING);
					$mtanam		= $this->tank_auth->date_in_sql($_POST["mtanam"]);
					$type		= filter_var($_POST["type"], FILTER_SANITIZE_STRING);
										
					$sessdata 	= $this->session->userdata('sessdata');
					$area_id	= $this->maps_model->get_ordinal('area_location','area_id');	
					//print_r($mLatLang);exit;
					$data       = array('area_id'	=> $area_id,
							'area'			=> $mArea,
							'type'			=> $type,																				
							'm_tanam'		=> $mtanam,																				
							'status'		=> $mstatus,
							'created'		=> $this->tank_auth->insertDatetime(),
							'created_by'	=> $this->tank_auth->get_user_id(),
							'org_id'		=> $this->tank_auth->get_org_id(),
							'projectid'		=> isset($sessdata['pry_id']) ? $sessdata['pry_id'] : '',
							'user_id'		=> $assignee
						);
					
					$results = $this->maps_model->save_area($data); 
					if (!$results) {  
						  header('HTTP/1.1 500 Error: Area gagal dibuat!'); 
						  exit();
					} 
					$n=0;
					foreach($mLatLang as $arrPoly){ 
						foreach($arrPoly as $value){
							$data_detail    	= array('area_id'	=> $area_id,
								'lat'			=> $value['lat'],
								'long'			=> $value['long']							
							);
							$results = $this->maps_model->save_area($data_detail,'area_location_d'); 
							$n++;
						}							
					}	
					
					$output = '<h1 class="marker-heading">'.$mArea.'</h1><p>'.$mstatus.'</p>';					
					$message = array('status' => 0,'output' => $output);							
				}
			}else{
				$message = array('status' => 1,'output' => 'Silahkan pilih proyek terlebih dahulu!');							
			}	
			echo json_encode($message); exit;
		}
	}

	
	function getMarkers()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		/*}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');*/
		} else {
			################ Continue generating Map XML #################

			//Create a new DOMDocument object
			$dom 		= new DOMDocument("1.0");
			$node 		= $dom->createElement("markers"); //Create new element node
			$parnode 	= $dom->appendChild($node); //make the node show up 

			// Select all the rows in the markers table
			$results = $this->maps_model->get_all_area(20);  //$this->db->query("SELECT * FROM markers WHERE 1");
			if (!$results) {  
				header('HTTP/1.1 500 Error: Could not get markers!'); 
				exit();
			} 

			//set document header to text/xml
			header("Content-type: text/xml"); 

			// Iterate through the rows, adding XML nodes for each
			//while($obj = $results->fetch_object())
			foreach($results->result() as $obj)			
			{
			  $node = $dom->createElement("marker");  
			  $newnode = $parnode->appendChild($node);   
			  $newnode->setAttribute("area",$obj->area);
			  $newnode->setAttribute("status", $obj->status);  
			  $newnode->setAttribute("lat", $obj->lat);  
			  $newnode->setAttribute("lng", $obj->lng);  
			  $newnode->setAttribute("type", $obj->type);	
			  
			  $user = $this->users->get_avatars_by_id($obj->user_id);
			  if(isset($user)){
				$avatars 	= $this->tank_auth->each_get_avatar($obj->user_id,$user->avatar,$user->jkelamin);
				$newnode->setAttribute("avatar", $avatars);
				
			  }else{
				$newnode->setAttribute("avatar", "");					
			  }	
			}

			echo $dom->saveXML();	
		}
	}		
	
	function getPolygon()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		/* }else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome'); */
		} else {
			################ Continue generating Map XML #################

			//Create a new DOMDocument object
			$dom 		= new DOMDocument("1.0");
			$node 		= $dom->createElement("markers"); //Create new element node
			$parnode 	= $dom->appendChild($node); //make the node show up 

			// Select all the rows in the markers table
			$results = $this->maps_model->get_all_area(100);
			if (!$results) {  
				header('HTTP/1.1 500 Error: Could not get markers!'); 
				exit();
			} 

			//set document header to text/xml
			header("Content-type: text/xml"); 

			// Iterate through the rows, adding XML nodes for each
			//while($obj = $results->fetch_object())
			foreach($results->result() as $obj)			
			{
			  $node = $dom->createElement("polygon");  
			  $newnode = $parnode->appendChild($node);   
			  $newnode->setAttribute("area",$obj->area);
			  $newnode->setAttribute("status", $obj->status);  
			  $petani = $this->user_model->get_data_by_id($obj->user_id);
			  $newnode->setAttribute("petani", isset($petani) ? ucwords($petani->first_name):"");  
			  $newnode->setAttribute("m_tanam", $this->tank_auth->date_in_view($obj->m_tanam));  
			  $newnode->setAttribute("areaid", $obj->area_id);  	
				$polygon = $this->maps_model->get_detail_poly_by_id($obj->area_id);
				if(!empty($polygon)){
					$newnode->setAttribute("poly", trim($polygon));  			  
				}else{
					$newnode->setAttribute("poly", "");  			  	
				}		
			  $newnode->setAttribute("type", $obj->type);				  
			}

			echo $dom->saveXML();	
		}
	}		
	
	function getlistProyek()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');
		} else {		
			$data['company_id']	= $this->tank_auth->get_org_id();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['title']		= 'Atur Petani';
			$data['content']	= 'list_user';
			
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
			
			if($action == 'daftar_petani'){	
				$data['sql'] 		= $this->user_model->get_all_user($starting=null,$recpage=null,$searching)->num_rows();	
				$this->load->view('list_user_ajax', $data);
			}else{	
				$this->load->view('list_user', $data);	
			}	
		}
	}
	
	function getinfoproyek()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');
		} else {		
			$data['company_id']	= $this->tank_auth->get_org_id();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['title']		= 'Informasi Blok';
			
			$this->load->view('info_area', $data);
		}
	}
	
	function gettind_blok()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');
		} else {		
			$data['company_id']	= $this->tank_auth->get_org_id();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['title']		= 'Tindakan Blok';
			
			$this->load->view('tindakan_blok', $data);
		}
	}
	
	function set_sessiPry()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');
		} else {		
						
			$sessdata = array(
			   'pry_id'  	=> $this->input->post('idpry'),
			   'pry_name'   => $this->input->post('nmpry')			   
		    );
			$this->session->set_userdata('sessdata',$sessdata);								
		}
	}
	
	function getUsiaSawah()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {		
			$today = $this->input->post('today');			
			$today = $this->tank_auth->age_call($today);			
			echo $today;
		}
	}
	
	function getUsers()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		/*}else if($this->tank_auth->get_user_access()!='admin'){ 
			redirect('welcome');*/
		} else {		
			$data['company_id']	= $this->tank_auth->get_org_id();
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['title']		= 'Penugasan blok';
			$data['content']	= 'list_user';
			
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
						
			$this->load->view('penugasan_user', $data);					
		}
	}
	
	
	function save_tindakan()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');		
		} else {
			################ Save & delete markers #################
			if($_POST) //run only if there's a post data
			{
				//make sure request is comming from Ajax
				$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
				if (!$xhr){ 
					header('HTTP/1.1 500 Error: Request must come from Ajax!'); 
					exit();	
				}
								
				
				$id 		= filter_var($_POST["id"], FILTER_SANITIZE_STRING);				
				$tindakan 	= $this->input->post('tarray');
					
				//Delete tindakan
				$results = $this->maps_model->delete_tindakan($id);					
				foreach($tindakan as $arr_tind){
					foreach($arr_tind as $a1){
						$a2       = array(
							'created'		=> $this->tank_auth->insertDatetime(),
							'created_by'	=> $this->tank_auth->get_user_id()						
						);	
						
						$tind = array_merge($a1,$a2);
						$results = $this->maps_model->save_area($tind,"area_actionplan"); 
					}	
				}					
			}
		}
	}		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */