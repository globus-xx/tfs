<?php
//Function to check admin logged in.......
function isAdmin() {
    
    $CI 	=& get_instance();
    $user 	= $CI->session->userdata('adminLoggedIn');
	
    if($user)
		return true; 

	return false;
}

function generateMessage($msg, $type){

		$str = "";
		$str .= '<div id="message-'.$type.'">';
		$str .= '<table border="0" width="100%" cellpadding="0" cellspacing="0">';
		$str .= '<tr>';
		$str .= '<td class="'.$type.'-left">'.$msg.'</td>';
		$str .= '<td class="'.$type.'-right"><a class="close-'.$type.'"><img src="'.base_url().'images/admin/table/icon_close_'.$type.'.gif" alt="" /></a></td>';
		$str .= '</tr>';
		$str .= '</table>';
		$str .= '</div>';
		
		return $str;
		
	}
	
	function uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight){
		
		if($imageOrgName){
			
			// grab the path to the temporary file (image) that the user uploaded
			$photo = $imageTmp;
			
			// check if it exists
			if(is_uploaded_file($photo)){
				//the real image file name
				$real_name = strtolower($imageOrgName);
				// image type based on image file name extension:
				if(strstr($real_name,".png")){
					$image_type = "png";
				}else if(strstr($real_name,".jpg")){
					$image_type = "jpg";
				}else if(strstr($real_name,".gif")){
					$image_type = "gif";
				}else{
					die("Unsupported image type");
				}
				// find the next image name we are going to save
				$x=1;
				while(true){
					$image_name = $imagePath.$imageName;
					$thumb_name = $imagePath."thumb_".$imageName;
					if(!is_file($image_name))break;
					$x++;
				}
			//	die($image_name);
				
				// start processing the main bigger image:
				$max_width = $imageWidth; $max_height = $imageHeight;
				
				$tn_width=$imageWidth; 
				
				$tn_height=$imageHeight;
				$size = getimagesize($photo);
				$width = $size[0];
				$height = $size[1];
				$x_ratio = $max_width / $width;
				$y_ratio = $max_height / $height;
				/*if(($width <= $max_width)&&($height <= $max_height)){
					$tn_width = $width;
					$tn_height = $height;
				}else{
					if(($x_ratio * $height) < $max_height){
						$tn_height = ceil($x_ratio * $height);
						$tn_width = $max_width;
					}else{
						$tn_width = ceil($y_ratio * $width);
						$tn_height = $max_height;
					}
					}
					*/
				
				switch($image_type){
					case "png": $src=imagecreatefrompng($photo); break;
					case "jpg": $src=imagecreatefromjpeg($photo); break;
					case "gif": $src=imagecreatefromgif($photo); break;
				}
				// destination resized image:
				$dst = imagecreatetruecolor($tn_width, $tn_height);
				// resize original image onto $dst
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
				// write the final jpeg image..
				imagejpeg($dst, $image_name, 100) or die("Error: your photo	has not been saved. Please contact the administrator");
				// time to clean up
				imagedestroy($src);
				imagedestroy($dst);
				
				// and now we do it alll again for the thumbnail:
				$max_width = $thumbWidth; $max_height = $thumbHeight;
				$size = GetImageSize($photo);
				$width = $size[0];
				$height = $size[1];
				$x_ratio = $max_width / $width;
				$y_ratio = $max_height / $height;
				if(($width <= $max_width)&&($height <= $max_height)){
					$tn_width = $width;
					$tn_height = $height;
				}else{
					if(($x_ratio * $height) < $max_height){
						$tn_height = ceil($x_ratio * $height);
						$tn_width = $max_width;
					}else{
						$tn_width = ceil($y_ratio * $width);
						$tn_height = $max_height;
					}
				}
				switch($image_type){
					case "png": $src=imagecreatefrompng($photo); break;
					case "jpg": $src=imagecreatefromjpeg($photo); break;
					case "gif": $src=imagecreatefromgif($photo); break;
				}
				$dst = imagecreatetruecolor($tn_width, $tn_height);
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
				$thumbfile = $thumb_name;
				if(file_exists($thumbfile))unlink($thumbfile);
				imagejpeg($dst, $thumbfile, 100) or die("Error: your photo thumb has not been saved. Please contact the administrator");
				imagedestroy($src);
				imagedestroy($dst);
			}
		}
	}
	


function isLoggedIn() {
    
    $CI 	=& get_instance();
    $user 	= $CI->session->userdata('adminData');
	
    if($user['user_id'])
		return true; 

	return false;
}

function isSuperAdmin() {
    
    $CI 	=& get_instance();
    $user 	= $CI->session->userdata('adminData');
	
    if(isset($user['is_superadmin']) && $user['is_superadmin'])
		return true; 

	return false;
}

function isCountryAdmin() {
    
    $CI 	=& get_instance();
    $user 	= $CI->session->userdata('adminData');
	
    if(isset($user['is_admin']) && $user['is_admin'])
		return true; 

	return false;
}

function create_breadcrumb($lastElement = ""){
  	$ci    = &get_instance();
  	$i	   = 1;
  	$uri   = $ci->uri->segment($i);
  	$link  = '<ul>';
	if(strtolower($ci->uri->segment(1)) != 'home'){
	 	$link .= '<li><a class="txthover" href="'.site_url("home").'">Home</a></li>';
	}
	if($ci->uri->segment(1) == "member" && $ci->uri->segment(2) == "view"){
		$id = $ci->uri->segment(3);
		$userInfo = $ci->general->getRecordWhere(USERSPROFILE, array("user_id"=>$id));
		if(count($userInfo)){
			$userFullName = $userInfo->first_name." ".$userInfo->last_name;
		}
	}
	$skipArray = array("view");
	
	while($uri !=''){
		
		$prep_link ='';
		for($j=1; $j<=$i;$j++){
			$prep_link .= $ci->uri->segment($j).'/';
		}
		
		$name = ucfirst($ci->uri->segment($i));
		$name = str_replace("-", " ", $name);
		$name = $name=="Countries"?"Federations":$name;
		if($ci->uri->segment($i+1) == ""){
			if($lastElement)
				$link .= '<li><a class="txthover" href="'.site_url($prep_link).'"><b>'.$lastElement.'</b></a></li>';
			else
				$link .= '<li><a class="txthover" href="'.site_url($prep_link).'"><b>'.(isset($userFullName)?$userFullName:$name).'</b></a></li>';
		}else{
			if(!in_array(strtolower($name), $skipArray)){
				if(strtolower($ci->uri->segment(1)) != 'home'){
					$link .= '<li><a class="txthover" href="'.site_url($prep_link).'">'.$name.'</a></li>';
				}else{
					$link .= '<li><a href="'.site_url($prep_link).'">'.$name.'</a></li>';
				}
			}
		}
		
		$i++;
		$uri = $ci->uri->segment($i);
  	}
   	$link .= '</ul>';
   	return $link;
}

?>