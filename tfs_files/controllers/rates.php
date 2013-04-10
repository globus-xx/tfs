<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends CI_Controller {
	
	var $tablename = "rates";
	
	public function index()
	{
            
//            if($this->general->insert("rates", array('date'=>'1223', 'rate'=>'456'))){print "d";}
//            else{print "d";}
//            $this->general->insert("rates", array('date'=>'1223', 'rate'=>'456'));die;
//            die;
//            
//            $json = array(array(1317888000000, 20.84),array(1317888060000),
//            
//                array(1317888120000, 416.13),array(1317888180000));
            $json = array();
            $rates = $this->general->getAllRecords($this->tablename, "id", "desc", 360,0);
            $format = '%d/%m/%Y %H:%M:%S';
//            print_r($rates);
            foreach ($rates as $rate){ 
              $date = $rate->date;
//            $date = explode("-", $rate->date);
//            $date  = $date[1]."-".$date[0]."-".$date[2];
            $date =  strtotime($date)*1000;
            $item = array($date, floatval($rate->rate) ) ;
            array_push($json, $item);
//            print_r(strptime(strtotime($rate->date), $format));
            }
            
//                        while ($row = mysql_fetch_assoc($rates)) {print $row["rate"];}
              sort($json);
            print json_encode($json);
            
//            $json = array(array(1317888000000, -20.84,415.96,415.27,415.73),array(1317888060000,415.73,416.239,415.57,416.13),
//    array(1317888120000, 416.13,416.35,415.92,415.94),array(1317888180000, 415.97,416.21,415.84,416.06));
//print json_encode($json);
            die;
		$data['isForm']		 = true;
		$data['pageTitle'] 	 = "Events";
		$data['heading'] 	 = "Events";
		
		$news 		= $this->general->getAllRecordsWhere($this->tablename, array("is_active"=>1));
		
		$parentData = $this->general->getRecordWhere(SUBMENUS, array("slug"=>"media-center", "status"=>1));
		$childData 	= $this->general->getRecordWhere(SUBMENUS, array("slug"=>"news-n-events", "status"=>1, "menu_id"=>$parentData->id));
		
		$data['parentData'] = $parentData;
		$data['childData'] = $childData;
				
		$data['pageTitle']			= $childData->page_title;
		$data['metaKeywords']		= $childData->page_keywords;
		$data['metaDescription']	= $childData->page_description;
		$data['heading']			= $childData->title;
		$data['pageContent']		= $childData->content;
		$data['current']	 		= $parentData->slug;
		$data['subCurrent']	 		= $childData->slug;
		
		$data['news'] 			= $news;
		
		$this->load->view('news', $data);
	}
	public function loadData()
	{
            $json = array(array(1317888000000, -20.84,415.96,415.27,415.73),array(1317888060000,415.73,416.239,415.57,416.13),
            array(1317888120000, 416.13,416.35,415.92,415.94),array(1317888180000, 415.97,416.21,415.84,416.06));
//            print json_encode($json);
//           $m = date('m');
////randomize 30 days
//$day = rand(0,31);
//echo "2009-$m-$day";
            
//echo $this->getOtherDate("Y-m-d H:i:s", "+2 days"); //would print date/time two days ahead of today
//echo "<br>".$this->getOtherDate("Y-m-d H:i:s", "-5 days"); //print date/time 5 days ago
//             $this->general->insert("rates", array('date'=>'1/1/11', 'rate'=>'456'));die;
            for($count=1; $count<361; $count++)
           {    $rate = rand(1800, 1990);
                $updateData = array(
                                    "date"		=> $this->getOtherDate("Y-m-d H:i", "+ $count minutes"),
                                    "rate"		=> $rate
                                );
//            print_r($updateData);
                $this->general->insert("rates", $updateData);
           }         
                    
//            echo "<br>".$this->getOtherDate("Y-m-d H:i:s", "+ $count minutes")." ".rand(1800, 1990); //print date/time 2 hours from now
 
// print $criteria = date("Y-m-d H:i:s" , strtotime("+ 2 days", strtotime(date("Y-m-d H:i:s"))));
            
            die;
        }
public function getOtherDate($format, $fromNow){
    
  
  return (date($format , strtotime($fromNow, strtotime(date($format)))));
}	public function view($id="")
	{
		die($id);
		if(!id || !is_numeric($id)){
		//	redirect("media-center/picture-gallery");
		}
		
		$galleryInfo = $this->general->getRecordWhere($this->tablename, array("is_active"=>1, "id"=>$id));
		print_r($galleryInfo);
		
		$parentData = $this->general->getRecordWhere(SUBMENUS, array("slug"=>"media-center", "status"=>1));
		$childData 	= $this->general->getRecordWhere(SUBMENUS, array("slug"=>"picture-gallery", "status"=>1, "menu_id"=>$parentData->id));
		
		$data['parentData'] = $parentData;
		$data['childData'] = $childData;
					
		$data['pageTitle']			= $childData->page_title;
		$data['metaKeywords']		= $childData->page_keywords;
		$data['metaDescription']	= $childData->page_description;
		$data['heading']			= $childData->title;
		$data['pageContent']		= $childData->content;
		$data['current']	 		= $parentData->slug;
		$data['subCurrent']	 		= $childData->slug;
		
		$data['title'] 				= "Apply Now";
		$this->load->view('careers_apply', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 