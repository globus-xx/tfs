<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

var $rpp = 10;
	public function index($pgnum=1)
	{
		$limit=10;
		$data['current']	 = "News";
		
//$data["home_recent_news"]=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1"),"date_added","DESC");

		$news=$this->general->getAllRecordsWhere("acf_news",array("is_active"=>"1"),"date_added","DESC");		
		 $totalRecord=count($news);
		   $numOfPages	 = ceil($totalRecord/$this->rpp);
		   if(!is_numeric($pgnum) || $pgnum<0 || $pgnum>$numOfPages)
			redirect("news/index/1");
		   
			$max = ($pgnum - 1) * $this->rpp; 
		
			$data['numOfPages'] = $numOfPages;
			$data['currPage']   = $pgnum;
			
			$data['tagSlug'] = "hello";
			$data['module']  = "news/index";
			
			$data['home_recent_news']  =$this->general->getAllRecordsWhere("acf_news", array("is_active"=>"1"), "date_added", "DESC",$this->rpp, $max);
			
		
		
		
$data["home_videos"]=$this->general->getAllRecordsWhere("acf_gallery_videos",array("is_active"=>"1","visibility"=>"1"), "date_added","DESC", "4",'0');


$this->load->view("news_list",$data);
		
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