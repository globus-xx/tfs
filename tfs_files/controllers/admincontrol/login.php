<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	public function index(){
		
		$data['message'] = "Enter your credentials";
		
		$this->form_validation->set_rules('username','Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password','Password', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == TRUE)
		{
			$username = $this->input->post("username");
			$password = md5($this->input->post("password"));
			
			$sql = $this->general->getRecordWhere(USERS, array("username"=>$username, "password"=>$password, "is_superadmin"=>1, "is_active"=>1));
			if(count($sql)){
				
				$newData = array(
								"user_id" 		=> $sql->id,
								"username" 		=> $sql->username,
								//"is_admin" 		=> $sql->is_admin,
								"is_superadmin" => $sql->is_superadmin
							);
				
				$this->session->set_userdata("adminData", $newData);
				
				$this->general->updateRecord(USERS, array("id"=>$sql->id, "last_logged_in"=>date("Y-m-d H:i:s")), "id");
				
				redirect("admincontrol/homepage");
					
			}else{
				
			}
		
		}
		
		$this->load->view('admincontrol/login', $data);
		
	}
	
	
	public function forgotPassword(){
		
		$this->form_validation->set_rules('user_email','email', 'trim|required|xss_clean');
		$data['userName'] = "";
		if ($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post("user_email");		
			
		}
		
		$this->load->view('admincontrol/forget_password', $data);
		
	}
	
	
	public function logout()
	{
		$this->session->unset_userdata("adminData");
		redirect("admincontrol/homepage");
	}
	
}
