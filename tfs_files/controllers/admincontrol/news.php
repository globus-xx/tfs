<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("admin");
		if(!isSuperAdmin()){
			redirect("admincontrol/login");
		}
	}
	
	
	
	
	
	
	
	
	public function addNews(){
	
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Add a News";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean|callback_cat_check');
		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
		$this->form_validation->set_rules('contact', 	'Category Name', 		'required');
		$this->form_validation->set_rules('chk_main', 	'Type', 		'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
                
                    
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$slug			= $this->createSlug($title);
			$content 		= $this->input->post('txt_content');
			$order			= $this->input->post('txt_order');
			$mCountry		= $this->input->post('cmb_country');
			$category		= $this->input->post('cmb_category');
			$isactive  		= $this->input->post('chk_active');
			$ismain  		= $this->input->post('chk_main');
			$cat_id  		= $this->input->post('parent_cat');
			$s_name  		= $this->input->post('s_name');
			$s_link  		= $this->input->post('s_link');
			
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
			$imagePath		= "images/news/";
			$imageWidth		= "400";
			$imageHeight	= "360";
			$thumbWidth		= "221";
			$thumbHeight	= "151";
				
			//main image	
			uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
		$imagePath		= "images/news/detail/";
			$imageWidth		= "543";
			$imageHeight	= "277";
			$thumbWidth		= "221";
			$thumbHeight	= "151";
		
		uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
			
                        
			$inputData = array(
							"title"				=> $title,
							"slug"				=> $slug,
							"content"			=> $content,
							"sort_order"		=> $order,
							"member_country_id"	=> $mCountry,
							"category_id"		=> $cat_id,
							"image"				=> $imageName,//.".".$mimeExt[$imageType],
							"is_active"	 		=> $isactive,
							"ismain"	 		=> $ismain,
							"last_modified_by"	=> $userid,
							"date_added" 		=> date("Y-m-d H:i:s"),
							"date_modified"		=> date("Y-m-d H:i:s"),
							"source_name"	=>$s_name,
							"source_link"=>$s_link
						);
						
			$this->general->insertRecord(NEWS, $inputData);
                        
			
                         $this->session->set_userdata('msg', 'News Record Added Successfully');
                         
			
                        
                        if($isactive){
				
				$link = site_url("news/$slug");
				//$this->general->postToFacebook($title, $link);
				//$this->general->postToTwitter($link);
				
			}
	
			$data['errMsg'] = generateMessage("New Record Added Successfully", "green");
             
		}
                
            
                  
                 if(isset($_POST['cancelneww']))
                        $this->listNews ();           
                else
		$data["categories"]=$this->admin_model->get_all("acf_news_categories");
		 $data['content']=  $this->load->view('admincontrol/news_form', $data,true);
		 $this->load->view('admincontrol/template',$data);
		
	}
	
	
	function cat_check()
	{
	
	$p_cat=$this->input->post("parent_cat");
	if($p_cat)
	{
	$edit_cat=$this->admin_model->check_callback("acf_news_categories",$p_cat,"id");
		if($edit_cat->num_rows()>0)
		{
			return true;	
		}
		else
		{
			$this->form_validation->set_message('cat_check', 'Must Add this News Category First');
			return false;
		}
	}
	else
	{
	$this->form_validation->set_message('cat_check', 'Must Add this News Category First');
	return false;
		
	}
	
	}
	
	public function editNews($id=""){
		
		if(!is_numeric($id))
			redirect("admincontrol/news/listNews");
			
		$data['class']	= "news";
		$data['title']	= "Edit a News";
		
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$slug			= $this->createSlug($title);
			$content 		= $this->input->post('txt_content');
			$order			= $this->input->post('txt_order');
			$isactive  		= $this->input->post('chk_active');
			$ismain  		= $this->input->post('chk_main');
			$userid			= $this->session->userdata['adminData']['user_id'];
			$mCountry		= $this->input->post('cmb_country');
			$category		= $this->input->post('parent_cat');
			$tags			= $this->input->post('cmb_tags');
			$s_name  		= $this->input->post('s_name');
			$s_link  		= $this->input->post('s_link');
			
			//$getMaxCount = $this->db->query("SELECT max(`order`) as total FROM $this->tablename2");
			//$getMaxCount = $getMaxCount->result();
			//$order 		 = ($getMaxCount[0]->total)+1;
			
			$inputData = array(
							"id"				=> $id,
							"title"				=> $title,
							"slug"				=> $slug,
							"content"			=> $content,
							"member_country_id"	=> $mCountry,
							"category_id"		=> $category,
							"sort_order"		=> $order,
							"is_active"	 		=> $isactive,
							"ismain"	 		=> $ismain,
							"last_modified_by"	=> $userid,
							"date_modified"		=> date("Y-m-d H:i:s"),
									"source_name"	=>$s_name,
							"source_link"=>$s_link
						);
			
			if($tags){
				$this->db->query("DELETE FROM ".TAGSRELATIONS." WHERE item_id = $id AND item_type = 'news'");
				$tagArray = array(
								"item_id" 		=> $id,
								"item_type"		=> "news",
								"date_modified"	=> date("Y-m-d H:i:s")
								);
				foreach($tags as $tag){
					$tagArray['tag_id'] = $tag;
					$this->general->insertRecord(TAGSRELATIONS, $tagArray);
				}
			}
			
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
					$imageWidth		= "400";
					$imageHeight	= "360";
					$thumbWidth		= "221";
					$thumbHeight	= "151";
						
					//main image	
				//main image	
			uploadImageWithThumb($imageName, $imageOrgName, $imageTmp, $imagePath, $imageWidth, $imageHeight, $thumbWidth, $thumbHeight);
		
		$imagePath		= "images/news/detail/";
			$imageWidth		= "543";
			$imageHeight	= "277";
			$thumbWidth		= "221";
			$thumbHeight	= "151";
		
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
					
					if(file_exists("images/news/small_".$oldImageName)){
						@unlink("images/news/small_".$oldImageName);
					}
					
					if(file_exists("images/news/thumb_small_".$oldImageName)){
						@unlink("images/news/thumb_small_".$oldImageName);
					}
                                        
                                        if(file_exists("images/news/thumb_mainhome_".$oldImageName)){
						@unlink("images/news/thumb_mainhome_".$oldImageName);
					}
                                        if(file_exists("images/news/mainhome_".$oldImageName)){
						@unlink("images/news/mainhome_".$oldImageName);
					}
					
					$inputData['image'] = $imageName;	
                                        
				//}else{
					//$data['errMsg'] = $this->general->generateMessage("Invalid image format. Only jpg, gif and png are allowed", "red");
				//}
			}
			
			$this->general->updateRecord(NEWS, $inputData, "id");                        
			$this->session->set_userdata('msg', 'News Update Successfully');
		}
		
		$data['newsData']= $this->general->getRecordWhere(NEWS, array("id"=>$id));
		$data['content']=$this->load->view('admincontrol/news_form', $data,true);
		$this->load->view("admincontrol/template",$data);
		
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
        
        public function deleteNews($idd){
            
                $sql = $this->db->query(
							"SELECT *
							FROM 
							".NEWS."
							WHERE id = $idd
							");
		//echo $this->db->last_query();
		if($sql->num_rows()>0)
		{
				$newdel = $sql->result();
        	   
                foreach($newdel as $row)
            
                $imagename=$row->image;                
            	 if(file_exists("images/news/".$imagename)){
                                           
						@unlink("images/news/".$imagename);
					}
					
					if(file_exists("images/news/thumb_".$imagename)){
						@unlink("images/news/thumb_".$imagename);
					}
					
                                        
                                        
                                        
             $query = "DELETE FROM ".NEWS." WHERE id = $idd ";         
        $this->db->query($query);    
		$this->session->set_userdata('msg', 'Record Deleted Successfully');
//            exit();
            $this->listNews();
		}
		else
		{
				$this->session->set_userdata('msg', 'No Record  Found');
			redirect("admincontrol/news/listNews");
		}
        }
        
        
	public function listNews(){
		$data['title']	 = "News Listing";
		$data['class']="news";
		
		$sql = $this->db->query(
							"SELECT *
							FROM 
							".NEWS."
							ORDER BY date_added DESC");
		//echo $this->db->last_query();
		$data['news'] = $sql->result();
		
		//$data['news'] 	= $this->general->getAllRecordsWhere(NEWS, array(), $data['field'], $data['order'], $data['rpp'], ($data['cp']-1));
		
		$data['content']=$this->load->view('admincontrol/news_list', $data,true);
		$this->load->view('admincontrol/template',$data);
		
		
		
	}
	
	
}