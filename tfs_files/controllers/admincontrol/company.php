<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("admin");
		if(!isSuperAdmin()){
			redirect("admincontrol/login");
		}
                error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}
	
	
	
	
	
	
	public function index(){
            
            redirect("admincontrol/company/listCompany");
            
        }

       public function upadateCompany($id=null){
	
		$data['errMsg'] = "";
		$data['nav']	= "homepage";
		$data['title']	= "Add a Company";
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name', 	'Title', 		'trim|required|xss_clean');
//		$this->form_validation->set_rules('txt_content','Content', 		'trim|required|xss_clean');
//		$this->form_validation->set_rules('contact', 	'Category Name', 		'required');
//		$this->form_validation->set_rules('chk_main', 	'Type', 		'required');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		
                
                    
		if ($this->form_validation->run() == TRUE)
		{
                        extract($this->input->post());
//                         print $txt_name;die;

			
			$userid			= $this->session->userdata['adminData']['user_id'];
			


                        $p_data = $this->input->post();
                        $updateID  = $p_data['updateID'];
                                
                         unset($p_data['txt_establishing_date']);
                         unset($p_data['txt_registered_date']);
                         unset($p_data['txt_first_trading_day']);
                         unset($p_data['updateID']);
                         unset($p_data['submitbuttonname']);

                        $inputData =  $p_data;
						
			if($updateID){
                           $inputData['id'] = $id;
                             $this->general->updateRecord(COMPANY, $inputData, "id");                        
                            $this->session->set_userdata('msg', 'Update Successfully');
                        }else {
                            $this->general->insertRecord(COMPANY, $inputData);
                            $this->session->set_userdata('msg', 'Record Added Successfully');
                        }
			
                        
                         
			
                        
                        if($isactive){
				
				$link = site_url("company/$slug");
				//$this->general->postToFacebook($title, $link);
				//$this->general->postToTwitter($link);
				
			}
	
			$data['errMsg'] = generateMessage("New Record Added Successfully", "green");
             
		}
                
            
                  

		 if($id)$data['companyData']= $this->general->getRecordWhere(COMPANY, array("id"=>$id));
		 $data['content']=  $this->load->view('admincontrol/companies_form', $data,true);
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
        
        public function deleteCompany($idd){
            
                $sql = $this->db->query(
							"SELECT *
							FROM 
							".COMPANY."
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
					
                                        
                                        
                                        
             $query = "DELETE FROM ".COMPANY." WHERE id = $idd ";         
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
        
        
	public function listcompany(){
		$data['title']	 = "Company Listing";
		$data['class']="news";
		
		$sql = $this->db->query(
							"SELECT *
							FROM 
							".COMPANY."
							ORDER BY create_date DESC");
		//echo $this->db->last_query();
		$data['companies'] = $sql->result();
//		print_r($data['companies']);
		//$data['news'] 	= $this->general->getAllRecordsWhere(NEWS, array(), $data['field'], $data['order'], $data['rpp'], ($data['cp']-1));
		
		$data['content']=$this->load->view('admincontrol/companies_list', $data,true);
		$this->load->view('admincontrol/template',$data);
		
		
		
	}
	
	
}