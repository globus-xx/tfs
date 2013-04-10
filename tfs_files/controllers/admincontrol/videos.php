<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("admin");
		if(!isSuperAdmin()){
			redirect("admincontrol/login");
		}
	}
	
	
		public function addVideos(){
	
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Add a Video";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_code', 	'Code', 		'trim|required|xss_clean');
		
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$order			= $this->input->post('txt_order');
			$code			= $this->input->post('txt_code');
			$mCountry		= $this->input->post('cmb_country');
			$type			= $this->input->post('cmb_type');
			$isactive  		= $this->input->post('chk_active');
			$userid			= $this->session->userdata['adminData']['user_id'];
			$slug			= $this->createSlug($title);
			$inputData = array(
							"title"				=> $title,
							"code"				=> $code,
							"slug"				=> $slug,
							"member_country_id"	=> $mCountry,
							"category_id"		=> $type,
							"sort_order"		=> $order,
							"is_active"	 		=> $isactive,
							"last_modified_by"	=> $userid,
							"date_added" 		=> date("Y-m-d H:i:s",time()),
							"date_modified"		=> date("Y-m-d H:i:s",time()),
						);
						
			$this->general->insertRecord(VIDEOS, $inputData);
			$this->session->set_userdata('msg', 'New Record Added Successfully');
	
		}
		
		$data['content']=$this->load->view('admincontrol/videos_form', $data,true);
		$this->load->view('admincontrol/template', $data);
		
	}
	
	
	
	public function deleteVideos($id)
	{
	
		   
							  $query = "DELETE FROM ".VIDEOS." WHERE id = $id ";         
        if($this->db->query($query))
		{
		$this->session->set_userdata('msg', ' Record Deleted Successfully'); 
		$this->listVideos();
		}
		else
		{
			$this->session->set_userdata('msg', ' No Record Found'); 
		redirect("admincontrol/videos/listVideos");
		}
		
	}
	
	public function editVideos($id=""){
		
		if(!is_numeric($id))
			redirect(ADMINFOLDER."/galleries");
			
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Edit Video";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
		$this->form_validation->set_rules('txt_code', 	'Code', 		'trim|required|xss_clean');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
		if ($this->form_validation->run() == TRUE)
		{
			$title 			= $this->input->post('txt_title');
			$order			= $this->input->post('txt_order');
			$code			= $this->input->post('txt_code');
			$mCountry		= $this->input->post('cmb_country');
			$type			= $this->input->post('cmb_type');
			$isactive  		= $this->input->post('chk_active');
			$userid			= $this->session->userdata['adminData']['user_id'];
			$slug			= $this->createSlug($title);
			
			$inputData = array(
							"id"				=> $id,
							"title"				=> $title,
							"code"				=> $code,
							"member_country_id"	=> $mCountry,
							"category_id"		=> $type,
							"slug"				=> $slug,
							"sort_order"		=> $order,
							"is_active"	 		=> $isactive,
							"last_modified_by"	=> $userid,
							"date_modified"		=> date("Y-m-d H:i:s"),
						);
				
			$this->general->updateRecord(VIDEOS, $inputData, "id");
	
			$data['errMsg'] = generateMessage("Video Updated Successfully", "green");
			$this->session->set_userdata('msg', 'Video Updated Successfully');
		}
		
		$data['videoData'] = $this->general->getRecordWhere(VIDEOS, array("id"=>$id), "title", 'ASC');
		
		$data['content']=$this->load->view('admincontrol/videos_form', $data,true);
		$this->load->view("admincontrol/template",$data);
		
	}
	
	
	public function listVideos(){
		
		$data['title']	 	 = "Video's Listing";
	
		$data['class']	 	 	 = "video"; 
		$sql = $this->db->query(
							"SELECT *
							FROM 
							".VIDEOS."
							ORDER BY date_added DESC
							");
		//echo $this->db->last_query();
		$data['videos'] = $sql->result();
		
		$data['content']=$this->load->view('admincontrol/video_list', $data,true);
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
	
	
	
	
	
	
	
	
}
	?>