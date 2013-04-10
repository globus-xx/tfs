<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data['current']	 = "home";
$data["slider_naws"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1","ismain"=>"1"), "date_added","DESC", "4",'0');
$data["home_naws"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1","ismain"=>"1"), "date_added","DESC", "4",'4');

$data["home_recent_news"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1","ismain"=>"0"), "date_added","DESC", "3",'0');

$data["home_videos"]=$this->general->getAllRecordsWhere("acf_gallery_videos",array("is_active"=>"1","visibility"=>"1"), "date_added","DESC", "4",'0');

$data["sec_recent_news"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1","ismain"=>"0"), "date_added","DESC", "10",'4');
		$this->load->view('home', $data);
	}
	
}
	?>