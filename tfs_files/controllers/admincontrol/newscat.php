<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newscat extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("admin");
		if(!isSuperAdmin()){
			redirect("admincontrol/login");
		}
	}
	
	public function index(){
		$data['title']	= "News Categories Lisitng";
	$data["class"]="cat";	
		$data['categories']=$this->admin_model->check_callback("acf_news_categories",'0','p_id');
		
		
		
		$data['content']=$this->load->view("admincontrol/news_cat_list",$data,true);	
		$this->load->view('admincontrol/template', $data);
		
	}
	
	function addcat($id=0)
	{
	
		$data['title'] = "Add Category";
		$data['class']	= "cat";
			
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_image', 	'Image', 		'callback_image_check');
		       
                    
		if ($this->form_validation->run() == FALSE)
		{
			if($id==0)
			{
				
			}
			else
			{
			
			}
			$data['content']=$this->load->view("admincontrol/add_main_cat",$data,true);
			$this->load->view('admincontrol/template',$data);
			
		}
		else
		{
			$val['p_id']=$id;
			
			$val['title']=$this->input->post('txt_title');
			$val['slug']=$this->createSlug($data['title']);
			$val['is_active']=$this->input->post('chk_active');
			$val['date_added']=date("Y-m-d H:i:s",time());
			$val['date_modified']=date("Y-m-d H:i:s",time());
			
			$this->admin_model->insert("acf_news_categories",$val);
			if($id==0)
			{
				$this->session->set_userdata('msg', 'News Category Added');
			redirect('admincontrol/newscat');	
			}
			else
			{
				$this->session->set_userdata('msg', 'News Category Added');
				redirect('admincontrol/newscat/view_sub/'.$id);
			}
			
		}
		
	}
	
	
/*******************
	Function For geting the level of Sub Categories 
	*****************/
	function edit_cat($id)
	{
		$data['title'] = "Edit Category";
		$data['class']	= "cat";
			
		$this->form_validation->set_rules('txt_title', 	'Title', 		'trim|required|xss_clean');
			//$this->form_validation->set_rules('txt_image', 	'Image', 		'callback_image_check');
		       
                    
		if ($this->form_validation->run() == FALSE)
		{
			$data['edit_cat']=$this->admin_model->check_callback("acf_news_categories",$id,"id");
			$data['content']=$this->load->view("admincontrol/edit_main_cat",$data,true);
			$this->load->view('admincontrol/template',$data);
			
		}
		else
		{
		
			
			$val['title']=trim($this->input->post('txt_title'));
			$val['slug']=$this->createSlug($data['title']);
			$p_id=trim($this->input->post('p_id'));
			$val['is_active']=$this->input->post('chk_active');
			$val['date_modified']=date("Y-m-d H:i:s",time());
			
			$this->admin_model->update("acf_news_categories",$val,$id);
			$this->session->set_userdata('msg', 'News Category Updated');
			if($p_id==0)
			{
				redirect('admincontrol/newscat');
			}
			else
			{
				
				redirect('admincontrol/newscat/view_sub/'.$p_id);
			}
		
	
		}
	
	}
	
	
	function del_cat($id)
	{
		$edit_cat=$this->admin_model->check_callback("acf_news_categories",$id,"id");
		foreach($edit_cat->result_array() as $mnp)
	
			$p_id=$mnp['p_id'];
			$this->admin_model->delete($id,"acf_news_categories");
			if($p_id==0)
			{
				$this->session->set_userdata('msg', 'Main news Category Deleted');
		redirect('admincontrol/newscat');		
			}
		
				$this->session->set_userdata('msg', 'Sub news Category Deleted');
		redirect('admincontrol/newscat/view_sub/'.$p_id);
	}
	
	
	
	
	
	/*******************
	Function For geting the level of Sub Categories 
	*****************/
	
	
	function level_of_cat($id=0)
	{
	$count=0;
	$p_count=1;
	
	while($p_count!=0)
	{
		$d_count=$this->admin_model->level_of_cat($id);
		foreach($d_count as $ms)
		$id=$ms['p_id'];
		$count++;
		$p_count=$id;
		
	}
	return $count;

	}
	
	
	
	
	
	/*******************
	Function View Sub Category of Main News Categories
	*****************/
	
	
	 function view_sub($id)
	{
		$data['check_cat']=$this->level_of_cat($id);
		$edit_cat=$this->admin_model->check_callback("acf_news_categories",$id,"id");
		foreach($edit_cat->result_array() as $mnp)
		if($mnp['p_id']!=0)
		{
	
			$data['back_link']=base_url()."admincontrol/newscat/view_sub/".$mnp['p_id'];
		}
		else
		{
			$data['back_link']=base_url()."admincontrol/newscat/";
		}
		$data['categories']=$this->admin_model->check_callback("acf_news_categories",$id,"p_id");
		$about_id=$this->admin_model->check_callback("acf_news_categories",$id,"id");
		foreach($about_id->result_array() as $mnp)
		
		$title1=$mnp['title'];
		$data["sub_id"]=$id;
		$data['title']=$title1." Sub Categories";
		$data['class']="cat";
		
		$data['content']=$this->load->view("admincontrol/news_cat_list",$data,true);	
		$this->load->view('admincontrol/template', $data);

	}
	function get_hierarchy($cat_id)
	{
		
	$count="";
	$p_count=1;
	if($cat_id!="")
	{
	while($p_count!=0)
	{
		$d_count=$this->admin_model->level_of_cat($cat_id);
		
		foreach($d_count as $ms)
		$cat_id=$ms['p_id'];
		$count=$count."<--".$ms['title'];
		$p_count=$cat_id;
		
		
		
	}
	
	echo $count;
	}
	else
	{
		echo "Error";
	}

	
		
	}
	
	
	
	
	
	
	
	 function createSlug($str, $table = "")
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