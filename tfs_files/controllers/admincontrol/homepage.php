<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("admin");
		if(!isSuperAdmin()){
			redirect("admincontrol/login");
		}
	}
	
	public function index(){
		$data['title']	= "Welcome";	
		$data['content']=$this->load->view("admincontrol/home_page",$data,true);	
		$this->load->view('admincontrol/template', $data);
		
	}
public function createSlug($str, $table = "")
	{
		$str = strtolower($this->trimData($str));
		if($table){
			if($this->general->getCount($table, array("slug"=>$str))){
				return $str."-1";
			}else{
				return $str;
			}
		}
		return $str;
	}
	
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

	
	
        /**--------------------------------
	Events Categories Functions
	----------------------------------*/
        
        public function listEvents(){
            
            
		$data['title']	 = "Events Listing";
		$data['class']="events";
		
		$sql = $this->db->query(
							"SELECT *
							FROM 
							".EVENTS."
							ORDER BY date_added DESC");
		//echo $this->db->last_query();
		$data['events'] = $sql->result();
		
		//$data['news'] 	= $this->general->getAllRecordsWhere(NEWS, array(), $data['field'], $data['order'], $data['rpp'], ($data['cp']-1));
		
		$data['content']=$this->load->view('admincontrol/events_list', $data,true);
		$this->load->view('admincontrol/template',$data);
		
		
		
	}
        
        
        public function addEvents(){
	
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Add a Events";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_location','Location', 		'trim|required|xss_clean');
		//$this->form_validation->set_rules('txt_image', 	'Image', 		'callback_image_check');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
                
                    
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$slug			= $this->createSlug($title);
			$content 		= $this->input->post('txt_content');
			//$order			= $this->input->post('txt_order');
			//$mCountry		= $this->input->post('cmb_country');
                        $location 		= $this->input->post('txt_location');
			$category		= $this->input->post('category');
                        $startdate              = $this->input->post('txt_from');
                        $enddate                = $this->input->post('txt_to');
                        $regenddate             = $this->input->post('txt_reg_date');
                        
                     
                        
                        $datetime1 = strtotime($startdate);
                        $datetime2 = strtotime($enddate);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $duration = $secs / 86400;
                        
                      
                         
			$isactive  		= $this->input->post('chk_active');
			$ismain  		= $this->input->post('chk_main');
			
			
			$userid			= $this->session->userdata['adminData']['user_id'];
			
			
			$mime = array(
							'image/gif',
							'image/jpeg',
							'image/png'
							);
			$mimeExt = array(
						'image/gif'	 => "gif",
						'image/jpeg' => "jpg",
						'image/png'  => "png"
						);	
                        
                        
                        
			
			$imageName		= time()."_".$_FILES['txt_image']['name'];
			$imageOrgName           = str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['txt_image']['name']);
                	$imageType		= strtolower($_FILES['txt_image']['type']);
                	$imageTmp		=str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['txt_image']['tmp_name']);
			$imagePath		= "images/events/";
			$imageWidth		= "600";
			$imageHeight            = "600";
			$thumbWidth		= "300";
			$thumbHeight            = "170";
				
			//main image	
			uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
		
			
                        
			$inputData = array(
							"title"				=> $title,
							"slug"				=> $slug,
							"content"			=> $content,
							"location"              =>$location,
                                                        "start_date"                    =>$startdate,
                                                        "end_date"                    =>$enddate,
                                                        "reg_end_date"                    =>$regenddate,
                                                        "duration"              =>$duration,
							"category"		=> $category,
							"image"				=> $imageName,//.".".$mimeExt[$imageType],
							"is_active"	 		=> $isactive,
							"is_main"	 		=> $ismain,
							"last_modified_by"	=> $userid,
							"date_added" 		=> date("Y-m-d H:i:s"),
							"date_modified"		=> date("Y-m-d H:i:s"),
                                                            
						);
						
			$this->general->insertRecord(EVENTS, $inputData);
                        
			                                                 			                                              
	 $this->session->set_userdata('msg', 'New Event ecord Added Successfully');
			$data['errMsg'] = generateMessage("New Record Added Successfully", "green");
                         
		}
                
            
                  
               
                 $data["events"]=$this->admin_model->get_all("acf_events");
                
		 $data['content']=  $this->load->view('admincontrol/events_form', $data,true);
		 $this->load->view('admincontrol/template',$data);
		
	}
        
        
        
        public function editEvents($id=""){
		
		if(!is_numeric($id))
			redirect("admincontrol/homepage/listEvents");
			
		$data['class']	= "events";
		$data['title']	= "Edit a Event";
		
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_location','Location', 		'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$slug			= $this->createSlug($title);
			$content 		= $this->input->post('txt_content');
			//$order		= $this->input->post('txt_order');
			//$mCountry		= $this->input->post('cmb_country');
                        $location 		= $this->input->post('txt_location');
                        
			$category		= $this->input->post('category');
                        
                        $startdate              = $this->input->post('txt_from');
                        $enddate                = $this->input->post('txt_to');
                        $regenddate             = $this->input->post('txt_reg_date');
                        
                        
                                              
                        $datetime1 = strtotime($startdate);
                        $datetime2 = strtotime($enddate);

                        $secs = $datetime2 - $datetime1;// == <seconds between the two times>
                        $duration = $secs / 86400;
                        
             
                        
			$isactive  		= $this->input->post('chk_active');
			$ismain  		= $this->input->post('chk_main');
			//$cat_id  		= $this->input->post('parent_cat');
			
			$userid			= $this->session->userdata['adminData']['user_id'];
                        
                        
                        
                        
			
			$inputData = array(
                                                        "id"				=> $id,
							"title"				=> $title,
							"slug"				=> $slug,
							"content"			=> $content,
							"location"              =>$location,
                                                        "start_date"                    =>$startdate,
                                                        "end_date"                    =>$enddate,
                                                        "reg_end_date"                    =>$regenddate,
                                                        "duration"              =>$duration,
							"category"		=> $category,							
							"is_active"	 		=> $isactive,
							"is_main"	 		=> $ismain,
							"last_modified_by"	=> $userid,
							"date_added" 		=> date("Y-m-d H:i:s"),
							"date_modified"		=> date("Y-m-d H:i:s"),
                                                            
						);
			
			
			
			if(isset($_FILES['txt_image']) && $_FILES['txt_image']['name']!=""){
				
				$oldImageName = $this->input->post('hdn_image');
				
				$mime = array(
							'image/gif',
							'image/jpeg',
							'image/png'
							);
				$mimeExt = array(
							'image/gif'	 => "gif",
							'image/jpeg' => "jpg",
							'image/png'  => "png"
							);			
				
				
				//if(in_array($imageType, $mime)){

					$imageName		= time()."_".$_FILES['txt_image']['name'];
					$imageOrgName   = str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['txt_image']['name']);
                			$imageType		= strtolower($_FILES['txt_image']['type']);
                			$imageTmp		=str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['txt_image']['tmp_name']);
					$imagePath		= "images/news/";
					$imageWidth		= "600";
					$imageHeight	= "600";
					$thumbWidth		= "300";
					$thumbHeight	= "170";
						
					//main image	
				//main image	
			uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
		
					
					//image for slider
					/*
					$imageWidth		= "190";
					$imageHeight	= "180";
					$thumbWidth		= "70";
					$thumbHeight	= "70";
					
					uploadImageWithThumb("small_".$imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
					
				uploadImageWithThumb("small_".$imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
					
                                        $imageWidth		= "300";
                                        $imageHeight	= "200";
                                        $thumbWidth		= "70";
                                        $thumbHeight	= "70";

                                     uploadImageWithThumb("mainhome_".$imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
			
                                        */
                                        
					if(file_exists("images/news/".$oldImageName)){
						@unlink("images/news/".$oldImageName);
					}
					
					if(file_exists("images/news/thumb_".$oldImageName)){
						@unlink("images/news/thumb_".$oldImageName);
					}
					
