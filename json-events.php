<?php

	$year = date('Y');
	$month = date('m');
$con=mysql_connect("localhost","globus_tfs","tfs786");
// Check connection
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("globus_tfs", $con);

$result = mysql_query("SELECT * FROM acf_events");
$arr=array();
while($pp = mysql_fetch_assoc($result))
{
	$arr[]=array(
	"id"=>$pp['id'],
	'title'=>$pp['title'],
	'start'=>"$year-$month-13",
	'url'=>"http://yahoo.com/"
	);
}

echo json_encode($arr);

/*echo json_encode(array(
	
		array(
			'id' => 111,
			'title' => "Event1",
			'start' => "$year-$month-10",
			'url' => "http://yahoo.com/"
		),
		array(
			'id' => 112,
			'title' => "Event1",
			'start' => "$year-$month-13",
			'url' => "http://yahoo.com/"
		)
	
	));
*/
?>
