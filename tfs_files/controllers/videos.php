<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {

var $rpp = 10;
	public function index($pgnum=1)
	{
		$limit=10;
		$data['current']	 = "Videos";
		
//$data["home_recent_news"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1"),"date_added","DESC");

		$vid=$this->general->getAllRecordsWhere("acf_gallery_videos",array("is_active"=>"1"),"date_added","DESC");		
		 $totalRecord=count($vid);
		   $numOfPages	 = ceil($totalRecord/$this->rpp);
		   if(!is_numeric($pgnum) || $pgnum<0 || $pgnum>$numOfPages)
			redirect("videos/index/1");
		   
			$max = ($pgnum - 1) * $this->rpp; 
		
			$data['numOfPages'] = $numOfPages;
			$data['currPage']   = $pgnum;
			
			$data['tagSlug'] = "hello";
			$data['module']  = "videos/index";
			
			$data['videos']  =$this->general->getAllRecordsWhere("acf_gallery_videos", array("is_active"=>"1"), "date_added", "DESC",$this->rpp, $max);

$data["sec_recent_news"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1","ismain"=>"0"), "date_added","DESC", "10",'4');

$this->load->view("videos_list",$data);
		
	}
	
	
	
	function view($id)
	{
		$data['current']	 = "News";
		
$data["home_videos"]=$this->general->getAllRecordsWhere("acf_gallery_videos",array("is_active"=>"1","visibility"=>"1"), "date_added","DESC", "4",'0');

$data["home_recent_news"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1","id"=>"$id"));

$this->load->view("news_detail",$data);
	}
	
}
?>