//					if(file_exists("images/news/small_".$oldImageName)){
//						@unlink("images/news/small_".$oldImageName);
//					}
//					
//					if(file_exists("images/news/thumb_small_".$oldImageName)){
//						@unlink("images/news/thumb_small_".$oldImageName);
//					}
//                                        
//                                        if(file_exists("images/news/thumb_mainhome_".$oldImageName)){
//						@unlink("images/news/thumb_mainhome_".$oldImageName);
//					}
//                                        if(file_exists("images/news/mainhome_".$oldImageName)){
//						@unlink("images/news/mainhome_".$oldImageName);
//					}
					
					$inputData['image'] = $imageName;	
                                        
				//}else{
					//$data['errMsg'] = $this->general->generateMessage("Invalid image format. Only jpg, gif and png are allowed", "red");
				//}
			}
			
			$this->general->updateRecord(EVENTS, $inputData, "id");                        
			 $this->session->set_userdata('msg', 'Event Update Successfully');
		}
		
		$data['eventsData']= $this->general->getRecordWhere(EVENTS, array("id"=>$id));
		$data['content']=$this->load->view('admincontrol/events_form', $data,true);
		$this->load->view("admincontrol/template",$data);
		
	}
	
	                                                
          public function deleteEvents($idd){
            
                $sql = $this->db->query(
							"SELECT *
							FROM 
							".EVENTS."
							WHERE id = $idd
							");
		//echo $this->db->last_query();
		$newdel = $sql->result();
           
                foreach($newdel as $row)
            
                $imagename=$row->image;                
            
            
                                        if(file_exists("images/events/".$imagename)){                                           
						@unlink("images/events/".$imagename);
					}
					
					if(file_exists("images/events/thumb_".$imagename)){
						@unlink("images/events/thumb_".$imagename);
					}
					
                                        
                                        
                                        
             $query = "DELETE FROM ".EVENTS." WHERE id = $idd ";         
             $this->db->query($query);    
 $this->session->set_userdata('msg', 'Event Deleted Successfully');
            $this->listEvents();
        }
        
        
        
        
        
        
        
         /**--------------------------------
	Menus Functions
	----------------------------------*/
        
        public function listMenus(){
            
            
		$data['title']	 = "Menus Listing";
		$data['class']="menus";
		
		$sql = $this->db->query(
							"SELECT *
							FROM 
							".MENUS."
							ORDER BY 'order' ASC");
		//echo $this->db->last_query();
		$data['menus'] = $sql->result();
		
		//$data['news'] 	= $this->general->getAllRecordsWhere(NEWS, array(), $data['field'], $data['order'], $data['rpp'], ($data['cp']-1));
		
		$data['content']=$this->load->view('admincontrol/menus_list', $data,true);
		$this->load->view('admincontrol/template',$data);
		
		
		
	}
        
        
        public function addMenus(){
	
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Add a Menus";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_slug', 	'Slug', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_page_title','Content', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_page_keywords','Page Keywords', 'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_page_description','Page Description', 'trim|required|xss_clean');                                 
                $this->form_validation->set_rules('txt_sort','Sort Order', 'trim|required|xss_clean');   
               // $this->form_validation->set_rules('chk_active','IsActive', 'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
                
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
                
                    
		if ($this->form_validation->run() == TRUE)
		{
                    
                     
			$title 			= $this->input->post('txt_title');                        
			$slug			= $this->input->post('txt_slug');
                        $ptitle 		= $this->input->post('txt_page_title');  
                        $pKeywords	        = $this->input->post('txt_page_keywords');                          
                        $pDescription           = $this->input->post('txt_page_description');                         
                        $isactive  		= $this->input->post('chk_active');
                      //  $isexternal  		= $this->input->post('chk_external');                        
                      //  $link                   = $this->input->post('txt_link');                          
                        $sort                   = $this->input->post('txt_sort'); 
			$content 		= $this->input->post('txt_content');
                      //  $banner                 = $this->input->post('cmb_banner');
                        
                        
                        
			
//			
//			$mime = array(
//							'image/gif',
//							'image/jpeg',
//							'image/png'
//							);
//			$mimeExt = array(
//						'image/gif'	 => "gif",
//						'image/jpeg' => "jpg",
//						'image/png'  => "png"
//						);	
//                        
//                        
//                        
//			
//			$imageName		= time()."_".$_FILES['image']['name'];
//			$imageOrgName           = str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['image']['name']);
//                	$imageType		= strtolower($_FILES['image']['type']);
//                	$imageTmp		=str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['image']['tmp_name']);
//			$imagePath		= "images/menus/";
//			$imageWidth		= "600";
//			$imageHeight            = "600";
//			$thumbWidth		= "300";
//			$thumbHeight            = "170";
//				
//			//main image	
//			uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
//		
//			
//                        
//                        
//                        
                      
		
                        
                        
                        $inputData = array(
							"title"				=> $title,
							"slug"				=> $slug,
                                                        "page_title"		        => $ptitle,
                                                        "page_keywords"                 =>$pKeywords,
                                                        "page_description"              =>$pDescription,
                                                        "showit"	 		=> $isactive,
//                                                        "external"	 		=> $isexternal,
//                                                        "link"                          => $link,
//                                                        "banner_name"                   => $banner,
							"content"			=> $content,	
                                                        "order"                         => $sort,
                                                        
                                                        "last_modified_by"	=> 0,
							"date_added" 		=> date("Y-m-d H:i:s"),
							"date_modified"		=> date("Y-m-d H:i:s"),
                            
						);
						
			$this->general->insertRecord(MENUS, $inputData);
                        
		
		}
                
            
                  
               
                 $data["menus"]=$this->admin_model->get_all(MENUS);
                
		 $data['content']=  $this->load->view('admincontrol/menus_form', $data,true);
		 $this->load->view('admincontrol/template',$data);
		
	}
        
        
        
        public function editMenus($id=""){
		
		if(!is_numeric($id))
			redirect("admincontrol/homepage/listMenus");
			
		$data['class']	= "menus";
		$data['title']	= "Edit Menu";
		
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_slug', 	'Slug', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_page_title','Content', 		'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_page_keywords','Page Keywords', 'trim|required|xss_clean');
                $this->form_validation->set_rules('txt_page_description','Page Description', 'trim|required|xss_clean');                                 
		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
                
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
                
		if ($this->form_validation->run() == TRUE)
		{
		    
			$title 			= $this->input->post('txt_title');                        
			$slug			= $this->input->post('txt_slug');
                        $ptitle 		= $this->input->post('txt_page_title');  
                        $pKeywords	        = $this->input->post('txt_page_keywords');                          
                        $pDescription           = $this->input->post('txt_page_description');                         
                        $isactive  		= $this->input->post('chk_active');
                      //  $isexternal  		= $this->input->post('chk_external');                        
                      //  $link                   = $this->input->post('txt_link');                          
                        $sort                   = $this->input->post('txt_sort'); 
			$content 		= $this->input->post('txt_content');
                      //  $banner                 = $this->input->post('cmb_banner');
                        
                        
                        
			
//			
//			$mime = array(
//							'image/gif',
//							'image/jpeg',
//							'image/png'
//							);
//			$mimeExt = array(
//						'image/gif'	 => "gif",
//						'image/jpeg' => "jpg",
//						'image/png'  => "png"
//						);	
//                        
//                        
//                        
//			
//			$imageName		= time()."_".$_FILES['image']['name'];
//			$imageOrgName           = str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['image']['name']);
//                	$imageType		= strtolower($_FILES['image']['type']);
//                	$imageTmp		=str_replace( array( '\'', '"', ',' , ';', '-','–','_','^','&'), ' ', $_FILES['image']['tmp_name']);
//			$imagePath		= "images/menus/";
//			$imageWidth		= "600";
//			$imageHeight            = "600";
//			$thumbWidth		= "300";
//			$thumbHeight            = "170";
//				
//			//main image	
//			uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
//		
//			
//                        
//                        
//                        
                      
		
                        
                        
                        $inputData = array(
                                                        "id"                            =>$id,
							"title"				=> $title,
							"slug"				=> $slug,
                                                        "page_title"		        => $ptitle,
                                                        "page_keywords"                 =>$pKeywords,
                                                        "page_description"              =>$pDescription,
                                                        "showit"	 		=> $isactive,
//                                                        "external"	 		=> $isexternal,
//                                                        "link"                          => $link,
//                                                        "banner_name"                   => $banner,
							"content"			=> $content,	
                                                        "order"                         => $sort,
                                                        
                                                        "last_modified_by"	=> 0,
							"date_added" 		=> date("Y-m-d H:i:s"),
							"date_modified"		=> date("Y-m-d H:i:s"),
                            
						);
						
			
			$this->general->updateRecord(MENUS, $inputData, "id");                        
			
		}
		
		$data['menuInfo']= $this->general->getRecordWhere(MENUS, array("id"=>$id));
		$data['content']=$this->load->view('admincontrol/menus_form', $data,true);
		$this->load->view("admincontrol/template",$data);
		
	}
	
	                                                
          public function deleteMenus($idd){                                                    
              
             $query = "DELETE FROM ".MENUS." WHERE id = $idd ";         
             $this->db->query($query);    

            $this->listMenus();
        }
        

        
        
        
        /**--------------------------------
	Companies Functions
	----------------------------------**/
	
	public function addCompanies(){
	
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Add a Company";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$slug			= $this->general->createSlug($title);
			$isactive  		= $this->input->post('chk_active');
			$userid			= $this->session->userdata['adminData']['user_id'];
			
			$inputData = array(
							"tag"				=> $title,
							"slug"				=> $slug,
							"is_active"	 		=> $isactive,
							"date_added" 		=> date("Y-m-d H:i:s"),
							"date_modified"		=> date("Y-m-d H:i:s"),
							"is_active"			=> $isactive
						);
						
			$this->general->insertRecord(TAGS, $inputData);
	
			$data['errMsg'] = $this->general->generateMessage("New Record Added Successfully", "green");
		}
		
		$this->load->view(SUPERADMINFOLDER.'/companies_form', $data);
		
	}
	
	public function editCompanies($id=""){
		
		if(!is_numeric($id))
			redirect(SUPERADMINFOLDER."/homepage/listTags");
			
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Edit Company";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$slug			= $this->general->createSlug($title);
			$isactive  		= $this->input->post('chk_active');
			$userid			= $this->session->userdata['adminData']['user_id'];
			
			$inputData = array(
							"id"				=> $id,
							"tag"				=> $title,
							"slug"				=> $slug,
							"is_active"	 		=> $isactive,
							"date_modified"		=> date("Y-m-d H:i:s")
						);
			
			$this->general->updateRecord(TAGS, $inputData, "id");
			$data['errMsg'] = $this->general->generateMessage("Record Updated Successfully", "green");
		}
		
		$data['tagData'] = $this->general->getRecordWhere(TAGS, array("id"=>$id));
		$this->load->view(SUPERADMINFOLDER.'/tags_form', $data);
		
	}
	
	public function listCompanies(){
		$data['nav']	 = "homepage";
		$data['field']	 = "name";
		$data['class']	 = "cmp";
		$data['rpp']	 = "10";
		$data['cp']	 	 = "1";
		$data['title']	 = "Companies Listing";
                
                
		if(isset($_POST['txt_orderby'])){
			$data['field']	 = $_POST['txt_orderby'];
			$data['order']	 = $_POST['txt_order'];
			$data['rpp']	 = $_POST['txt_rpp'];
			$data['cp']	 	 = $_POST['txt_cp'];
		}
		
		$pInfo  = $this->general->getCount(COMPANIES, array());
		
		if(!is_numeric($data['cp']) || $data['cp']<1)
			$data['cp'] = 1;
			
		if($data['cp']>$pInfo && $pInfo>0)
			$data['cp'] = $pInfo;
		
		$data['jFields'] 	= "#name, #date_modified, #is_active";
		$data['tRecords'] 	= $pInfo;
		$data['tPages'] 	= ceil($pInfo/$data['rpp']);
		
		$data['companies']	= $this->general->getAllRecordsWhere(COMPANIES, array(), $data['field'],  $data['rpp'], ($data['cp']-1));
		
                
                
                $data['content']=$this->load->view('admincontrol/companies_list', $data,true);
		$this->load->view('admincontrol/template',$data);
                
		//$this->load->view(SUPERADMINFOLDER.'/companies_list', $data);
		
	}
        
        
        
        
}
