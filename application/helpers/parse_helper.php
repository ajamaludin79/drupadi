<?php

##get redirect
function get_redirect(){
	$CI = & get_instance();  //get instance, access the CI superobject
	$access = $CI->session->userdata('access');
  
	if($access =='admin'){	
		$r = array('user','company','permissions');
	}else{
		$r = array();		
	}
	return $r;	
}

function kategori_gol(){
	$arr = array('m'=>'Pj. Manajement', 'd'=>'Direct Labor', 'i'=>'Indirect Labor');											
	return $arr;	
}	
function minus_hour($hours)
{	
	if($hours !='00:00:00'){ 
		$hour = date('H:i:s', strtotime('-1 hour', strtotime( $hours )));
	}else{
		$hour = '---';
	}
   return $hour;
}

function to_currency($number)
{
    if($number >= 0)
    {
        return 'Rp. '.number_format($number, 0, ',', '.');
    }
    else
    {
        return 'Rp. '.number_format(abs($number), 0, ',', '.');
    }
}

function bilangan($number)
{
    if($number > 0)
    {
        return number_format($number, 0, ',', '.');
    }
    else
    {
        return '0';
    }
}

function FileExt($contentType)
{
	$map = array(
		'application/pdf'   => '.pdf',
		'application/zip'   => '.zip',
		'application/vnd.ms-excel'  => '.xls',		
		'application/msword'  		=> '.doc',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'   		=> '.xlsx',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document'  	=> '.docx',
		'image/gif'         => '.gif',
		'image/jpeg'        => '.jpg',
		'image/png'         => '.png',
		'text/css'          => '.css',
		'text/html'         => '.html',
		'text/javascript'   => '.js',
		'text/plain'        => '.txt',
		'text/xml'          => '.xml'
	);
	if (isset($map[$contentType]))
	{
		return $map[$contentType];
	}

	// HACKISH CATCH ALL (WHICH IN MY CASE IS
	// PREFERRED OVER THROWING AN EXCEPTION)
	$pieces = explode('/', $contentType);
	return '.' . array_pop($pieces);
}

function date_in_view($mysqldate){ 
	if(!empty($mysqldate)){
		if($mysqldate !="0000-00-00 00:00:00" && $mysqldate !="0000-00-00"){
			$phpdate 	= strtotime( $mysqldate );
			$mysqldate 	= date( 'd-m-Y', $phpdate );
		}else{
			$mysqldate 	= "-";
		}		
	}else{
		$mysqldate 	= "-";
	}		
	return $mysqldate;
}

function encodedFiles64($img,$primary){
	if (strpos($img, 'base64') == false) {
		$files 		= $img; 
	}else{		
	
		$path				= ATTACH_DIR .$primary; 										
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
			//mkdir($path.'/thumb', 0777, TRUE);
		}	
		 
		$img 	= strstr($img,'base64,');						
		$img 	= str_replace('base64,', '', $img);						
		//$img 	= str_replace(' ', '+', $img);
		$image 	= base64_decode($img);	
		$f 		= finfo_open();
		$mime_type 	= finfo_buffer($f, $image, FILEINFO_MIME_TYPE);	
												
		$uniqid		= uniqid();
		$file 		= $path.'/'.$uniqid.FileExt($mime_type);	
		$files 		= $uniqid . FileExt($mime_type);	
		$success = file_put_contents($file, $image);											
	}
	return $files;
}


	