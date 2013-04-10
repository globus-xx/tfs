<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {


	public function view($id)
	{
		$data['current']="Event Detail";
		$data['event']=$this->general->getAllRecordsWhere("acf_events",array("id"=>"$id"));
		$data["home_videos"]=$this->general->getAllRecordsWhere("acf_gallery_videos",array("is_active"=>"1","visibility"=>"1"), "date_added","DESC", "4",'0');

		
		$this->load->view("event_detail",$data);
		
	}

	
}
?>