<?php

	$year = date('Y');
	$month = date('m');

        
$year = date('Y');
$month = date('m');
$con=mysql_connect("localhost","root","");


// Check connection
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("tfs", $con);

$result = mysql_query("SELECT * FROM acf_events");
$arr=array();
while($pp = mysql_fetch_assoc($result))
{
    die($pp['remarks']);
	echo json_encode(array(
        array(    
	'id'=>$pp['id'],
	'title'=>$pp['remarks'],
	'start'=>date("Y-m-d",strtotime($pp['start_date'])),
	'url'=>"events/view/".$pp['id']
	)
     ));
        
        die;
}


//
//	echo json_encode(array(
//	
//		array(
//			'id' => 111,
//			'title' => "Event1",
//			'start' => "$year-$month-10",
//			'url' => "http://yahoo.com/"
//		),
//		
//		array(
//			'id' => 222,
//			'title' => "Event2",
//			'start' => "$year-$month-20",
//			'end' => "$year-$month-22",
//			'url' => "http://yahoo.com/"
//		)
//            
//            ,
//            array(
//			'id' => 222,
//			'title' => "الالالال",
//			'start' => "$year-$month-20",
//			'end' => "$year-$month-22",
//			'url' => "http://yahoo.com/"
//		)
//	
//	));

?>
