<?php
class General extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//Function to get record count
        function getAllFaqs($tablename)
        {
            $this->db->select("*");
                    
            $this->db->from("pp_".$tablename);
            $get_data=$this->db->get();
            return $get_data->result_array();
        }
        
        function getFaqsWhere($id_m)
        {
            $this->db->select('*');
            $this->db->from('pp_faqs');
            $this->db->where('id',$id_m);
            $data=$this->db->get();
            return $data->row();
        }
    function get_setting()
	{
	$this->db->select('*');
	$this->db->from('settings');
	$s=$this->db->get();
	return $s->result_array();
	}
    
    
    function getCount($tablename, $where=false){
		if($where)
			$query = $this->db->get_where($tablename, $where);
		else
			$query = $this->db->get($tablename);
		
		return $query->num_rows();
	}
	
	
	//Function to insert a record
	function insertRecord($tablename, $data){
		if($this->db->insert($tablename, $data)){
			return true;
		}else{
			return false;
		}
	}
        
        function insert($table, $param){
		if($this->db->insert($table, $param))
			return true;
	}
	
	//Function to update a record
	function updateRecord($tablename, $data, $where){		
		$this->db->where($where, $data[$where]);
		if($this->db->update($tablename, $data)){
			return true;
		}else{
			return false;
		}
	}
	
	//Function to delete a record
	function deleteRecord($tablename, $whereArray){
		$this->db->where($whereArray);
		if($this->db->delete($tablename)){
			return true;
		}else{
			return false;
		}
	}
	
	//Function to get result set from database
	function getAllRecords($tblname, $orderby=false, $order=false, $limit=false, $limitStart = 0){

		if($orderby)
			$this->db->order_by($orderby, $order);
		if($limit)	
			$this->db->limit($limit, $limitStart);
			
		$query = $this->db->get($tblname);
		
		return $query->result();
	}
	
	//Function to get result set from database with Where Clause
	function getAllRecordsWhere($tblname, $where=false, $orderby=false, $order=false, $limit=false, $limitStart = 0){

		if($orderby)
			$this->db->order_by($orderby, $order);
		if($limit)	
			$this->db->limit($limit, $limitStart);
			
		$query = $this->db->get_where($tblname,$where);
		
		return $query->result();
	}
	
	//Function to get a single row
	function getRecordWhere($tblname, $where=false, $orderby=false, $order=false, $limit=false, $limitStart = 0){

		if($orderby)
			$this->db->order_by($orderby, $order);
		if($limit)	
			$this->db->limit($limit, $limitStart);
			
		$query = $this->db->get_where($tblname,$where);
		
		return $query->row();
	}
	

        }
	//Function to get a single row
	function getArrayRecordWhere($tblname, $where=false, $orderby=false, $order=false, $limit=false, $limitStart = 0){

		if($orderby)
			$this->db->order_by($orderby, $order);
		if($limit)	
			$this->db->limit($limit, $limitStart);
			
		$query = $this->db->get_where($tblname,$where);
		
		return $query->row_array();
	}
		
	//Function to get User Permissions
	function getPermissions($module, $type, $uid)
	{
		if(!$uid)
			return false;
		
		$this->db->select($module."_".$type." as opt");
		$this->db->where('userid', $uid);
		$query	 = $this->db->get("user_rights");
		$row 	 = $query->row();
		
		return $row->opt;
	}
	
	//Function to adjust date
	function adjustDate($month, $year)
	{
		$date = array();

		$date['month']	= $month;
		$date['year']	= $year;

		while ($date['month'] > 12)
		{
			$date['month'] -= 12;
			$date['year']++;
		}

		while ($date['month'] <= 0)
		{
			$date['month'] += 12;
			$date['year']--;
		}

		if (strlen($date['month']) == 1)
		{
			$date['month'] = '0'.$date['month'];
		}

		return $date;
	}
	
	//Function to generate user frienldy slugs for urls.
	

	function trimData($str){
		
		$str = trim($str);
		$str = str_replace(" ","-",$str);
		$str = str_replace(".","-",$str);
		$str = str_replace("'","",$str);
		$str = str_replace("&","-n-",$str);
		$str = str_replace("/","",$str);
		$str = str_replace("\\","",$str);
		$str = str_replace("(","",$str);
		$str = str_replace(")","",$str);
		
		return $str;
	}
		
	/*function generateMessage($msg, $type){

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
	*/
	function getModeratorsPermissions($id){
		if(!$id)
			return false;
		
		return $this->getRecordWhere(MODERATORSPERM, array("moderator_id"=>$id));
		
	}
	
	function uploadFile($docName, $docOrgName, $docTmp, $docPath){
		
		// grab the path to the temporary file (image) that the user uploaded
		$file = $docTmp;
		
		// check if it exists
		if(is_uploaded_file($file)){
			//the real image file name
			move_uploaded_file($docTmp, $docPath.$docName);
		}
	}
	
	/*function uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight){
		
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
				$size = getimagesize($photo);
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
	*/
	
	function uploadGalleryImageWithThumbs($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight){

		$sizesAllowed = array(
							array("width"=>1600, "height"=>1200),
							array("width"=>1280, "height"=>960),
							array("width"=>1024, "height"=>768),
							array("width"=>800,  "height"=>600),
						);
	
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
					$image_name = $imagePath.$imageName.".".$image_type;
					$thumb_name = $imagePath."thumb_".$imageName.".".$image_type;
					if(!is_file($image_name))break;
					$x++;
				}
			//	die($image_name);
				
				// start processing the main bigger image:
				$max_width = $imageWidth; $max_height = $imageHeight;
				$size = getimagesize($photo);
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
				// destination resized image:
				$dst = imagecreatetruecolor($tn_width, $tn_height);
				// resize original image onto $dst
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height);
				// write the final jpeg image..
				imagejpeg($dst, $image_name, 100) or die("Error: your photo	has not been saved. Please contact the administrator");
				// time to clean up
				imagedestroy($src);
				imagedestroy($dst);
				
				print_r($sizesAllowed);
				foreach($sizesAllowed as $item){
					
					//echo $item['width']."x".$item['height']."<br />";
					
					$max_width = $item['width']; 
					$max_height = $item['height'];
					$size = getimagesize($photo);
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
					imagejpeg($dst, $thumbfile, 100) or die("Error: your photo thumb has not been saved. Please contact the administrator");// and now we do it alll again for the thumbnail:
				
				
					
				}
				
				imagedestroy($src);
				imagedestroy($dst);
				
				
			}
		}
	}
	
	function imageDimensions($imageDimensions, $id){
		
		$sizesAllowed = array(
							array("width"=>1600, "height"=>1200),
							array("width"=>1280, "height"=>960),
							array("width"=>1024, "height"=>768),
							array("width"=>800,  "height"=>600),
						);
		$array = array("width"=>$imageDimensions[0], "height"=>$imageDimensions[1]);
		
		$key = array_search($array, $sizesAllowed);

		for($i=$key; $i<sizeof($sizesAllowed);$i++){
			$d1 = $sizesAllowed[$i]["width"]."|".$sizesAllowed[$i]["height"]."|".$id;
			$d2 = $sizesAllowed[$i]["width"]."x".$sizesAllowed[$i]["height"];
			echo "<a href='".site_url(WDOWNLOADPAGE.base64_encode($d1))."' target='_blank'>".$d2."</a><br>";
		}
		
	}
	
	
	function getMicroTime(){ 
		list($usec, $sec) = explode(" ",microtime()); 
		return ((float)$usec + (float)$sec); 
	}
	
	function isValidURL($url)
	{
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
	
	function allowedChars($str){
		
		$arr = array(
					"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
					"0","1","2","3","4","5","6","7","8","9",
					"-");
					
		for($i=0; $i<strlen($str); $i++){
			if(!in_array($str[$i],$arr))
				return false;
				//echo $str[$i];
		}
		//die();
		return true;
	}
	
	
	function get404Array(){
		
		$data['pageTitle']			= TITLE404;
		$data['metaKeywords']		= METAKEYWORDS404;
		$data['metaDescription']	= METADESCRIPTION404;
		$data['heading']			= HEADING404;
		$data['pageContent']		= CONTENT404;
			
		return $data;
	}
	
	function check_email_address($email) 
	{
		if(!@ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
			return false;
	  	}
	  
	  	// Split it into sections to make life easier
	  	$email_array = explode("@", $email);
	  	$local_array = explode(".", $email_array[0]);
	  	for ($i = 0; $i < sizeof($local_array); $i++) {
			if(!@ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])){
				return false;
			}
	  	}
		
	  	// Check if domain is IP. If not, 
	  	// it should be valid domain name
	  	if (!@ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
		  		if(!@ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",	$domain_array[$i])) {
					return false;
		  		}
			}
	  	}
	  	return true;
	}
	 
	function getSummitList(){
		
		$allSummits = $this->getAllRecordsWhere(EVENTS, array("is_active"=>1), "id", "DESC");	
		
		$content  = "";
		$content .= "<div class='grey-line'>&nbsp;</div>";
		foreach($allSummits as $item){
			$content .= "<div class='item'><span class='hideimage'><img class='left-border-repeat3' src='".base_url()."images/events/thumb_".$item->image."' /></span>";
			$content .= "<h2><a href='".site_url("members-programs-n-events/summits/".$item->id)."'>".$item->event_title."</a></h2>";
			$content .= "<p>".substr(strip_tags($item->description),0,200)."...</p>";
			$content .= "<p class='readmore'><a href='".site_url("members-programs-n-events/summits/".$item->id)."'>read more</a></p>";
			$content .= "</div>";
			$content .= "<div class='clear'></div>";
			$content .= "<div class='grey-line'>&nbsp;</div>";
		}
		//print_r($allSummits);
		
		return $content;
		
	
}